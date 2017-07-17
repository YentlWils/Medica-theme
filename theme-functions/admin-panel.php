<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 30/06/2017
 * Time: 23:27
 */

/**
 * ==========================================
 * Settings page
 * ==========================================
 */

function add_theme_menu_item()
{
    add_menu_page("Medica Settings", "Medica Settings", "manage_options", "theme-panel", "theme_settings_page", null, 9);
    add_submenu_page( 'theme-panel', 'Social Media API', 'Social Media API', 'manage_options', 'theme-panel-social', "theme_social_page");
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

function theme_social_page()
{
    ?>
    <div class="wrap">
        <h1>Social Media API</h1>
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


function display_facebook_page()
{
    ?>
    <input type="text" name="fb_page" id="fb_page" value="<?php echo get_option('fb_page'); ?>" />
    <?php
}

function display_facebook_token()
{
    ?>
    <textarea type="text" name="fb_token" id="fb_token" rows="8" cols="50"><?php echo get_option('fb_token'); ?></textarea>
    <?php
}

function display_instagram_page()
{
    ?>
    <input type="text" name="inst_page" id="inst_page" value="<?php echo get_option('inst_page'); ?>" />
    <?php
}

function display_instagram_token()
{
    ?>
    <textarea type="text" name="inst_token" id="inst_token" rows="8" cols="50"><?php echo get_option('inst_token'); ?></textarea>
    <?php
}

function display_theme_panel_fields()
{
    // General settings
    add_settings_section("section-options", "General Settings", null, "theme-options");
    add_settings_field("medica_email", "Medica email", "display_email_element", "theme-options", "section-options");
    register_setting("section-options", "medica_email");
    add_settings_field("medica_address", "Main Address", "display_address_element", "theme-options", "section-options");
    register_setting("section-options", "medica_address");

    // Social media settings
    add_settings_section("section-facebook", "Facebook", null, "theme-social");
    add_settings_field("fb_page", "Facebook Page Name", "display_facebook_page", "theme-social", "section-facebook");
    add_settings_field("fb_token", "Facebook Access Token", "display_facebook_token", "theme-social", "section-facebook");
    register_setting("section-social", "fb_page");
    register_setting("section-social", "fb_token");

    add_settings_section("section-instagram", "Instagram", null, "theme-social");
    add_settings_field("inst_page", "Instagram Page Name", "display_instagram_page", "theme-social", "section-instagram");
    add_settings_field("inst_token", "Instagram Access Token", "display_instagram_token", "theme-social", "section-instagram");
    register_setting("section-social", "inst_page");
    register_setting("section-social", "inst_token");

}

add_action("admin_init", "display_theme_panel_fields");
