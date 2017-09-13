<?php


/********************************************
* Text Rectangle
********************************************/


add_shortcode( 'text_rectangle', 'text_rectangle_definition' );

function text_rectangle_definition( $atts ) {
    extract( shortcode_atts( array(
        'text_content' => '',
        'modifier' => ''
    ), $atts ) );

    $output = "

        <section class='".create_modifier_class("text_rectangle",$modifier)." {$class}'>
            <div class='text_rectangle__content'>
                <div class='text_rectangle__content__text'>
                    {$text_content}
                </div>
                <div class='text_rectangle__content__plus-button'>
                </div>
            </div>
        </section>

    ";

    return $output;
}

add_action( 'vc_before_init', 'text_rectangle_element' );

function text_rectangle_element(){
    vc_map( array(
        "name" => __("Blocco rettangolare con testo", 'private_modules'),
        "base" => "text_rectangle",
        "description" => "Blocco rettangolare con  valore testuale",
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