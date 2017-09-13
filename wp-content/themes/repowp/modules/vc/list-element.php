<?php


/********************************************
* List Element
********************************************/


add_shortcode( 'list_text', 'list_text_definition' );

function list_text_definition( $atts) {
    extract( shortcode_atts( array(
        'title' => '',
        'righe' => ''
    ), $atts ) );

	$righe = str_replace("||", "</li><li>", $righe);
	$righe = "<ul><li>".$righe."</li></ul>";

    $output = "

        <section class='listelement'>
            <div class='listelement__content'>
				<div class='listelement__content__title'>
					{$title}
				</div>
				<div class='listelement__content__list'>
					{$righe}
				</div>
            </div>
        </section>

    ";

    return $output;
}

add_action( 'vc_before_init', 'list_text_element' );

function list_text_element(){
    vc_map( array(
        "name" => __("Elemento Lista con titolo", 'private_modules'),
        "base" => "list_text",
        "description" => "Elemento con titolo e a seguire lista di righe",
        "icon" => "",
        "category" => __('private_modules', 'private_modules'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __( "Titolo", 'private_modules' ),
                "param_name" => "title",
                "description" => __( "Inserisci qui il titolo", 'private_modules' ),
                "group" => __( "Titolo", 'private_modules' )
            ),
            array(
                "type" => "textarea",
                "heading" => __( "Testo", 'private_modules' ),
                "param_name" => "righe",
                "description" => __( "Inserisci qui il testo. Usa || tra le parole per creare elementi di lista", 'private_modules' ),
                "group" => __( "Testo", 'private_modules' )
            )
		)
    ));
}