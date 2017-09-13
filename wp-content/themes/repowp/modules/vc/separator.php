<?php 

/********************************************
* Separator element
********************************************/

add_shortcode( 'separator', 'separator_definition' );

function separator_definition( $atts) {
	extract( shortcode_atts( array(
		'type' => __("Singolo",'private_modules'),
		'class' => '',
		'modifier' => '',
		'id_element' => ''
	), $atts ) );
	
	if ($type == "Singolo"){
		$modifier .= " single";
	}
	if ($type == "Singolo sfumato"){
		$modifier .= " single-blur";
	}
	if ($type == "Doppio"){
		$modifier .= " double";
	}

	$output = "<div class='".create_modifier_class("separator",$modifier)." {$class}' id='{$id_element}'></div>";

	return $output;
}

add_action( 'vc_before_init', 'separator_element' );

function separator_element(){

	vc_map( array(
		"name" => __("Separatore", 'private_modules'),
		"base" => "separator",
		"description" => "Elemento separatore",
		"icon" => "",
		"category" => __('private_modules', 'private_modules'),
		"params" => array(
			array(
				"type" => "dropdown",
				"heading" => __( "Tipo separatore", 'private_modules' ),
				"param_name" => "type",
				"value" => array(__("Singolo",'private_modules'),__("Singolo sfumato",'private_modules'),__("Doppio",'private_modules')),
				"description" => __( "Seleziona la tipologia", 'private_modules' ),
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


 
 
 
