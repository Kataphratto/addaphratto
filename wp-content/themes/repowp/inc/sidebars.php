<?php


function all_widgets_init() {

	register_sidebar(
		array(
			'name' => 'Header text',
			'id' => 'header-text',
		)
	); 

	register_sidebar(
		array(
			'name' => 'Sidebar',
			'id' => 'sidebar',
		)
	); 
	
}

add_action( 'widgets_init', 'all_widgets_init' );
