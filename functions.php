<?php

// Import the theme style and script files
function medica_scrip_enqueue(){

    // Import the main css file
    wp_enqueue_style("custom style", get_template_directory_uri() . "/css/medica.css", array(), "1.0.0", "all");
    // Import the main js file
    wp_enqueue_script("custom js", get_template_directory_uri() . "/js/medica.js", array(), "1.0.0", true);

}

add_action( 'wp_enqueue_scripts', 'medica_scrip_enqueue' );

// Initial theme setup
function medica_theme_setup(){
    add_theme_support('menus');

    register_nav_menu('primary', 'The primary header navigation');

    register_nav_menu('secondary', 'The secondary footer navigation');
}

add_action('init', 'medica_theme_setup');

