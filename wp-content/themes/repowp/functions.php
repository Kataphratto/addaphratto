<?php

/*
    * Wordpress Startup
*/

add_action( 'after_setup_theme', 'theme_setup' );

function theme_setup()
{
    register_nav_menus(
	   array( 'main-menu' => __( 'Main Menu', 'my_website' ) )
	);
}

add_action( 'wp_enqueue_scripts', 'theme_load_scripts' );

function theme_load_scripts()
{
	wp_enqueue_script( 'jquery' );
}

add_filter( 'wp_title', 'theme_filter_wp_title' );

function theme_filter_wp_title( $title )
{
	return $title . esc_attr( get_bloginfo( 'name' ) );
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function theme_enqueue_styles()
{
    global $wp_styles;

    wp_enqueue_style( 'styles-css', get_template_directory_uri() . '/assets/css/styles.css' );

}

add_action( 'admin_enqueue_scripts', 'admin_enqueue_styles' );

function admin_enqueue_styles()
{
    global $wp_styles;

    wp_enqueue_style( 'admin-css', get_template_directory_uri() . '/assets/css/admin.css' );

}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );

function theme_enqueue_scripts() {
    wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js' );
    wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick.min.js' );
}

/*
    * Wordpress Removes
*/

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

function remove_jquery_migrate( &$scripts)
{
    if(!is_admin())
    {
        $scripts->remove( 'jquery');
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.11.1' );
    }
}
add_filter( 'wp_default_scripts', 'remove_jquery_migrate' );

function custom_menu_page_removing() {
    remove_menu_page( 'bwp_minify_general' );
    remove_menu_page( 'itsec' );
    remove_menu_page('edit.php?post_type=acf');
}

/* Menu custom edit */

function revcon_change_post_label() {
    global $menu;
    $menu[5][0] = 'News';
}

add_action( 'admin_menu', 'revcon_change_post_label' );

/* TODO Decomment before deliver project to customer

add_action( 'admin_menu', 'custom_menu_page_removing', 999 );

*/

/* REDUX */

require_once ("inc/redux-config.php");

/* SIDEBARS & WIDGETS */

require_once ("inc/sidebars.php");

/* Custom post types */

require_once ("inc/include-cpt.php");

/* Visual composer modules */

require_once ("inc/include-vc-modules.php");

/* Custom php functions */

require_once ("inc/include-custom-php-functions.php");