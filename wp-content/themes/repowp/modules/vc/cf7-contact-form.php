<?php


/********************************************
* CF7 Contact Form
********************************************/


add_shortcode( 'cf7_contact_form', 'cf7_contact_form_definition' );

function cf7_contact_form_definition( $atts ) {
    extract( shortcode_atts( array(
        'title' => '',
        'subtitle' => ''
    ), $atts ) );


    $cf7code = format_shortcode("[contact-form-7 title='Contatti ".ICL_LANGUAGE_CODE."']");
    $cf7code = do_shortcode($cf7code);

    $output = "     <div class='cf7-form'>
                        <div class='cf7-form__title-group'>
                            <div class='cf7-form__title-group__title'>
                                {$title}
                            </div>
                            <div class='cf7-form__title-group__subtitle'>
                                {$subtitle}
                            </div>
                       </div>"

                       . $cf7code .

                    "</div>"
    ;

    return $output;
}

add_action( 'vc_before_init', 'cf7_contact_form_element' );

function cf7_contact_form_element(){
    vc_map( array(
        "name" => __("CF7 - Form di contatto", 'private_modules'),
        "base" => "cf7_contact_form",
        "description" => "Form di richiesta informazioni",
        "icon" => "",
        "category" => __('private_modules', 'private_modules'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __( "Titolo", 'private_modules' ),
                "param_name" => "title",
                "description" => __( "Inserisci il titolo", 'private_modules' ),
                "group" => __( "Titolo", 'private_modules' )
            ),
            array(
                "type" => "textfield",
                "heading" => __( "Sottotitolo", 'private_modules' ),
                "param_name" => "subtitle",
                "description" => __( "Inserisci il sottotitolo", 'private_modules' ),
                "group" => __( "Titolo", 'private_modules' )
            )
		)
    ));
}