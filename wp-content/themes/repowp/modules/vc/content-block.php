<?php 


/********************************************
* Content Block
********************************************/

add_shortcode( 'content_block', 'content_block_definition' );

function content_block_definition( $atts) {
	extract( shortcode_atts( array(
		'class' => '',
		'block_align' => '',
		'content_style' => '',
		'title' => '',
		'title_format' => '',
		'sub_title' => '',
		'sub_title_format' => '',
		'text_paragraph' => '',
		'button_url' => '',
		'button_label' => ''
	), $atts ) );
	
	// CONTAINER 

	$modifier = "";

	$wrapper_modifier = "";
	
	$output = "<div class='".create_modifier_class("content-block",$class)." '>";
	
	switch ($block_align) {

		case "Sinistra":
		
		$wrapper_modifier = "left";
		
			break;

		case "Centro":
		
		$wrapper_modifier = "center";
		
			break;

		case "Destra":
		
		$wrapper_modifier = "right";
		
			break;
	}
	
	switch ($content_style) {

		case "Stile chiaro":
		
		$wrapper_modifier .= " light";
		
			break;

		case "Stile scuro":
		
		$wrapper_modifier .= " dark";
		
			break;
	}

	$output .= "<div class='".create_modifier_class("content-block__wrapper",$wrapper_modifier)." '>";
		
	// TITLE
	

	$titleOpenTag = "<div";
	$titleCloseTag = "</div>";

	$subTitleOpenTag = "<div";
	$subTitleCloseTag = "</div>";
	
	switch ($title_format) {
		case "Testo semplice":
			break;
		case "H1":

			$titleOpenTag = "<h1";
			$titleCloseTag = "</h1>";

			break;
		case "H2":

		$titleOpenTag = "<h2";
		$titleCloseTag = "</h2>";

			break;
		case "H3":

		$titleOpenTag = "<h3";
		$titleCloseTag = "</h3>";

			break;
		case "H4":

		$titleOpenTag = "<h4";
		$titleCloseTag = "</h4>";

			break;
		case "H5":

		$titleOpenTag = "<h5";
		$titleCloseTag = "</h5>";

			break;
		case "H6":

		$titleOpenTag = "<h6";
		$titleCloseTag = "</h6>";

			break;
	}
	
	if ($sub_title != ""){
		$modifier .= " with-sub_title";
	}
	
	if ($title != ""){
		$output .= $titleOpenTag." class='".create_modifier_class("content-block__wrapper__title",$modifier)."'>{$title}".$titleCloseTag;
	}
	
	// SUBTITLE
	
	if ($sub_title != ""){
			
		switch ($sub_title_format) {
			case "Testo semplice":
			break;
		case "H1":

			$subTitleOpenTag = "<h1";
			$subTitleCloseTag = "</h1>";

			break;
		case "H2":

		$subTitleOpenTag = "<h2";
		$subTitleCloseTag = "</h2>";

			break;
		case "H3":

		$subTitleOpenTag = "<h3";
		$subTitleCloseTag = "</h3>";

			break;
		case "H4":

		$subTitleOpenTag = "<h4";
		$subTitleCloseTag = "</h4>";

			break;
		case "H5":

		$subTitleOpenTag = "<h5";
		$subTitleCloseTag = "</h5>";

			break;
		case "H6":

		$subTitleOpenTag = "<h6";
		$subTitleCloseTag = "</h6>";

			break;
		}
		
		if ($sub_title != ""){
			$output .= $subTitleOpenTag." class='".create_modifier_class("content-block__wrapper__sub_title",$modifier)."'>{$sub_title}" . $subTitleCloseTag;
		}
		
	}

	//TEXT
	
	if ($text_paragraph != ""){
		$output .= "<p class='content-block__wrapper__paragraph'>{$text_paragraph}</p>";
	}

	//BTN
	
	if ($button_label != "" && $button_url != ""){
		$output .= "<a href=".$button_url." class='easy-button content-block__wrapper__button'>{$button_label}</a>";
	}
	
	$output .= "</div></div>";

	return $output;
}

add_action( 'vc_before_init', 'content_block_element' );

function content_block_element(){

	vc_map( array(
		"name" => __("Contenuto Fascia", 'private_modules'),
		"base" => "content_block",
		"description" => "Contenuto con Intestazione, testo e bottone",
		"icon" => "",
		"category" => __('private_modules', 'private_modules'),
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => __( "Classe contenitore", 'private_modules' ),
				"param_name" => "class",
				"description" => __( "Classe css per il contenitore", 'private_modules' ),
				"group" => __( "Opzioni di stile", 'private_modules' )
			),
			array(
				"type" => "dropdown",
				"heading" => __( "Stile contenitore", 'private_modules' ),
				"param_name" => "content_style",
				"value" => array(__("",'private_modules'),__("Stile chiaro",'private_modules'),__("Stile scuro",'private_modules')),
				"description" => __( "Classe css per il contenitore", 'private_modules' ),
				"group" => __( "Opzioni di stile", 'private_modules' )
			),
			array(
				"type" => "dropdown",
				"heading" => __( "Allineamento contenuto", 'private_modules' ),
				"param_name" => "block_align",
				"value" => array(__("",'private_modules'),__("Sinistra",'private_modules'),__("Centro",'private_modules'),__("Destra",'private_modules')),
				"description" => __( "Selezionare un valore", 'private_modules' ),
				"group" => __( "Opzioni di stile", 'private_modules' )
			),
			array(
				"type" => "textfield",
				"heading" => __( "Titolo", 'private_modules' ),
				"param_name" => "title",
				"description" => __( "Inserire qui il titolo", 'private_modules' ),
				"group" => __( "Titolo", 'private_modules' )
			),
			array(
				"type" => "dropdown",
				"heading" => __( "Formattazione titolo", 'private_modules' ),
				"param_name" => "title_format",
				"value" => array(__("Testo semplice",'private_modules'),__("H1",'private_modules'),__("H2",'private_modules'),__("H3",'private_modules'),__("H4",'private_modules'),__("H5",'private_modules'),__("H6",'private_modules')),
				"description" => __( "Seleziona il formato del titolo", 'private_modules' ),
				"group" => __( "Titolo", 'private_modules' )
			),
			array(
				"type" => "textfield",
				"heading" => __( "Sottotitolo", 'private_modules' ),
				"param_name" => "sub_title",
				"description" => __( "Inserire l'eventuale sottotitolo", 'private_modules' ),
				"group" => __( "Sottotitolo", 'private_modules' )
			),
			array(
				"type" => "dropdown",
				"heading" => __( "Formattazione titolo", 'private_modules' ),
				"param_name" => "sub_title_format",
				"value" => array(__("Testo semplice",'private_modules'),__("H1",'private_modules'),__("H2",'private_modules'),__("H3",'private_modules'),__("H4",'private_modules'),__("H5",'private_modules'),__("H6",'private_modules')),
				"description" => __( "Seleziona il formato del sottotitolo", 'private_modules' ),
				"group" => __( "Sottotitolo", 'private_modules' )
			),
			array(
				"type" => "textarea",
				"heading" => __( "Testo paragrafo", 'private_modules' ),
				"param_name" => "text_paragraph",
				"description" => __( "Inserire qui il paragrafo di testo", 'private_modules' ),
				"group" => __( "Testo paragrafo", 'private_modules' )
			),
			array(
				"type" => "textfield",
				"heading" => __( "Testo Bottone", 'private_modules' ),
				"param_name" => "button_label",
				"description" => __( "Inserire qui il testo del bottone", 'private_modules' ),
				"group" => __( "Bottone", 'private_modules' )
			),
			array(
				"type" => "textfield",
				"heading" => __( "Indirizzo Url Bottone", 'private_modules' ),
				"param_name" => "button_url",
				"description" => __( "Inserire qui l'indirizzo url del bottone", 'private_modules' ),
				"group" => __( "Bottone", 'private_modules' )
			)
		)
	));
}