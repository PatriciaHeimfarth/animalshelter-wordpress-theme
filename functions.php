<?php

if (!function_exists('animalshelter_setup')) :

    function animalshelter_setup()
    {
        add_theme_support('title-tag');
    }
endif;
add_action('after_setup_theme', 'animalshelter_setup');

/* Menus */
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );


function register_animalshelter_menus()
{
    register_nav_menus(
        array(
            'primary' => __('Primary Menu'),
            'footer' => __('Footer Menu')
        )
    );
}
add_action('init', 'register_animalshelter_menus');

add_theme_support( 'post-thumbnails' );

/* Stylesheets */

function animalshelter_scripts()
{
    wp_enqueue_style('animalshelter_styles', get_stylesheet_uri());
    // wp_enqueue_style( 'animalshelter_google_fonts', '');
    wp_enqueue_style(
        'bootstrap',
        get_template_directory_uri() . '/css/bootstrap.min.css',
        array(),
        '5.0.0'
    );

    wp_enqueue_script(
        'bootstrap',
        get_template_directory_uri() . '/js/bootstrap.min.js',
        array( 'jquery' ),
        '5.0.0', 
        true
    );
}

add_action('wp_enqueue_scripts', 'animalshelter_scripts');

/* Widgets */

function animalshelter_widget_init()
{
    register_sidebar(array(
        'name' => __('Main Sidebar', 'animalshelter'),
        'id' => 'main-sidebar',
        'description' => __('Widgets', 'animalshelter'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section >',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>'
    ));
}
add_action('widgets_init', 'animalshelter_widget_init');

/* Custom Post Type */
require_once( 'post_types/animal.php' );

 