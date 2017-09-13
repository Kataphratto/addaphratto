<?php


/********************************************
* Quote Block
********************************************/


add_shortcode( 'quote_block', 'quote_block_definition' );

function quote_block_definition( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'title' => '',
        'person_name' => '',
        'person_job' => '',
        'modifier' => ''
    ), $atts ) );

    $content = wpb_js_remove_wpautop($content, true);

    $output = "

        <section class='".create_modifier_class("quote_block",$modifier)."'>
            <div class='quote_block__content'>
                <div class='quote_block__content__title'>
                    {$title}
                </div>
                <div class='quote_block__content__text'>
                    {$content}
                </div>
                <div class='quote_block__content__person-name'>
                    {$person_name}
                </div>
            </div>
        </section>

    ";

    return $output;
}

add_action( 'vc_before_init', 'quote_block_element' );

function quote_block_element(){
    vc_map( array(
        "name" => __("Blocco citazione", 'private_modules'),
        "base" => "quote_block",
        "description" => "Blocco citazione",
        "icon" => "",
        "category" => __('private_modules', 'private_modules'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __( "Titolo Blocco", 'private_modules' ),
                "param_name" => "title",
                "description" => __( "Inserisci il titolo del blocco", 'private_modules' ),
                "group" => __( "Testo", 'private_modules' )
            ),
            array(
                "type" => "textarea_html",
                "heading" => __( "Testo della citazione", 'private_modules' ),
                "param_name" => "content",
                "description" => __( "Inserisci il contenuto della citazione", 'private_modules' ),
                "group" => __( "Testo", 'private_modules' )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Autore della citazione", 'private_modules' ),
                "param_name" => "person_name",
                "description" => __( "Inserisci l'autore della citazione", 'private_modules' ),
                "group" => __( "Testo", 'private_modules' )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Modificatore", 'private_modules' ),
                "param_name" => "modifier",
                "description" => __( "Nome modificatore in ottica BEM. Non aggiungere --. Separare eventuali altri modificatori con uno spazio", 'private_modules' ),
                "group" => __( "Impostazioni", 'private_modules' )
            )
		)
    ));
}