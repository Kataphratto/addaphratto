<?php 


/***********************
* Base container
************************/

add_action( 'vc_before_init', 'base_container_element' );

function base_container_element(){
	vc_map( array(
		"name" => __("Base Container", 'private_modules'),
		"base" => "base_container",
		"content_element" => true,
		"show_settings_on_create" => false,
		"is_container" => true,
		"category" => __('private_modules', 'private_modules'),
		"params" => array(
			array(
				"type" => "dropdown",
				"heading" => __("Dimensione", "my-text-domain"),
				"param_name" => "size",
				"value" => array(__("Standard",'private_modules'),__("Piccolo",'private_modules'),__("Grande",'private_modules')),
				"description" => __( "In base alla dimensione la relativa classe ne setterà la dimensione massima", 'private_modules' ),
				"group" => __( "Impostazioni", 'private_modules' )
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
			)
		),
		"js_view" => 'VcColumnView',
	) );
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Base_Container extends WPBakeryShortCodesContainer {
	}
}

function base_container_output( $atts, $content = null){
	extract( shortcode_atts( array(
		'size' => __("Standard",'private_modules'),
		'class' => '',
		'modifier' => '',
		'id_element' => ''
	), $atts ) );
	
	if($size == "Piccolo"){
		$modifier .= " small";
	}
	
	if($size == "Grande"){
		$modifier .= " big";
	}
	
	$output = "<div class='".create_modifier_class("base-container",$modifier)." {$class} clearfix' data-row>";
	$output .= do_shortcode( $content );
	$output .= '</div>';
	
	return $output;
}

add_shortcode( 'base_container' , 'base_container_output' );
