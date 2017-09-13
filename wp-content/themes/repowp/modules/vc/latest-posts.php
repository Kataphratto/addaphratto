<?php 


/********************************************
* Latest posts
********************************************/

add_shortcode( 'latest_post', 'latest_post_definition' );

function latest_post_definition( $atts) {
	extract( shortcode_atts( array(
		'post_type' => '',
		'post_period' => '',
		'post_number' => '1',
		'post_number_line' => '1',
		'elements_order' => __("Titolo - Foto - Data",'private_modules'),
		'checkbox_title' => '',
		'checkbox_link_title' => '',
		'checkbox_date' => '',
		'date_format' => __("Formato 1",'private_modules'),
		'checkbox_before_text' => '',
		'checkbox_text' => '',
		'checkbox_image' => '',
		'image_position' => __("Standard",'private_modules'),
		'checkbox_link_image' => '',
		'checkbox_link' => '',
		'text_link' => __( "Scopri di più", 'private_modules' ),
		'preview_text_width' => "35",
		'class' => '',
		'modifier' => '',
		'id_element' => ''
	), $atts ) );

	$post_date = '';
	
	if ($image_position == "A destra del testo"){
		$modifier .= " img-right";
	}
	if ($image_position == "A sinistra del testo"){
		$modifier .= " img-left";
	}
	
	// container

	$output = "<div class='".create_modifier_class("latest-posts",$modifier)." {$class} clearfix' id='{$id_element}'>";
	
	
	// cerco ora in base alla label ricevuta il nome del custom post type desiderato, selezionando "post" come default
	$type = "post";
	$args = array(
		'public'   => true
	);
	
	$objects = 'objects'; // names or objects, note names is the default
	$operator = 'and'; // 'and' or 'or'
	$post_types = get_post_types( $args, $objects, $operator ); 
	
	$array_nomi = array();
	
	foreach ( $post_types  as $single_post_type ) {
		if ($single_post_type->label == $post_type){$type = $single_post_type->name;}
	}
	
	$array_date = array();
	$order = "DESC";
	
	if ($post_period == "Futuri"){
		$order = "ASC";
		$today = date("Y-m-d");
		$array_date = array(
			'column'  => 'post_date',
			'after'   => $today
		);
	}
	if ($post_period == "Passati"){
		$order = "DESC";
		$today = date("Y-m-d");
		$array_date = array(
			'column'  => 'post_date',
			'before'   => $today
		);
	}
	
	$post_number = intval($post_number);
	
	$post_number_line = intval($post_number_line);
	
	if ( ($post_number_line >= 1) && ($post_number_line <= 6) ){}
	else{
		$post_number_line = 1;
	}
	
	$boxLineNumberClass = "boxLineNumber-".$post_number_line;
	
	// imposto la query
	$wpquery = new WP_Query(array(
		'post_type'      => $type,
		'posts_per_page' => $post_number,
		'orderby' => 'date',
		'order' => $order,
		'date_query'    => $array_date
	));
	
	// if no result rebuild query
	
	if ($wpquery->post_count == 0){
		$wpquery = new WP_Query(array(
			'post_type'      => $type,
			'posts_per_page' => $post_number,
			'orderby' => 'date',
			'order' => 'DESC'
		));
	}
	
	// line container
	$tot_row = floor($post_number/$post_number_line);
	$row = 1;
	$count = 0;
	$tot_count = 0;
	$image = "";

	$output .="<ul class='{$boxLineNumberClass} ".create_modifier_class("latest-posts__row-posts",$modifier)."'>";
	
	while ($wpquery->have_posts()): $wpquery->the_post();
			
			$postid = get_the_ID();
			
			// single container
			
			$output .="<li class='".create_modifier_class("latest-posts__row-posts__single-post",$modifier)."'>";
			
			// title
			
			if ($checkbox_title == "true"){
				$title = "<div class='".create_modifier_class("latest-posts__row-posts__single-post__text-block__title",$modifier)."'>";
				
				if ($checkbox_link_title == "true"){
					$title .= "<a href='".get_permalink()."'>";
				}
				
				$title .= get_the_title();
				
				if ($checkbox_link_title == "true"){
					$title .= "</a>";
				}
				
				$title .= "</div>";
			}
			
			// image
			
			if ($checkbox_image == "true"){
				$image = "<div class='".create_modifier_class("latest-posts__row-posts__single-post__img-block",$modifier)."'>";
				
				if ($checkbox_link_image == "true"){
					$image .= "<a href='".get_permalink()."'>";
				}
				
				$attachment = wp_get_attachment( get_post_thumbnail_id($postid) );
				$image .= "<img title='{$attachment["title"]}' alt='{$attachment["alt"]}' src='{$attachment["src"]}'>";
				
				if ($checkbox_link_image == "true"){
					$image .= "</a>";
				}
				
				$image .= "</div>";
			}
			
			// date
			
			if ($checkbox_date == "true"){
			
				if ($date_format == "Formato 1"){
					$post_date = get_the_date("d M").". ".__("dalle", 'private_modules')." ".get_the_date("G:i");
				}
				if ($date_format == "Formato 2"){
					$post_date = get_the_date("l d F Y")."<br>".__("a partire dalle", 'private_modules')." ".get_the_date("G:i");
				}
				if ($date_format == "Formato 3"){
					$post_date = __("suonato il", 'private_modules')." ".get_the_date("d F Y");
				}
				if ($date_format == "Formato 4"){
					$post_date = get_the_date("d F Y");
				}
				if ($date_format == "Formato 5"){
					$post_date = get_the_date("d/m/Y");
				}
				
				$replace_text = get_field("testo_sostitutivo_data", $postid);
				
				if ($replace_text != ""){
					$post_date = $replace_text;
				}
				
				$post_date = "<div class='".create_modifier_class("latest-posts__row-posts__single-post__text-block__eventdate",$modifier)."'>{$post_date}</div>";
			}
			
			// html unification
			
		
			$output .= "<div class='".create_modifier_class("latest-posts__row-posts__single-post__text-block",$modifier)."' clearfix>";
		
			if ($elements_order == "Titolo - Foto - Data"){
				$output .= $title;
				if ($image_position == "Standard"){
					$output .= $image;
				}
				$output .= $post_date;
			}
			
			if ($elements_order == "Titolo - Data - Foto"){
				$output .= $title;
				$output .= $post_date;
				if ($image_position == "Standard"){
					$output .= $image;
				}
			}
			
			if ($elements_order == "Foto - Titolo - Data"){
				if ($image_position == "Standard"){
					$output .= $image;
				}
				$output .= $title;
				$output .= $post_date;
			}
			
			if ($elements_order == "Foto - Data - Titolo"){
				if ($image_position == "Standard"){
					$output .= $image;
				}
				$output .= $post_date;
				$output .= $title;
			}
			
			if ($elements_order == "Data - Titolo - Foto"){
				$output .= $post_date;
				$output .= $title;
				if ($image_position == "Standard"){
					$output .= $image;
				}
			}
			
			if ($elements_order == "Data - Foto - Titolo"){
				$output .= $post_date;
				if ($image_position == "Standard"){
					$output .= $image;
				}
				$output .= $title;
			}
			
			// element before text
			
			if ($checkbox_before_text == "true"){
				$pre_text = get_field("pre_testo", $postid);
				
				if ($pre_text != ""){
					$output .= "<div class='".create_modifier_class("latest-posts__row-posts__single-post__text-block__pre-text",$modifier)."'>{$pre_text}</div>";
				}
			}
			
			// text
			
			if ($checkbox_text == "true"){
				$testo = get_the_excerpt();
				$output .= "<div class='".create_modifier_class("latest-posts__row-posts__single-post__text-block__text",$modifier)."'>".limit_text($testo,$preview_text_width)."</div>";
			}
			
			// permalink
			
			if ($checkbox_link == "true"){
				$output .= "<div class='".create_modifier_class("latest-posts__row-posts__single-post__text-block__postlink",$modifier)."'><a href='".get_permalink()."'>{$text_link}</a></div>";
			}
			
			// not standard img position output
			if ($image_position == "Standard"){
				$output .="</div>";
			}
			else {
				$output .="</div>";
				$output .= $image;
			}
			
			$output .="<div class='clearfix'></div></li>";
			
			$count += 1;
			$tot_count +=1;
			
			if ($count == $post_number_line){
				$count = 0;
				$row += 1;
				if ($tot_row == $row){
					$modifier .= " last-row";
				}
				$output .="</ul>";
				
				if( $tot_count < $post_number ){
					$output .="<ul class='{$boxLineNumberClass} ".create_modifier_class("latest-posts__row-posts",$modifier)."'>";
				}
			}

	endwhile; 
	wp_reset_postdata();
	
	// closing row-posts
	$output .= "</ul>";
	
	$output .= "</div>";

	return $output;
}

add_action( 'vc_before_init', 'latest_post_element' );

function latest_post_element(){

	add_action('admin_init', function(){
	
		$args = array(
			'public'   => true
		);
		$objects = 'objects'; // names or objects, note names is the default
		$operator = 'and'; // 'and' or 'or'
		$post_types = get_post_types( $args, $objects, $operator ); 
		
		$array_names = array();
		
		foreach ( $post_types  as $post_type ) {
			array_push($array_names,$post_type->label);
		}

		vc_map( array(
			"name" => __("Ultimi Posts", 'private_modules'),
			"base" => "latest_post",
			"description" => "Elemento per mostrare gli ultimi n elementi di un custom post type",
			"icon" => "",
			"category" => __('private_modules', 'private_modules'),
			"params" => array(
				array(
					"type"        => "dropdown",
					"heading"     => __( "Post type", 'private_modules' ),
					"param_name"  => "post_type",
					"value" => $array_names,
					"description" => __( "Seleziona la tipologia di post da cui estrarre gli ultimi elementi", 'private_modules' ),
					"group" => __( "Contenuto", 'private_modules' )
				),
				array(
					"type"        => "dropdown",
					"heading"     => __( "Periodo post", 'private_modules' ),
					"param_name"  => "post_period",
					"value" => array(__("Tutti",'private_modules'),__("Futuri",'private_modules'),__("Passati",'private_modules')),
					"description" => __( "Seleziona quali post devono essere cercati e pubblicati in base alla data di visualizzazione", 'private_modules' ),
					"group" => __( "Contenuto", 'private_modules' )
				),
				array(
					"type" => "dropdown",
					"heading" => __( "Ordine elmenti", 'private_modules' ),
					"param_name" => "elements_order",
					"value" => array(
						__("Titolo - Foto - Data",'private_modules'),
						__("Titolo - Data - Foto",'private_modules'),
						__("Foto - Titolo - Data",'private_modules'),
						__("Foto - Data - Titolo",'private_modules'),
						__("Data - Titolo - Foto",'private_modules'),
						__("Data - Foto - Titolo",'private_modules'),
					),
					"description" => __( "Seleziona l'ordine degli elementi", 'private_modules' ),
					"group" => __( "Impostazioni", 'private_modules' )
				),
				array(
					"type" => "textfield",
					"heading" => __( "Numero post", 'private_modules' ),
					"param_name" => "post_number",
					"value" => "1",
					"description" => __( "Numero totale dei post da mostrare.", 'private_modules' ),
					"group" => __( "Impostazioni", 'private_modules' )
				),
				array(
					"type" => "textfield",
					"heading" => __( "Numero post per ogni riga", 'private_modules' ),
					"param_name" => "post_number_line",
					"value" => "1",
					"description" => __( "Numero totale dei post da mostrare in ogni riga. Max 6", 'private_modules' ),
					"group" => __( "Impostazioni", 'private_modules' )
				),
				array(
					"type" => "checkbox",
					"heading" => __( "Mostra titolo", 'private_modules' ),
					"param_name" => "checkbox_title",
					"value" => true,
					"description" => __( "Selezionare per visualizzare il titolo del post", 'private_modules' ),
					"group" => __( "Impostazioni", 'private_modules' )
				),
				array(
					"type" => "checkbox",
					"heading" => __( "Titolo linkabile", 'private_modules' ),
					"param_name" => "checkbox_link_title",
					"value" => false,
					"description" => __( "Selezionare per far linkare il titolo al post", 'private_modules' ),
					"group" => __( "Impostazioni", 'private_modules' )
				),
				array(
					"type" => "checkbox",
					"heading" => __( "Mostra data o testo sostitutivo alla data", 'private_modules' ),
					"param_name" => "checkbox_date",
					"value" => true,
					"description" => __( "Selezionare per visualizzare la data del post o il campo sostitutivo [ACF nome : testo_sostitutivo_data]", 'private_modules' ),
					"group" => __( "Impostazioni", 'private_modules' )
				),
				array(
					"type"        => "dropdown",
					"heading"     => __( "Formato data", 'private_modules' ),
					"param_name"  => "date_format",
					"value" => array(__("Formato 1",'private_modules'),__("Formato 2",'private_modules'),__("Formato 3",'private_modules'),__("Formato 4",'private_modules'),__("Formato 5",'private_modules')),
					"description" => __( "Seleziona il formato della data:<br><br>Formato 1: 16 Ago. dalle 21:30<br>Formato 2: sabato 16 Agosto 2016 a partire dalle 21:30<br>Formato 3: suonato il 16 Agosto 2016<br>Formato 4: 16 Agosto 2016<br>Formato 5: 16/08/2016<br>", 'private_modules' ),
					"group" => __( "Impostazioni", 'private_modules' )
				),
				array(
					"type" => "checkbox",
					"heading" => __( "Mostra ACF prima del testo", 'private_modules' ),
					"param_name" => "checkbox_before_text",
					"value" => false,
					"description" => __( "Selezionare per visualizzare elemento ACF prima del testo [ACF nome : pre_testo]", 'private_modules' ),
					"group" => __( "Impostazioni", 'private_modules' )
				),
				array(
					"type" => "checkbox",
					"heading" => __( "Mostra testo", 'private_modules' ),
					"param_name" => "checkbox_text",
					"value" => true,
					"description" => __( "Selezionare per visualizzare il testo del post", 'private_modules' ),
					"group" => __( "Impostazioni", 'private_modules' )
				),
				array(
					"type" => "checkbox",
					"heading" => __( "Mostra immagine", 'private_modules' ),
					"param_name" => "checkbox_image",
					"value" => true,
					"description" => __( "Selezionare per visualizzare l'immagine del post", 'private_modules' ),
					"group" => __( "Impostazioni", 'private_modules' )
				),
				array(
					"type" => "dropdown",
					"heading" => __( "Posizione immagine", 'private_modules' ),
					"param_name" => "image_position",
					"value" => array(__("Standard",'private_modules'),__("A destra del testo",'private_modules'),__("A sinistra del testo",'private_modules')),
					"description" => __( "Se non standard l'ordine della foto rispetto agli altri elementi sarà ignorata", 'private_modules' ),
					"group" => __( "Impostazioni", 'private_modules' )
				),
				array(
					"type" => "checkbox",
					"heading" => __( "Immagine linkabile", 'private_modules' ),
					"param_name" => "checkbox_link_image",
					"value" => true,
					"description" => __( "Selezionare per far linkare l'immagine al post", 'private_modules' ),
					"group" => __( "Impostazioni", 'private_modules' )
				),
				array(
					"type" => "checkbox",
					"heading" => __( "Mostra link", 'private_modules' ),
					"param_name" => "checkbox_link",
					"value" => true,
					"description" => __( "Selezionare per visualizzare il link al post", 'private_modules' ),
					"group" => __( "Impostazioni", 'private_modules' )
				),
				array(
					"type" => "textfield",
					"heading" => __( "Testo link", 'private_modules' ),
					"param_name" => "text_link",
					"value" => __( "Scopri di più", 'private_modules' ),
					"description" => __( "Testo del link al post", 'private_modules' ),
					"group" => __( "Impostazioni", 'private_modules' )
				),
				array(
					"type" => "textfield",
					"heading" => __( "Lunghezza preview testo", 'private_modules' ),
					"param_name" => "preview_text_width",
					"value" => "35",
					"description" => __( "Numero parole visibili nell'anteprima del post", 'private_modules' ),
					"group" => __( "Impostazioni", 'private_modules' )
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
    });
}
