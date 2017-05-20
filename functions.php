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
 * Custom post type
 * ==========================================
 */

function medica_custom_post_type(){

    $labels = array(
        "name" => "Portfolio",
        "singular_name" => "admin portfolio",
        "add_new" => "add portfolio item",
        "all_items" => "All items",
        "add_new_item" => "add new item",
        "edit_item" => "Edit item",
        "new_item" => "New item",
        "view_item" => "View item",
        "search_item" => "Search portfolio",
        "not_found" => "No items found",
        "not_found_in_trash" => "No items found in trash",
        "parent_item_colon" => "Parent item"
    );
    
    $args = array(
        "labels" => $labels,
        "public" => true,
        "has_archive" => true,
        "publicly_queryable" => true,
        "query_var" => true,
        "rewrite" => true,
        "capability_type" => "post",
        "hierarchical" => false,
        "supports" => array(
            "title",
            "editor",
            "excerpt",
            "thumbnail",
            "revisions"
        ),
        "taxonomies" => array(
            "category",
            "post_tag"
        ),
        "menu_position" => 5,
        "exclude_search" => false
    );

    register_post_type("portfolio", $args);
}

add_action('init', "medica_custom_post_type");