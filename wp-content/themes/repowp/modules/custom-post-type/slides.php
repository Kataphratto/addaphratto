<?php

/*
    * Define Slides
*/

function define_slides() {

    $labels = array(
        'name'                => _x( 'Slides', 'Post Type General Name', 'my_website' ),
        'singular_name'       => _x( 'Slide', 'Post Type Singular Name', 'my_website' ),
        'menu_name'           => __( 'Slides', 'my_website' ),
        'all_items'           => __( 'Tutte le Slides', 'my_website' ),
        'view_item'           => __( 'Visualizza Slide', 'my_website' ),
        'add_new_item'        => __( 'Aggiungi nuova Slide', 'my_website' ),
        'add_new'             => __( 'Aggiungi nuova', 'my_website' ),
        'edit_item'           => __( 'Modifica Slide', 'my_website' ),
        'update_item'         => __( 'Aggiorna Slide', 'my_website' ),
        'search_items'        => __( 'Cerca Slide', 'my_website' ),
        'not_found'           => __( 'Non trovata', 'my_website' ),
        'not_found_in_trash'  => __( 'Non trovata nel cestino', 'my_website' ),
    );

    $args = array(
        'label'               => __( 'slides', 'my_website' ),
        'description'         => __( 'Slides responsive visualizzate in cima al contenuto della pagina', 'my_website' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields' ),
        'taxonomies'          => array( 'sezioni' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'menu_icon'           => 'dashicons-camera',
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
    );

    register_post_type( 'slides', $args);
}

add_action( 'init', 'define_slides' );


function define_slides_taxonomy() {

    $cat_labels = array(
        'singular_name'       => 'Categoria Slide',
        'all_items'           => 'Tutte le categorie',
        'add_new_item'        => 'Aggiungi nuova categoria'
    );

    register_taxonomy(
        'slides-category',
        'slides',

        array(
            'label'              => __( 'Categorie Slides' ),
            'hierarchical'       => true,
            'show_ui'            => true,
            'labels'             => $cat_labels,
            'publicly_queryable'  => true,
            'rewrite' => array(
                'slug'          => 'categorie',
                'with_front'    => true
            )
        )
    );
}

add_action( 'init', 'define_slides_taxonomy' );