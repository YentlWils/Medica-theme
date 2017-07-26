<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 30/06/2017
 * Time: 23:22
 */


/**
 * ==========================================
 * Import the theme style and script files
 * ==========================================
 */
function medica_scrip_enqueue(){

    // Import the main css file
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/dist/css/vendor/bootstrap/bootstrap.min.css', array(), '3.3.7', 'all');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/dist/css/vendor-overrides/font-awesome/font-awesome.css', array(), '4.5.0', 'all');
    wp_enqueue_style("Owl carousel core", get_template_directory_uri() . "/assets/dist/css/vendor/owl.carousel/owl.carousel.min.css", array(), "2.2.1", "all");
    wp_enqueue_style("Owl carousel core", get_template_directory_uri() . "/assets/dist/css/vendor/owl.carousel/owl.theme.default.min.css", array(), "2.2.1", "all");
    wp_enqueue_style("custom style", get_template_directory_uri() . "/assets/dist/css/medica.css", array(), "1.0.0", "all");

    // Import the main js file
    wp_enqueue_script('jquery');
    wp_enqueue_script('lodash', get_template_directory_uri() . '/assets/dist/js/vendor/lodash/lodash.min.js', array(), '4.17.4', true);
    wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/assets/dist/js/vendor/bootstrap/bootstrap.min.js', array(), '3.3.7', true);
    wp_enqueue_script('Owl carousel', get_template_directory_uri() . '/assets/dist/js/vendor/owl.carousel/owl.carousel.min.js', array(), '2.2.1', true);
    wp_enqueue_script('parsleyjs Plugin', get_template_directory_uri() . '/assets/dist/js/vendor/parsleyjs/parsley.min.js', array(), '2.7.2', true);
    wp_enqueue_script('parallax Plugin', get_template_directory_uri() . '/assets/dist/js/medica/plugin/parallax.js', array(), '1.0.0', true);
    wp_enqueue_script("custom js", get_template_directory_uri() . "/assets/dist/js/medica.js", array(), "1.0.0", true);

}

add_action( 'wp_enqueue_scripts', 'medica_scrip_enqueue' );


// Update CSS within in Admin
function admin_scrip_enqueue() {
    wp_enqueue_style('jquery-ui', get_template_directory_uri().'/assets/dist/css/vendor/jquery-ui/jquery-ui.min.css', array(), '1.12.1', "all");
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/dist/css/vendor-overrides/font-awesome/font-awesome.css', array(), '4.5.0', 'all');
    wp_enqueue_style('admin-styles', get_template_directory_uri().'/assets/dist/css/admin.css', array(), "1.0.0", "all");

    wp_enqueue_script('jquery-ui', get_template_directory_uri() . '/assets/dist/js/vendor/jquery-ui/jquery-ui.min.js', array(), '1.12.1', true);
    wp_enqueue_script("custom-admin-js", get_template_directory_uri() . "/assets/dist/js/admin/admin.js", array(), "1.0.0", true);
}

add_action('admin_enqueue_scripts', 'admin_scrip_enqueue');