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
