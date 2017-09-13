<?php

/********************************************
* SOCIALS CONTAINER
********************************************/

add_shortcode( 'socials', 'socials_definition' );

function socials_definition( $atts) {
	extract( shortcode_atts( array(
		'align' => '',
		'class' => '',
		'modifier' => '',
		'id_element' => ''
	), $atts ) );
	
	switch ($align) {
		case "Centrato":
			$modifier .= "";
			break;
		case "A sinistra":
			$modifier .= " alignleft";
			break;
		case "A destra":
			$modifier .= " alignright";
			break;
	}

	$output = "<div class='".create_modifier_class("socials-container",$modifier)." {$class}' id='{$id_element}'>";

	$list = array(
		array(
		'check' => OptionsHelper::get("fb-account"),
		'icon' => 'fb',
		'label' => __('Facebook'),
		'href' => OptionsHelper::get("fb-account"),
		'text' => OptionsHelper::get("fb-account-text"),
		),
		array(
		'check' => OptionsHelper::get("twitter-account"),
		'icon' => 'twitter',
		'label' => __('Twitter'),
		'href' => OptionsHelper::get("twitter-account"),
		'text' => OptionsHelper::get("twitter-account-text"),
		),
		array(
		'check' => OptionsHelper::get("yt-account"),
		'icon' => 'yt',
		'label' => __('YouTube'),
		'href' => OptionsHelper::get("yt-account"),
		'text' => OptionsHelper::get("yt-account-text"),
		),
		array(
		'check' => OptionsHelper::get("ig-account"),
		'icon' => 'ig',
		'label' => __('Instagram'),
		'href' => OptionsHelper::get("ig-account"),
		'text' => OptionsHelper::get("ig-account-text"),
		),
		array(
		'check' => OptionsHelper::get("pinterest-account"),
		'icon' => 'pinterest',
		'label' => __('Pinterest'),
		'href' => OptionsHelper::get("pinterest-account"),
		'text' => OptionsHelper::get("pinterest-account-text"),
		),
		array(
		'check' => OptionsHelper::get("gplus-account"),
		'icon' => 'gplus',
		'label' => __('Google Plus'),
		'href' => OptionsHelper::get("gplus-account"),
		'text' => OptionsHelper::get("gplus-account-text"),
		),
		array(
		'check' => OptionsHelper::get("linkedin-account"),
		'icon' => 'linkedin',
		'label' => __('Linkedin'),
		'href' => OptionsHelper::get("linkedin-account"),
		'text' => OptionsHelper::get("linkedin-account-text"),
		),
	);

	foreach ($list as $social){
		if ($social['check']){
		
			$output .= "<div class='".create_modifier_class("socials-container__single-social",$modifier)."'>";
			
				$output .= "<a href='{$social['href']}' target='_blank'>";
				$output .= "<div class='".create_modifier_class("socials-container__single-social__social-icon",$modifier)." ".create_modifier_class("socials-container__single-social__social-icon--{$social['icon']}",$modifier)."'></div>";
				if($social['text'] != ""){
					$output .= "<div class='".create_modifier_class("socials-container__single-social__social-text",$modifier)."'>{$social['text']}</div>";
				}
				$output .= "</a>";
			
			$output .= "</div>";
		}
	}
	
	$output .="</div>";

	return $output;
	
}

add_action( 'vc_before_init', 'socials_element' );

function socials_element(){

	vc_map( array(
		"name" => __("Socials", 'private_modules'),
		"base" => "socials",
		"description" => "Elemento per mostrare i socials definiti in REDUX",
		"icon" => "",
		"category" => __('private_modules', 'private_modules'),
		"params" => array(
			array(
				"type" => "dropdown",
				"heading" => __( "Allineamento", 'private_modules' ),
				"param_name" => "title_align",
				"value" => array(__("Centrato",'private_modules'),__("A sinistra",'private_modules'),__("A destra",'private_modules')),
				"description" => __( "Seleziona la posizione del titolo", 'private_modules' ),
				"group" => __( "Impostazioni", 'private_modules' )
			),
			array(
				"type" => "checkbox",
				"heading" => __( "Mostra eventuale testo a lato", 'private_modules' ),
				"param_name" => "checkbox_future_post",
				"value" => true,
				"description" => __( "Selezionare per visualizzare a lato dell'icona l'eventuale testo definito in REDUX", 'private_modules' ),
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
