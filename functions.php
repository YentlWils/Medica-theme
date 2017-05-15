<?php

/**
 * ==========================================
 * Import the theme style and script files
 * ==========================================
 */
function medica_scrip_enqueue(){

    // Import the main css file
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/dist/css/vendor/bootstrap/bootstrap.min.css', array(), '3.3.7', 'all');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/dist/css/vendor-overrides/font-awesome/font-awesome.css', array(), '4.5.0', 'all');
    wp_enqueue_style("custom style", get_template_directory_uri() . "/dist/css/medica.css", array(), "1.0.0", "all");

    // Import the main js file
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/dist/js/vendor/bootstrap/bootstrap.min.js', array(), '3.3.7', true);
    wp_enqueue_script("custom js", get_template_directory_uri() . "/dist/js/medica.js", array(), "1.0.0", true);

}

add_action( 'wp_enqueue_scripts', 'medica_scrip_enqueue' );



/**
 * ==========================================
 * Initial theme setup
 * ==========================================
 */
function medica_theme_setup(){
    add_theme_support('menus');

    register_nav_menu('primary', 'The primary header navigation');

    register_nav_menu('secondary', 'The secondary footer navigation');
}

add_action('init', 'medica_theme_setup');


/**
 * ==========================================
 * Enable sidebar functionality
 * ==========================================
 */
function medica_widget_setup(){

    register_sidebar(array(
        "name" => "Sidebar",
        "id" => "sidebar-1",
        "class" => "sidebar-custom",
        "description" => "Standard sidebar",
        "before_widget" => "<aside id=\"%1$s\" class=\"widget %2$s\">",
        "after_widget" => "</aside>",
        "before_title" => "<h1 class=\"widget-title\">",
        "after_title" => "</h1>"
    ));

}

add_action("widgets_init", "medica_widget_setup");


/**
 * ==========================================
 * Enable default functionality
 * ==========================================
 */

// Add page background
add_theme_support('custom-background');

// Add image header
add_theme_support('custom-header');

// Add post feature image
add_theme_support('post-thumbnails');

// Add post formats
add_theme_support('post-formats', array('aside', 'image', 'video'));