<?php 

/********************************************
* Slider
********************************************/

add_shortcode( 'slider', 'slider_definition' );

function slider_definition( $atts) {
	extract( shortcode_atts( array(
		'height' => '',
		'category' => '',
		'class' => '',
	), $atts ) );

	global $post;
	$cat = "{$category}";

	$height = "{$height}";
	$height = preg_replace('/px/', '', $height);

	$args = array(
		'post_type' => 'slides',
		'posts_per_page' => -1,
		'suppress_filters' => 0,
		'tax_query' => array(
			array(
			'taxonomy' => 'slides-category',
			'field' => 'name',
			'terms' => $cat,
			)
		)
	);
	$slide_posts = get_posts( $args );
	$count = count($slide_posts);
	$xx = 0;
	$output	= "<div class='full-row vc_row wpb_row vc_row-fluid full-width-row'>
					<div class='wpb_column vc_column_container vc_col-sm-12'>
						<div class='vc_column-inner '>
							<div class='wpb_wrapper'>
								<div class='base-container clearfix' data-row>";
									if ($count) {

	$output .= "						<div class='slider' data-slider>
											<div class='slider__wrapper' style='height: {$height}px'>
											
												<a href='#'class='slider__wrapper__arrow slider__wrapper__arrow--left' data-slider-arrow='prev'></a>
												<a href='#' class='slider__wrapper__arrow' data-slider-arrow='next'></a>";

												foreach ( $slide_posts as $post ): setup_postdata($post);

	$output .= "									<div class='slider__wrapper__slide' data-slide='".$xx."'>";
														$textLink   = get_field('testo_link');
														$urlLink    = get_field('url_link');
														$title      = get_the_title();
														$content    = get_the_content();
														$imgDesktop = get_field('immagine_desktop');
														$imgTablet  = get_field('immagine_tablet');
														$imgMobile  = get_field('immagine_mobile');
														$imgTablet  = (empty($imgTablet)) ? $imgDesktop : $imgTablet;
														$imgMobile  = (empty($imgMobile)) ? $imgDesktop : $imgMobile;

														if ( $textLink && $urlLink ):
	$output .= "											<a href='".$urlLink."'>";
														endif;

	$output .= "										<div class='slider__wrapper__slide__image' style='height: {$height}px'>
															<picture class='picture' data-alt='".$title."' data-default-src='".$imgDesktop."'>
																<source media='(min-width: 1023px)' srcset='".$imgDesktop."'/>
																<source media='(min-width: 767px)'  srcset='".$imgTablet."'/>
																<source srcset='".$imgMobile."'/>
																<img src='".$title."' alt='".$title."'/>
															</picture>
															<img class='image-fallback' src='".$imgDesktop."' alt=''>
														</div>

														<div class='slider__wrapper__slide__content'>
															<div class='slider__wrapper__slide__title'>
																<h2>".$title."</h2>
																<div class='slider__wrapper__slide__title__subtitle'>
																	".$content."
																</div>
															</div>
															<div class='slider__wrapper__slide__button'>
																<div class='slider__wrapper__slide__button__link'>
																	".$textLink."
																</div>
															</div>
														</div>";

														if ( $textLink && $urlLink ):
	$output .= " 											</a>";
														endif;

	$output .= "									</div>";

												$xx++; endforeach;
												wp_reset_postdata();
												$xx = 0;
	$output .= "								<div class='slider__wrapper__navigation' data-nav>";
													foreach ( $slide_posts as $post ):
	$output .= "										<div class='slider__wrapper__navigation__dot' data-nav-dot='".$xx."'></div>";
														$xx++;
												 	endforeach;
	$output .= "								</div>
											</div>
										</div>";
									}
	$output .= "				</div>
							</div>
						</div>
					</div>
				</div>";


	return $output;
}

add_action( 'vc_before_init', 'slider_element' );

function slider_element(){

	add_action('admin_init', function(){

		$termsList = [];

		$terms = get_terms( array(
	    	'taxonomy' => 'slides-category',
	    	'order' => 'DESC',
	    	'hide_empty' => false
		) );


		foreach ($terms as $term){
			array_push($termsList, $term->name);
		}

		array_unshift($termsList, '');

		vc_map( array(
			"name" => __("Slider", 'private_modules'),
			"base" => "slider",
			"description" => "Slider di immagini raggrupate per categoria",
			"icon" => "",
			"category" => __('private_modules', 'private_modules'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __( "Altezza Slider", 'private_modules' ),
					"param_name" => "height",
					"description" => __( "Imposta l'altezza dello slider in px", 'private_modules' ),
					"group" => __( "Impostazioni", 'private_modules' )
				),
				array(
					"type" => "dropdown",
					"heading" => __( "Categoria slider", 'private_modules' ),
					"param_name" => "category",
					"value" => $termsList,
					"description" => __( "Seleziona la categoria", 'private_modules' ),
					"group" => __( "Impostazioni", 'private_modules' )
				),
				array(
					"type" => "textfield",
					"heading" => __( "Classe contenitore", 'private_modules' ),
					"param_name" => "class",
					"description" => __( "Classe aggiuntiva del contenitore", 'private_modules' ),
					"group" => __( "Opzioni css", 'private_modules' )
				)
			)
		));

	});
}
