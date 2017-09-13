<?php


/********************************************
* Feature Icon
********************************************/


add_shortcode( 'feature_icon', 'feature_icon_definition' );

function feature_icon_definition( $atts ) {
    extract( shortcode_atts( array(
        'text_title' => '',
        'text_content' => '',
        'text_link' => '',
        'link_url' => '',
        'is_last' => '',
        'icon_type' => '',
        'modifier' => ''
    ), $atts ) );

    switch ($icon_type) {
        case "Medaglia":
            $icon_type = "icon-star";
            break;
        case "Portafoglio":
            $icon_type = "icon-portafoglio";
            break;
        case "Assistenza":
            $icon_type = "icon-assistenza";
            break;
        case "Servizio":
            $icon_type = "icon-tool";
            break;
    }

    $last = '';

    if ( $is_last )
        $last = ' feature_icon--last';

    $output = "

        <section class='".create_modifier_class("feature_icon",$modifier). $last ."'>
            <div class='feature_icon__title'>
                {$text_title}
            </div>
            <div class='feature_icon__content'>
                <div class='feature_icon__content__icon {$icon_type}'>
                </div>
                <div class='feature_icon__content__text'>
			        {$text_content}
                </div>";
                
		if ($text_link != ""){
			$output .= "
                <div class='feature_icon__content__link'>
			        <a href='{$link_url}'>{$text_link}</a>
                </div>";
		}
                
		$output .="
            </div>
        </section>

    ";

    return $output;
}

add_action( 'vc_before_init', 'feature_icon_element' );

function feature_icon_element(){
    vc_map( array(
        "name" => __("Blocco con Icona", 'private_modules'),
        "base" => "feature_icon",
        "description" => "Blocco testuale con titolo, icona e testo",
        "icon" => "",
        "category" => __('private_modules', 'private_modules'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __( "Titolo", 'private_modules' ),
                "param_name" => "text_title",
                "description" => __( "Inserisci il titolo del blocco", 'private_modules' ),
                "group" => __( "Testo", 'private_modules' )
            ),
            array(
                "type" => "textarea",
                "heading" => __( "Testo", 'private_modules' ),
                "param_name" => "text_content",
                "description" => __( "Inserisci il contenuto testuale", 'private_modules' ),
                "group" => __( "Testo", 'private_modules' )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Testo link", 'private_modules' ),
                "param_name" => "text_link",
                "description" => __( "Inserisci il testo per un link", 'private_modules' ),
                "group" => __( "Testo", 'private_modules' )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "URL link", 'private_modules' ),
                "param_name" => "link_url",
                "description" => __( "Inserisci l'\url del link", 'private_modules' ),
                "group" => __( "Testo", 'private_modules' )
            ),
            array(
                "type" => "checkbox",
                "heading" => __( "Ultimo Elemento", 'private_modules' ),
                "param_name" => "is_last",
                "value" => false,
                "description" => __( "È l'ultimo elemento?", 'private_modules' ),
                "group" => __( "Impostazioni", 'private_modules' )
            ),
            array(
                "type" => "dropdown",
                "heading" => __( "Icona", 'private_modules' ),
                "param_name" => "icon_type",
                "value" => array(__("",'private_modules'),__("Medaglia",'private_modules'),__("Portafoglio",'private_modules'),__("Assistenza",'private_modules'),__("Servizio",'private_modules')),
                "description" => __( "Seleziona una tra le icone disponibili", 'private_modules' ),
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
