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
