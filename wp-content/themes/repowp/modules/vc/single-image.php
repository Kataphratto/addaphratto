<?php 


/*************************************************************************
* Element with single image
**************************************************************************/

add_shortcode( 'single_image', 'single_image_definition' );

function single_image_definition( $atts) {
	extract( shortcode_atts( array(
		'image' => '',
		'image_size' =>  __("Standard",'private_modules'),
		'modifier' => '',
		'class' => '',
		'id_element' => ''
	), $atts ) );
	
	switch ($image_size) {
		case "Standard":
			break;
		case "Full":
			$modifier .= " full";
			break;
	}

	// html generation
	
	$attachment = wp_get_attachment( $image );
	$image = "<img title='{$attachment["title"]}' alt='{$attachment["alt"]}' src='{$attachment["src"]}'>";
	
	$output = "<div class='".create_modifier_class("single-image",$modifier)." {$class}' id='{$id_element}'>{$image}</div>";

	return $output;
}

add_action( 'vc_before_init', 'single_image_element' );

function single_image_element(){

	vc_map( array(
		"name" => __("Elemento immagine", 'private_modules'),
		"base" => "single_image",
		"description" => "Singola immagine",
		"icon" => "",
		"category" => __('private_modules', 'private_modules'),
		"params" => array(
			array(
				"type" => "attach_image",
				"heading" => __( "Immagine", 'private_modules' ),
				"param_name" => "image",
				"description" => __( "Seleziona l'immagine", 'private_modules' ),
				"group" => __( "Contenuto", 'private_modules' )
			),
			array(
				"type" => "dropdown",
				"heading" => __( "Dimensioni immagine", 'private_modules' ),
				"param_name" => "image_size",
				"value" => array(__("Standard",'private_modules'), __("Full",'private_modules')),
				"description" => __( "Seleziona la dimensione:<br>Standard : larga al massimo la sua dimensione naturale<br>Full : larga quanto il contenitore", 'private_modules' ),
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
}


 
 
 
 
