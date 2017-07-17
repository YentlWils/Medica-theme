<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 30/06/2017
 * Time: 23:23
 */

/**
 * ==========================================
 * Initial theme setup
 * ==========================================
 */
function medica_theme_setup(){
    add_theme_support('menus');

    register_nav_menu('primary-col-1', 'Menu navigation: left column');
    register_nav_menu('primary-col-2', 'Menu navigation: middle column');
    register_nav_menu('primary-col-3', 'Menu navigation: right column');

    register_nav_menu( 'social-media', 'Social Media');

    register_nav_menu( 'alternative-language', 'Site in an alternative language');



    register_nav_menu('secondary', 'The secondary footer navigation');
}

add_action('init', 'medica_theme_setup');

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

add_filter('show_admin_bar', '__return_false');

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
 * Add custom site logo
 * ==========================================
 */
function medica_theme_support(){

    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-width' => true,
    ) );

}

add_action( 'after_setup_theme', 'medica_theme_support' );

/**
 * ==========================================
 * Replace the post button with a space
 * ==========================================
 */

function add_admin_menu_separator( $position ) {

    global $menu;

    $menu[ $position ] = array(
        0	=>	'',
        1	=>	'read',
        2	=>	'separator' . $position,
        3	=>	'',
        4	=>	'wp-menu-separator'
    );

}

function set_admin_menu_separator() {
    do_action( 'admin_init', 5 );
//    do_action( 'admin_init', 9 );
}

add_action( 'admin_init', 'add_admin_menu_separator' );
add_action( 'admin_menu', 'set_admin_menu_separator' );
