<?php

// limit number of words in a text
function limit_text($text, $limit) {

      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]) . '...';
          $text = strip_tags($text);
      }
      return $text;
}


// retrieve data elements of an img
function wp_get_attachment( $attachment_id ) {

	$attachment = get_post( $attachment_id );
	if (is_object($attachment)){
		return array(
			'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
			'caption' => $attachment->post_excerpt,
			'description' => $attachment->post_content,
			'href' => get_permalink( $attachment->ID ),
			'src' => $attachment->guid,
			'title' => $attachment->post_title
		);
	}
}


// create class modifier name from class and modifier name
function create_modifier_class($class,$modifier){
	
	$class_result = $class;
	
	if ($modifier != ""){
		
		$array_modifier = explode(" ", $modifier);
		
        foreach ($array_modifier as $i => $value) {
			if (($array_modifier[$i] != "") && ($array_modifier[$i] != " ")){
				$class_result .= " ".$class."--".$array_modifier[$i];
			}
        }
        
	}

	return $class_result;

}

// replace wrong char in a shortcode text
function format_shortcode($shortcode) {

	$shortcode = str_replace ("`{`", '[', $shortcode);
	$shortcode = str_replace ("``", '"', $shortcode);
	$shortcode = str_replace ("`}`", ']', $shortcode);

	return $shortcode;
}

// create a pager element
function paging($title,$tot_post,$post_per_page) {

    $total_pages = ceil((int)$tot_post / (int)$post_per_page);

    if ($total_pages > 1){

        $current_page = max(1, get_query_var('paged'));

        echo '<div class="pagenav">
        <div class="pagenav__title">'.$title.'</div>
        <div class="pagenav__pages">';

        echo paginate_links(array(
            'base' => preg_replace('/\?.*/', '/', get_pagenum_link(1)) . '%_%',
            'format' => '?paged=%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text' => "<",
            'next_text' => ">"
            ));

        echo '</div>';
        echo '</div>';
    }
}


// retrieve company name redux field
add_shortcode( 'company_name', 'company_name_def' );

function company_name_def( $atts ) {
    extract( shortcode_atts( array(), $atts ) );

    $output = OptionsHelper::get('company-name');

    return $output;
}

// retrieve site url
add_shortcode( 'site_url', 'url_shortcode' );

function url_shortcode( $atts ) {
    extract( shortcode_atts( array(), $atts ) );

    $output = get_bloginfo('url');
    $find = array( 'http://', 'https://' );
	$replace = '';
	$output = str_replace( $find, $replace, $output );

    return $output;
}

// retrieve company address
add_shortcode( 'company_address', 'company_address_def' );

function company_address_def( $atts ) {
    extract( shortcode_atts( array(), $atts ) );

    $output = OptionsHelper::get('address');

    return $output;
}
