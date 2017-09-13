<?php


/********************************************
* Company Data
********************************************/


add_shortcode( 'company_data', 'company_data_definition' );

function company_data_definition( $atts ) {
    extract( shortcode_atts( array(), $atts ) );
    
    $sede_legale = nl2br( OptionsHelper::get('address'));
    $sede_operativa = nl2br( OptionsHelper::get('address-2'));
    $fax = OptionsHelper::get('fax');

    $output = "
        <div class='company-data vc_row wpb_row vc_row-fluid'>
            <div class='wpb_column vc_column_container vc_col-sm-8'>
                <div class='vc_column-inner '>
                    <div class='wpb_wrapper'>
                        <div class='wpb_text_column wpb_content_element'>
                            <div class='wpb_wrapper'>
                                <strong class='company-data__company'>". OptionsHelper::get('company-name') ."</strong><br><br>";
	if ($sede_legale != ""){
		$output .= "<strong>".__("Sede Legale","my_website")."</strong><br>".$sede_legale."<br><br>";
	}
	
	if ($sede_operativa != ""){
		$output .= "<strong>".__("Sede Operativa","my_website")."</strong><br>".$sede_operativa."<br><br>";
	}
	
	$output .= "
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='company-data vc_row wpb_row vc_row-fluid'>
            <div class='wpb_column vc_column_container vc_col-sm-4'>
                <div class='vc_column-inner '>
                    <div class='wpb_wrapper'>
                        <div class='wpb_text_column wpb_content_element'>
                            <div class='wpb_wrapper'>
                                ". __('Tel:','my_website')." <a href='".OptionsHelper::get('phone')."'>"  . OptionsHelper::get('phone')."</a><br>";
	if ($fax != ""){
		$output .= __('Fax:','my_website')." <span>" .$fax."</span><br>";
	}
	$output .=	__('Email:','my_website')." <a href='mailto:". OptionsHelper::get('email') ."'>" . OptionsHelper::get('email')."</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='wpb_column vc_column_container vc_col-sm-4'>
                <div class='vc_column-inner '>
                    <div class='wpb_wrapper'>
                        <div class='wpb_text_column wpb_content_element'>
                            <div class='wpb_wrapper'>
                                "

                                . __('Rea:','my_website') . " " . OptionsHelper::get("rea") . "<br>" .

                                __('Capitale Sociale:','my_website') . " " . OptionsHelper::get("c-sociale") . "<br>" .

                                __('P.IVA:','my_website') . " " . OptionsHelper::get("p-iva") . "<br>" .
                            
                                __('Registro Imprese:','my_website') . " " . OptionsHelper::get("registro") .

                                "
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    ";

    return $output;
}

add_action( 'vc_before_init', 'company_data_element' );

function company_data_element(){
    vc_map( array(
        "name" => __("Dati Aziendali", 'private_modules'),
        "base" => "company_data",
        "description" => "Informazioni Aziendali del sito estrapolate dai dati aziendali",
        "icon" => "",
        "category" => __('private_modules', 'private_modules')
		)
    );
}
