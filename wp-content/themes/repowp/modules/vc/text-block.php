<?php


/********************************************
* Text Block
********************************************/


add_shortcode( 'text_block', 'text_block_definition' );

function text_block_definition( $atts ) {
    extract( shortcode_atts( array(
        'text_content' => '',
		'class' => '',
        'modifier' => ''
    ), $atts ) );

    $output = "

        <section class='".create_modifier_class("text_block",$modifier)." {$class}'>
			{$text_content}
        </section>

    ";

    return $output;
}

add_action( 'vc_before_init', 'text_block_element' );

function text_block_element(){
    vc_map( array(
        "name" => __("Blocco testuale generico", 'private_modules'),
        "base" => "text_block",
        "description" => "Blocco testuale",
        "icon" => "",
        "category" => __('private_modules', 'private_modules'),
        "params" => array(
            array(
                "type" => "textarea",
                "heading" => __( "Testo", 'private_modules' ),
                "param_name" => "text_content",
                "description" => __( "Inserisci il contenuto testuale", 'private_modules' ),
                "group" => __( "Testo", 'private_modules' )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Modificatore", 'private_modules' ),
                "param_name" => "modifier",
                "description" => __( "Nome modificatore in ottica BEM. Non aggiungere --. Separare eventuali altri modificatori con uno spazio", 'private_modules' ),
                "group" => __( "Testo", 'private_modules' )
            )
		)
    ));
}