<?php 


/********************************************
* Slick Carousel
********************************************/

add_shortcode( 'slick_carousel', 'slick_carousel_definition' );

function slick_carousel_definition( $atts) {
	extract( shortcode_atts( array(
		'slick_carousel_images' => '',
		'slick_carousel_slide_title' => '',
		'slick_carousel_slide_subtitle' => '',
		'slick_carousel_slide_text' => '',
		'slick_carousel_slide_link' => '',
		'slick_carousel_image_number' => '1',
		'slick_carousel_image_number_move' => '1',
		'slick_carousel_image_number_landscape' => '1',
		'slick_carousel_image_number_move_landscape' => '1',
		'slick_carousel_image_number_portrait' => '1',
		'slick_carousel_image_number_move_portrait' => '1',
		'slick_carousel_image_number_mobile' => '1',
		'slick_carousel_image_number_move_mobile' => '1',
		'slick_carousel_speed' => '2000',
		'slick_carousel_fade' => 'false',
		'slick_carousel_dots' => 'false',
		'slick_carousel_infinite' => 'false',
		'slick_carousel_arrows' => 'false',
		'slick_carousel_autoplay' => 'false',
		'slick_carousel_autoplay_speed' => '2000',
		'class' => '',
		'modifier' => '',
		'id_element' => ''
	), $atts ) );

	$postid = "";
	$array_link = "";

	if ($slick_carousel_dots == "true"){
		$modifier .= " with-dots";
	}
	
	if ($slick_carousel_arrows == "true"){
		$modifier .= " with-arrows";
	}
	
	if ($slick_carousel_slide_title != ""){
		$array_title = explode("||",$slick_carousel_slide_title);
	}
	
	if ($slick_carousel_slide_subtitle != ""){
		$array_subtitle = explode("||",$slick_carousel_slide_subtitle);
	}
	
	if ($slick_carousel_slide_text != ""){
		$array_text = explode("||",$slick_carousel_slide_text);
	}
	
	if ($slick_carousel_slide_link != ""){
		$array_link = explode("||",$slick_carousel_slide_link);
	}
	
	$carousel_images = explode(",",$slick_carousel_images);
	
	// data attribute
	$data_attribute = "data-image-number='".$slick_carousel_image_number."' ";
	$data_attribute .= "data-image-number-move='".$slick_carousel_image_number_move."' ";
	$data_attribute .= "data-image-number-landscape='".$slick_carousel_image_number_landscape."' ";
	$data_attribute .= "data-image-number-move-landscape='".$slick_carousel_image_number_move_landscape."' ";
	$data_attribute .= "data-image-number-portrait='".$slick_carousel_image_number_portrait."' ";
	$data_attribute .= "data-image-number-move-portrait='".$slick_carousel_image_number_move_portrait."' ";
	$data_attribute .= "data-image-number-mobile='".$slick_carousel_image_number_mobile."' ";
	$data_attribute .= "data-image-number-move-mobile='".$slick_carousel_image_number_move_mobile."' ";
	$data_attribute .= "data-speed='".$slick_carousel_speed."' ";
	$data_attribute .= "data-fade='".$slick_carousel_fade."' ";
	$data_attribute .= "data-dots='".$slick_carousel_dots."' ";
	$data_attribute .= "data-infinite='".$slick_carousel_infinite."' ";
	$data_attribute .= "data-arrows='".$slick_carousel_arrows."' ";
	$data_attribute .= "data-autoplay='".$slick_carousel_autoplay."' ";
	$data_attribute .= "data-autoplay-speed='".$slick_carousel_autoplay_speed."' ";
	
	// container

	$output = "<div class='".create_modifier_class("slick-carousel",$modifier)." {$class} clearfix' id='{$id_element}'>";

		$output .= "<div class='".create_modifier_class("slick-carousel__container",$modifier)."' {$data_attribute}>";
			
			foreach($carousel_images as $key=>$img){
				$thumb = wp_get_attachment_image_src($img,"medium");
				$full = wp_get_attachment_image_src($img,"full");
				$output .= "<div class='".create_modifier_class("slick-carousel__container__slide",$modifier)."'>";
					$output .= "<div class='".create_modifier_class("slick-carousel__container__slide__link",$modifier)."'>";
						
						if (is_array($array_link)){
							if ($array_link[$key] != ""){
								$output .= "<a href='{$array_link[$key]}' target='_blank'>";
							}
						}
						
						$attachment = wp_get_attachment( $img );
						$output .= "<img title='{$attachment["title"]}' alt='{$attachment["alt"]}' src='".$thumb[0]."'>";
						
						$output .= "<div class='".create_modifier_class("slick-carousel__container__slide__link__content",$modifier)."'>";
						
							if ($slick_carousel_slide_title != ""){
								$output .= "<div class='".create_modifier_class("slick-carousel__container__slide__link__content__title",$modifier)."'>{$array_title[$key]}</div>";
							}
							
							if ($slick_carousel_slide_subtitle != ""){
								$output .= "<div class='".create_modifier_class("slick-carousel__container__slide__link__content__subtitle",$modifier)."'>{$array_subtitle[$key]}</div>";
							}
							
							if ($slick_carousel_slide_text != ""){
								$output .= "<div class='".create_modifier_class("slick-carousel__container__slide__link__content__text",$modifier)."'>{$array_text[$key]}</div>";
							}
						
						if (is_array($array_link)){
							if ($array_link[$key] != ""){
								$output .= "</a>";
							}
						}
						
						$output .= "</div>";
						
					$output .= "</div>";
				$output .= "</div>";
			}
				
		$output .= "</div>";
			
	$output .="</div>";

	return $output;
}

add_action( 'vc_before_init', 'slick_carousel_element' );

function slick_carousel_element(){

	vc_map( array(
		"name" => __("Carousel", 'private_modules'),
		"base" => "slick_carousel",
		"description" => "Elemento carousel di immagini",
		"icon" => "",
		"category" => __('private_modules', 'private_modules'),
		"params" => array(
			array(
				"type"        => "attach_images",
				"heading"     => __( "Immagini", 'private_modules' ),
				"param_name"  => "slick_carousel_images",
				"description" => __( "Seleziona le immagini da inserire nel carousel", 'private_modules' ),
				"group" => __( "Contenuto", 'private_modules' )
			),
			array(
				"type"        => "textarea",
				"heading"     => __( "Titoli in overlay", 'private_modules' ),
				"param_name"  => "slick_carousel_slide_title",
				"description" => __( "Titoli in overlay alle slide. Scriverli rispettando l'ordine delle slide e separare ogni titolo con ||.", 'private_modules' ),
				"group" => __( "Contenuto", 'private_modules' )
			),
			array(
				"type"        => "textarea",
				"heading"     => __( "Sottotitoli in overlay", 'private_modules' ),
				"param_name"  => "slick_carousel_slide_subtitle",
				"description" => __( "Sottotitoli in overlay alle slide. Scriverli rispettando l'ordine delle slide e separare ogni sottotitolo con ||.", 'private_modules' ),
				"group" => __( "Contenuto", 'private_modules' )
			),
			array(
				"type"        => "textarea",
				"heading"     => __( "Testi in overlay", 'private_modules' ),
				"param_name"  => "slick_carousel_slide_text",
				"description" => __( "Testi in overlay alle slide. Scriverli rispettando l'ordine delle slide e separare ogni testo con ||.", 'private_modules' ),
				"group" => __( "Contenuto", 'private_modules' )
			),
			array(
				"type"        => "textarea",
				"heading"     => __( "Link dei box", 'private_modules' ),
				"param_name"  => "slick_carousel_slide_link",
				"description" => __( "Inserire i link per ogni box (es. http://www.my-website.com). Scriverli rispettando l'ordine delle slide e separare ogni link con ||. In caso di link vuoto tra altri due link avremo quindi ||||", 'private_modules' ),
				"group" => __( "Contenuto", 'private_modules' )
			),
			array(
				"type"        => "textfield",
				"heading"     => __( "Immagini visibili", 'private_modules' ),
				"param_name"  => "slick_carousel_image_number",
				"value" => "1",
				"description" => __( "Seleziona quante immagini sono visibili", 'private_modules' ),
				"group" => __( "Impostazioni", 'private_modules' )
			),
			array(
				"type"        => "textfield",
				"heading"     => __( "Immagini in movimento", 'private_modules' ),
				"param_name"  => "slick_carousel_image_number_move",
				"value" => "1",
				"description" => __( "Seleziona quante immagini cambiano ogni volta", 'private_modules' ),
				"group" => __( "Impostazioni", 'private_modules' )
			),
			array(
				"type"        => "textfield",
				"heading"     => __( "Velocità animazione", 'private_modules' ),
				"param_name"  => "slick_carousel_speed",
				"value" => "2000",
				"description" => __( "Seleziona in millisendi la velocità di animazione", 'private_modules' ),
				"group" => __( "Impostazioni", 'private_modules' )
			),
			array(
				"type" => "checkbox",
				"heading" => __( "Effetto Fade", 'private_modules' ),
				"param_name" => "slick_carousel_fade",
				"value" => false,
				"description" => __( "Selezionare per avere un effetto di fade. SOLO per singola immagine", 'private_modules' ),
				"group" => __( "Impostazioni", 'private_modules' )
			),
			array(
				"type" => "checkbox",
				"heading" => __( "Pallini di navigazione", 'private_modules' ),
				"param_name" => "slick_carousel_dots",
				"value" => false,
				"description" => __( "Selezionare per avere i pallini di navigazione", 'private_modules' ),
				"group" => __( "Impostazioni", 'private_modules' )
			),
			array(
				"type" => "checkbox",
				"heading" => __( "Animazione infinita", 'private_modules' ),
				"param_name" => "slick_carousel_infinite",
				"value" => false,
				"description" => __( "Selezionare per avere un ciclo infinito di animazioni", 'private_modules' ),
				"group" => __( "Impostazioni", 'private_modules' )
			),
			array(
				"type" => "checkbox",
				"heading" => __( "Frecce di navigazione", 'private_modules' ),
				"param_name" => "slick_carousel_arrows",
				"value" => false,
				"description" => __( "Selezionare per avere le frecce di navigazione", 'private_modules' ),
				"group" => __( "Impostazioni", 'private_modules' )
			),
			array(
				"type" => "checkbox",
				"heading" => __( "Autoplay", 'private_modules' ),
				"param_name" => "slick_carousel_autoplay",
				"value" => false,
				"description" => __( "Selezionare per avere l'autoplay", 'private_modules' ),
				"group" => __( "Impostazioni", 'private_modules' )
			),
			array(
				"type"        => "textfield",
				"heading"     => __( "Velocità autoplay", 'private_modules' ),
				"param_name"  => "slick_carousel_autoplay_speed",
				"value" => "2000",
				"description" => __( "Seleziona in millisendi la velocità di autoplay", 'private_modules' ),
				"group" => __( "Impostazioni", 'private_modules' )
			),
			array(
				"type"        => "textfield",
				"heading"     => __( "Immagini visibili in tablet landscape", 'private_modules' ),
				"param_name"  => "slick_carousel_image_number_landscape",
				"value" => "1",
				"description" => __( "Seleziona quante immagini sono visibili in tablet landscape", 'private_modules' ),
				"group" => __( "Responsive", 'private_modules' )
			),
			array(
				"type"        => "textfield",
				"heading"     => __( "Immagini in movimento in tablet landscape", 'private_modules' ),
				"param_name"  => "slick_carousel_image_number_move_landscape",
				"value" => "1",
				"description" => __( "Seleziona quante immagini cambiano ogni volta in tablet landscape", 'private_modules' ),
				"group" => __( "Responsive", 'private_modules' )
			),
			array(
				"type"        => "textfield",
				"heading"     => __( "Immagini visibili in tablet portrait", 'private_modules' ),
				"param_name"  => "slick_carousel_image_number_portrait",
				"value" => "1",
				"description" => __( "Seleziona quante immagini sono visibili in tablet portrait", 'private_modules' ),
				"group" => __( "Responsive", 'private_modules' )
			),
			array(
				"type"        => "textfield",
				"heading"     => __( "Immagini in movimento in tablet portrait", 'private_modules' ),
				"param_name"  => "slick_carousel_image_number_move_portrait",
				"value" => "1",
				"description" => __( "Seleziona quante immagini cambiano ogni volta in tablet portrait", 'private_modules' ),
				"group" => __( "Responsive", 'private_modules' )
			),
			array(
				"type"        => "textfield",
				"heading"     => __( "Immagini visibili in mobile", 'private_modules' ),
				"param_name"  => "slick_carousel_image_number_mobile",
				"value" => "1",
				"description" => __( "Seleziona quante immagini sono visibili in mobile", 'private_modules' ),
				"group" => __( "Responsive", 'private_modules' )
			),
			array(
				"type"        => "textfield",
				"heading"     => __( "Immagini in movimento in mobile", 'private_modules' ),
				"param_name"  => "slick_carousel_image_number_move_mobile",
				"value" => "1",
				"description" => __( "Seleziona quante immagini cambiano ogni volta in mobile", 'private_modules' ),
				"group" => __( "Responsive", 'private_modules' )
			),
			array(
				"type" => "textfield",
				"heading" => __( "ID contenitore", 'private_modules' ),
				"param_name" => "id_element",
				"description" => __( "ID dell'elemento", 'private_modules' ),
				"group" => __( "Opzioni css", 'private_modules' )
			),
			array(
				"type" => "textfield",
				"heading" => __( "Classe contenitore", 'private_modules' ),
				"param_name" => "class",
				"description" => __( "Classe aggiuntiva del contenitore", 'private_modules' ),
				"group" => __( "Opzioni css", 'private_modules' )
			),
			array(
				"type" => "textfield",
				"heading" => __( "Modificatore", 'private_modules' ),
				"param_name" => "modifier",
				"description" => __( "Nome modificatore in ottica BEM. Non aggiungere --. Separare eventuali altri modificatori con uno spazio", 'private_modules' ),
				"group" => __( "Opzioni css", 'private_modules' )
			),

		)
	));
}
