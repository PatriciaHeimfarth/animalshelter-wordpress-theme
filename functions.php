<?php

if(! function_exists( 'animalshelter_setup' ) ) :

    function animalshelter_setup() {
        add_theme_support( 'title-tag' );

    }
endif;
add_action('after_setup_theme', 'animalshelter_setup');

/* Menus */

function register_animalshelter_menus() {
    register_nav_menus(
        array(
            'primary' => __('Primary Menu'),
            'footer' => __('Footer Menu')
        )
    );
    add_action('init', 'register_animalshelter_menus');
}

/* Stylesheets */

function animalshelter_scripts() {
    wp_enqueue_style( 'animalshelter_styles', get_stylesheet_uri() );
   // wp_enqueue_style( 'animalshelter_google_fonts', '');
}

add_action('wp_enqueue_scripts', 'animalshelter_scripts');