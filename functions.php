<?php

setlocale(LC_TIME, "nld_nld");

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
    wp_enqueue_script('parallax Plugin', get_template_directory_uri() . '/assets/dist/js/medica/plugin/parallax.js', array(), '1.0.0', true);
    wp_enqueue_script("custom js", get_template_directory_uri() . "/assets/dist/js/medica.js", array(), "1.0.0", true);

}

add_action( 'wp_enqueue_scripts', 'medica_scrip_enqueue' );



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
        "name" => "Highlight Post",
        "singular_name" => "admin highlight post",
        "add_new" => "add highlight post",
        "all_items" => "All highlight posts",
        "add_new_item" => "add highlight post",
        "edit_item" => "Edit highlight post",
        "new_item" => "New highlight post",
        "view_item" => "View highlight post",
        "search_item" => "Search highlight post",
        "not_found" => "No items found",
        "not_found_in_trash" => "No items found in trash",
        "parent_item_colon" => "Parent item"
    );
    
    $args = array(
        'label' => 'Highlight Post',
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
        "menu_icon" => "dashicons-lightbulb",
        "menu_position" => 5,
        "exclude_search" => false
    );

    register_post_type("portfolio", $args);
}

add_action('init', "medica_custom_post_type");

/**
 * ==========================================
 * Settings page
 * ==========================================
 */

function add_theme_menu_item()
{
    add_menu_page("Medica Settings", "Medica Settings", "manage_options", "theme-panel", "theme_settings_page", null, 99);
    add_submenu_page( 'theme-panel', 'Footer Settings', 'Footer Settings', 'manage_options', 'theme-panel-footer', "theme_footer_page");
    add_submenu_page( 'theme-panel', 'Social Settings', 'Social Settings', 'manage_options', 'theme-panel-social', "theme_social_page");
}


function theme_settings_page()
{
    ?>
    <div class="wrap">
        <h1>Theme Panel</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields("section-options");
            do_settings_sections("theme-options");

            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function theme_footer_page()
{
    ?>
    <div class="wrap">
        <h1>Theme Panel</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields("section-footer");
            do_settings_sections("theme-footer");

            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function theme_social_page()
{
    ?>
    <div class="wrap">
        <h1>Theme Panel</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields("section-social");
            do_settings_sections("theme-social");

            submit_button();
            ?>
        </form>
    </div>
    <?php
}

add_action("admin_menu", "add_theme_menu_item");

function display_address_element()
{
    ?>
    <textarea name="medica_address" id="medica_address" rows="4" cols="50"><?php echo get_option('medica_address'); ?></textarea>
    <?php
}

function display_email_element()
{
    ?>
    <input type="text" name="medica_email" id="medica_email" value="<?php echo get_option('medica_email'); ?>" />
    <?php
}

function display_twitter_element()
{
    ?>
    <input type="text" name="twitter_url" id="twitter_url" value="<?php echo get_option('twitter_url'); ?>" />
    <?php
}

function display_facebook_element()
{
    ?>
    <input type="text" name="facebook_url" id="facebook_url" value="<?php echo get_option('facebook_url'); ?>" />
    <?php
}

function display_linkedin_element()
{
    ?>
    <input type="text" name="linked_url" id="linked_url" value="<?php echo get_option('linked_url'); ?>" />
    <?php
}

function display_instagram_element()
{
    ?>
    <input type="text" name="instagram_url" id="instagram_url" value="<?php echo get_option('instagram_url'); ?>" />
    <?php
}

function display_snapchat_element()
{
    ?>
    <input type="text" name="snapchat_url" id="snapchat_url" value="<?php echo get_option('snapchat_url'); ?>" />
    <?php
}

function display_footer_banner_img()
{
    ?>
    <input type="file" name="logo" />
    <?php echo get_option('footer_banner_img'); ?>
    <?php
}

function handle_footer_banner_img_upload()
{
    if(!empty($_FILES["demo-file"]["tmp_name"]))
    {
        $urls = wp_handle_upload($_FILES["footer_banner_img"], array('test_form' => FALSE));
        $temp = $urls["url"];
        return $temp;
    }

    return $option;
}

function display_theme_panel_fields()
{
    // General settings
    add_settings_section("section-options", "General Settings", null, "theme-options");
    add_settings_field("medica_email", "Medica email", "display_email_element", "theme-options", "section-options");
    register_setting("section-options", "medica_email");

    // Footer Settings
    add_settings_section("section-footer", "Footer", null, "theme-footer");
    add_settings_field("medica_address", "Main Address", "display_address_element", "theme-footer", "section-footer");
    add_settings_field("footer_banner_img", "Footer banner image (700px X 250px)", "display_footer_banner_img", "theme-footer", "section-footer");
    register_setting("section-footer", "medica_address");
    register_setting("section-footer", "footer_banner_img", "handle_footer_banner_img_upload");

    // Social media settings
    add_settings_section("section-social", "Social media", null, "theme-social");
    add_settings_field("twitter_url", "Twitter Profile Url", "display_twitter_element", "theme-social", "section-social");
    add_settings_field("facebook_url", "Facebook Profile Url", "display_facebook_element", "theme-social", "section-social");
    add_settings_field("linked_url", "Linkedin Profile Url", "display_linkedin_element", "theme-social", "section-social");
    add_settings_field("instagram_url", "Instagram Profile Url", "display_instagram_element", "theme-social", "section-social");
    add_settings_field("snapchat_url", "Snapchat Profile Url", "display_snapchat_element", "theme-social", "section-social");
    register_setting("section-social", "twitter_url");
    register_setting("section-social", "facebook_url");
    register_setting("section-social", "linked_url");
    register_setting("section-social", "instagram_url");
    register_setting("section-social", "snapchat_url");

}

add_action("admin_init", "display_theme_panel_fields");


/*
 * Development function for instagram curl
 */
function api_curl_connect( $api_url ){
    $connection_c = curl_init(); // initializing
    curl_setopt($connection_c, CURLOPT_SSL_VERIFYPEER, false);
//    curl_setopt($connection_c, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt( $connection_c, CURLOPT_URL, $api_url ); // API URL to connect
    curl_setopt( $connection_c, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
    curl_setopt( $connection_c, CURLOPT_TIMEOUT, 20 );
    $json_return = curl_exec( $connection_c ); // connect and get json data
    curl_close( $connection_c ); // close connection
    return json_decode( $json_return ); // decode and return
}

// Breadcrumbs
function custom_breadcrumbs()
{

// Settings
    $separator = '&horbar;';
    $breadcrums_id = 'breadcrumbs';
    $breadcrums_class = 'medica-breadcrumb__list list-inline';
    $home_title = 'Home';

// If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy = 'product_cat';

// Get the query & post information
    global $post, $wp_query;

// Do not display on the homepage
    if (!is_front_page()) {

// Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';

        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';

        if (is_archive() && !is_tax() && !is_category() && !is_tag()) {

            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';

        } else if (is_archive() && is_tax() && !is_category() && !is_tag()) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if ($post_type != 'post') {

                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';

            }

            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';

        } else if (is_single()) {

            // If post is a custom post type
            $post_type = get_post_type();

            // If it is a custom post type display name and link
            if ($post_type != 'post') {

                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);

                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';

            }

            // Get post category info
            $category = get_the_category();

            if (!empty($category)) {

                // Get last category post is in
                $last_category = end(array_values($category));

                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','), ',');
                $cat_parents = explode(',', $get_cat_parents);

                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach ($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">' . $parents . '</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }

            }

            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if (empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {

                $taxonomy_terms = get_the_terms($post->ID, $custom_taxonomy);
                $cat_id = $taxonomy_terms[0]->term_id;
                $cat_nicename = $taxonomy_terms[0]->slug;
                $cat_link = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name = $taxonomy_terms[0]->name;

            }

            // Check if the post is in a category
            if (!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

                // Else if post is in a custom taxonomy
            } else if (!empty($cat_id)) {

                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

            } else {

                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

            }

        } else if (is_category()) {

            // Category page
            echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';

        } else if (is_page()) {

            // Standard page
            if ($post->post_parent) {

                // If child page, get parents
                $anc = get_post_ancestors($post->ID);

                // Get parents in the right order
                $anc = array_reverse($anc);

                // Parent page loop
                if (!isset($parents)) $parents = null;
                foreach ($anc as $ancestor) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }

                // Display parent pages
                echo $parents;

                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';

            } else {

                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';

            }

        } else if (is_tag()) {

            // Tag page

            // Get tag information
            $term_id = get_query_var('tag_id');
            $taxonomy = 'post_tag';
            $args = 'include=' . $term_id;
            $terms = get_terms($taxonomy, $args);
            $get_term_id = $terms[0]->term_id;
            $get_term_slug = $terms[0]->slug;
            $get_term_name = $terms[0]->name;

            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';

        } elseif (is_day()) {

            // Day archive

            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link(get_the_time('Y')) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';

            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';

        } else if (is_month()) {

            // Month Archive

            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link(get_the_time('Y')) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';

        } else if (is_year()) {

            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';

        } else if (is_author()) {

            // Auhor archive

            // Get the author information
            global $author;
            $userdata = get_userdata($author);

            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';

        } else if (get_query_var('paged')) {

            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">' . __('Page') . ' ' . get_query_var('paged') . '</strong></li>';

        } else if (is_search()) {

            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';

        } elseif (is_404()) {

            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }

        echo '</ul>';

    }
}