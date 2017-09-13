<?php 


/********************************************
* Title element
********************************************/

add_shortcode( 'cf7_newsletter', 'cf7_newsletter_definition' );

function cf7_newsletter_definition( $atts) {
	extract( shortcode_atts( array(
		'title' => '',
		'text' => '',
		'cf7code' => '',
		'title_format' => '',
		'align' => '',
		'class' => '',
		'id_element' => ''
	), $atts ) );
	
	// CONTAINER 
	
	$modifier = "";
	
	switch ($align) {
		case "Centrato":
			$modifier = "";
			break;
		case "A sinistra":
			$modifier = "alignleft ";
			break;
		case "A destra":
			$modifier = "alignright ";
			break;
	}
	
	$output = "<div class='".create_modifier_class("cf7-newsletter",$modifier)." {$class}' id='{$id_element}'>";
		
	// TITLE

	$open_format = "<div>";
	$close_format = "</div>";
	
	switch ($title_format) {
		case "Testo semplice":
			break;
		case "H1":
			$open_format = "<h1>";
			$close_format = "</h1>";
			break;
		case "H2":
			$open_format = "<h2>";
			$close_format = "</h2>";
			break;
		case "H3":
			$open_format = "<h3>";
			$close_format = "</h3>";
			break;
		case "H4":
			$open_format = "<h4>";
			$close_format = "</h4>";
			break;
		case "H5":
			$open_format = "<h5>";
			$close_format = "</h5>";
			break;
		case "H6":
			$open_format = "<h6>";
			$close_format = "</h6>";
			break;
	}
	
	$output .= "<div class='".create_modifier_class("cf7-newsletter__title",$modifier)."'>".$open_format.$title.$close_format."</div>";
	
	// TEXT
	if ($text != ""){
		$output .= "<div class='".create_modifier_class("cf7-newsletter__text",$modifier)."'>{$text}</div>";
	}
	
	// SHORTCODE
	$cf7code = format_shortcode($cf7code);
	$cf7code = do_shortcode($cf7code);
	$output .= "<div class='".create_modifier_class("cf7-newsletter__form",$modifier)."'>$cf7code</div>";
	
	// END CONTAINER
	
	$output .= "</div>";

	return $output;
}

add_action( 'vc_before_init', 'cf7_newsletter' );

function cf7_newsletter(){

	vc_map( array(
		"name" => __("CF7 newsletter", 'private_modules'),
		"base" => "cf7_newsletter",
		"description" => "Titolo, testo e codice generato da uno shortcode CF7",
		"icon" => "",
		"category" => __('private_modules', 'private_modules'),
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => __( "Titolo", 'private_modules' ),
				"param_name" => "title",
				"description" => __( "Inserire qui il titolo", 'private_modules' ),
				"group" => __( "Contenuti", 'private_modules' )
			),
			array(
				"type" => "textfield",
				"heading" => __( "Testo", 'private_modules' ),
				"param_name" => "text",
				"description" => __( "Inserire eventuale testo", 'private_modules' ),
				"group" => __( "Contenuti", 'private_modules' )
			),
			array(
				"type" => "textfield",
				"heading" => __( "Shortcode CF7", 'private_modules' ),
				"param_name" => "cf7code",
				"description" => __( "Inserire lo short code ", 'private_modules' ),
				"group" => __( "Contenuti", 'private_modules' )
			),
			array(
				"type" => "dropdown",
				"heading" => __( "Formattazione titolo", 'private_modules' ),
				"param_name" => "title_format",
				"value" => array(__("Testo semplice",'private_modules'),__("H1",'private_modules'),__("H2",'private_modules'),__("H3",'private_modules'),__("H4",'private_modules'),__("H5",'private_modules'),__("H6",'private_modules')),
				"description" => __( "Seleziona il formato del titolo", 'private_modules' ),
				"group" => __( "Impostazioni", 'private_modules' )
			),
			array(
				"type" => "dropdown",
				"heading" => __( "Allineamento", 'private_modules' ),
				"param_name" => "align",
				"value" => array(__("Centrato",'private_modules'),__("A sinistra",'private_modules'),__("A destra",'private_modules')),
				"description" => __( "Seleziona la posizione di titolo e testo", 'private_modules' ),
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
		)
	));
}