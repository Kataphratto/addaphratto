<?php 


/********************************************
* Title element
********************************************/

add_shortcode( 'title_element', 'title_element_definition' );

function title_element_definition( $atts) {
	extract( shortcode_atts( array(
		'title' => '',
		'title_format' => '',
		'title_size' => '',
		'title_align' => '',
		'title_modifier' => '',
		'sub_title' => '',
		'sub_title_format' => '',
		'sub_title_size' => '',
		'sub_title_align' => '',
		'sub_title_modifier' => '',
		'sub_title_link' => '',
		'class' => '',
	), $atts ) );
	
	// CONTAINER 

	$modifier = "";
	
	$output = "<div class='".create_modifier_class("title_element",$class)." '>";
		
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
	
	switch ($title_size) {
		case "Normale":
			$modifier .= "";
			break;
		case "Grande":
			$modifier .= " big";
			break;
		case "Piccolo":
			$modifier .= " small";
			break;
	}
	
	switch ($title_align) {
		case "Centrato":
			$modifier .= "";
			break;
		case "A sinistra":
			$modifier .= " alignleft";
			break;
		case "A destra":
			$modifier .= " alignright";
			break;
	}
	
	if ($title_modifier != ""){
		$modifier .= " ".$title_modifier;
	}
	
	if ($sub_title != ""){
		$modifier .= " with-sub_title";
	}
	
	if ($title != ""){
		$output .= $titleOpenTag." class='".create_modifier_class("title_element__title",$modifier)."'>{$title}".$titleCloseTag;
	}
	

	
	// SUBTITLE
	
	if ($sub_title != ""){
	
		$modifier = "";
		
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
		
		switch ($sub_title_size) {
			case "Normale":
				$modifier .= "";
				break;
			case "Grande":
				$modifier .= " big";
				break;
			case "Piccolo":
				$modifier .= " small";
				break;
		}
		
		switch ($sub_title_align) {
			case "Centrato":
				$modifier .= "";
				break;
			case "A sinistra":
				$modifier .= " alignleft";
				break;
			case "A destra":
				$modifier .= " alignright";
				break;
		}
		
		if ($sub_title_modifier != ""){
			$modifier .= " ".$sub_title_modifier;
		}
		
		if ($sub_title != ""){
			$output .= $subTitleOpenTag." class='".create_modifier_class("title_element__sub_title",$modifier)."'>{$sub_title}";

			if ($sub_title_link != ""){
				$output .= "<a class='title_element__arrow-link' href='{$sub_title_link}'></a>";
			}

			$output .= $subTitleCloseTag;
		}
		
	}
	
	$output .= "</div>";

	return $output;
}

add_action( 'vc_before_init', 'title_element_element' );

function title_element_element(){

	vc_map( array(
		"name" => __("Elemento titolo + sottotitolo", 'private_modules'),
		"base" => "title_element",
		"description" => "Elemento testuale con titolo e sottotitolo",
		"icon" => "",
		"category" => __('private_modules', 'private_modules'),
		"params" => array(
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
				"type" => "dropdown",
				"heading" => __( "Dimensione", 'private_modules' ),
				"param_name" => "title_size",
				"value" => array(__("Normale",'private_modules'),__("Grande",'private_modules'),__("Piccolo",'private_modules')),
				"description" => __( "Seleziona la dimensione del titolo. Utile in caso di selezione di testo semplice", 'private_modules' ),
				"group" => __( "Titolo", 'private_modules' )
			),
			array(
				"type" => "dropdown",
				"heading" => __( "Allineamento", 'private_modules' ),
				"param_name" => "title_align",
				"value" => array(__("Centrato",'private_modules'),__("A sinistra",'private_modules'),__("A destra",'private_modules')),
				"description" => __( "Seleziona la posizione del titolo", 'private_modules' ),
				"group" => __( "Titolo", 'private_modules' )
			),
			array(
				"type" => "textfield",
				"heading" => __( "Modificatore Titolo", 'private_modules' ),
				"param_name" => "title_modifier",
				"description" => __( "Nome modificatore per il titolo", 'private_modules' ),
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
				"type" => "dropdown",
				"heading" => __( "Dimensione", 'private_modules' ),
				"param_name" => "sub_title_size",
				"value" => array(__("Normale",'private_modules'),__("Grande",'private_modules'),__("Piccolo",'private_modules')),
				"description" => __( "Seleziona la dimensione del sottotitolo. Utile in caso di selezione di testo semplice", 'private_modules' ),
				"group" => __( "Sottotitolo", 'private_modules' )
			),
			array(
				"type" => "dropdown",
				"heading" => __( "Allineamento", 'private_modules' ),
				"param_name" => "sub_title_align",
				"value" => array(__("Centrato",'private_modules'),__("A sinistra",'private_modules'),__("A destra",'private_modules')),
				"description" => __( "Seleziona la posizione del sottotitolo", 'private_modules' ),
				"group" => __( "Sottotitolo", 'private_modules' )
			),
			array(
				"type" => "textfield",
				"heading" => __( "Link blocco", 'private_modules' ),
				"param_name" => "sub_title_link",
				"description" => __( "Inserire link se presente", 'private_modules' ),
				"group" => __( "Sottotitolo", 'private_modules' )
			),
			array(
				"type" => "textfield",
				"heading" => __( "Modificatore sottotitolo", 'private_modules' ),
				"param_name" => "sub_title_modifier",
				"description" => __( "Nome modificatore del sottotitolo", 'private_modules' ),
				"group" => __( "Sottotitolo", 'private_modules' )
			),
			array(
				"type" => "textfield",
				"heading" => __( "Modificatore contenitore", 'private_modules' ),
				"param_name" => "class",
				"description" => __( "Nome modificatore per il container del titolo", 'private_modules' ),
				"group" => __( "Opzioni css", 'private_modules' )
			),
		)
	));
}