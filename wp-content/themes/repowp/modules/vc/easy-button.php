<?php 


/********************************************
* Easy button
********************************************/

add_shortcode( 'easy_button', 'easy_button_definition' );

function easy_button_definition( $atts) {
	extract( shortcode_atts( array(
		'text' => '',
		'link' => '',
		'modifier' => '',
		'target' => '_self'
	), $atts ) );

	$output = "<a class='".create_modifier_class("easy-button",$modifier)."' href='{$link}' target='{$target}'>{$text}</a>";

	return $output;
}

add_action( 'vc_before_init', 'easy_button_element' );

function easy_button_element(){

	add_action('admin_init', function(){

		vc_map( array(
			"name" => __("Bottone semplice", 'private_modules'),
			"base" => "easy_button",
			"description" => "Elemento link base, con solo testo e url di arrivo.",
			"icon" => "",
			"category" => __('private_modules', 'private_modules'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __( "Testo", 'private_modules' ),
					"param_name" => "text",
					"description" => __( "Testo del link", 'private_modules' ),
					"group" => __( "Contenuto", 'private_modules' )
				),
				array(
					"type" => "textfield",
					"heading" => __( "URL di destinazione", 'private_modules' ),
					"param_name" => "link",
					"value" => "",
					"description" => __( "Indirizzo di destinazione del link OPPURE ID elemento (es. #elemento)", 'private_modules' ),
					"group" => __( "Contenuto", 'private_modules' )
				),
				array(
					"type"        => "dropdown",
					"heading"     => __( "Target", 'private_modules' ),
					"param_name"  => "target",
					"value" => array(__("_self",'private_modules'),__("_blank",'private_modules')),
					"description" => __( "Seleziona dove aprire il link", 'private_modules' ),
					"group" => __( "Contenuto", 'private_modules' )
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


 
 
