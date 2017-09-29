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
    add_submenu_page( 'theme-panel', 'Footer Form Widget', 'Footer Form widget', 'manage_options', 'theme-panel-form-widget', "theme_form_widget_page");
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

function theme_form_widget_page()
{
    ?>
    <div class="wrap">
        <h1>Footer Form Widget</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields("section-form-widget");
            do_settings_sections("theme-form-widget");

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

function display_email_advert_element()
{
    ?>
    <input type="text" name="medica_email_advert" id="medica_email_adveret" value="<?php echo get_option('medica_email_advert'); ?>" />
    <?php
}

function display_email_content_element()
{
    ?>
    <input type="text" name="medica_email_content" id="medica_email_content" value="<?php echo get_option('medica_email_content'); ?>" />
    <?php
}


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

function display_form_active()
{
    ?>
    <input type="checkbox" name="form_gen_active" id="form_gen_active" value="true" <?php echo get_option('form_gen_active') === "true" ? "checked" : ""; ?>/>
    <?php
}

function upload_form_image_metabox() {
    ?>
    <input type="hidden" id="form_gen_img" name="form_gen_img" value="<?php echo get_option('form_gen_img'); ?>" />
    <img id="form_gen_img--img" src="<?php echo get_option('form_gen_img'); ?>" style="max-height: 150px; max-width: 150px;"/>
    <br/>
    <input id="child_upload_logo_button" type="button" class="button" value="Upload Image" />



    <script type="text/javascript">
        // JavaScript to launch media uploader, should be enqueued in a separate file
        jQuery(document).ready(function() {
            jQuery('#child_upload_logo_button').click(function() {
                wp.media.editor.send.attachment = function(props, attachment) {
                    jQuery('#form_gen_img').val(attachment.url);
                    jQuery('#form_gen_img--img').attr('src', attachment.url);
                }
                wp.media.editor.open(this);
                return false;
            });
        });
    </script>

    <?php

}

function display_form_title()
{
    ?>
    <input type="text" name="form_front_title" id="form_gen_title" value="<?php echo get_option('form_front_title'); ?>" size="100"/>
    <?php
}

function display_form_subtitle()
{
    ?>
    <input type="text" name="form_front_subtitle" id="form_gen_subtitle" value="<?php echo get_option('form_front_subtitle'); ?>" size="100"/>
    <?php
}

function display_form_highlight()
{
    ?>
    <input type="text" name="form_front_highlight" id="form_gen_highlight" value="<?php echo get_option('form_front_highlight'); ?>" size="100"/>
    <?php
}

function display_form_email_subject()
{
    ?>
    <input type="text" name="form_email_subject" id="form_email_subject" value="<?php echo get_option('form_email_subject'); ?>" size="100"/>
    <?php
}

function display_form_email_address()
{
    ?>
    <input type="text" name="form_email_address" id="form_email_address" value="<?php echo get_option('form_email_address'); ?>" size="100"/>
    <?php
}

function display_theme_panel_fields()
{
    // General settings
    add_settings_section("section-options", "General Settings", null, "theme-options");
    add_settings_field("medica_email", "Medica email", "display_email_element", "theme-options", "section-options");
    register_setting("section-options", "medica_email");
    add_settings_field("medica_email_advert", "Medica email adverteren", "display_email_advert_element", "theme-options", "section-options");
    register_setting("section-options", "medica_email_advert");
    add_settings_field("medica_email_content", "Medica email content", "display_email_content_element", "theme-options", "section-options");
    register_setting("section-options", "medica_email_content");
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

    // Form widget Settings
    add_settings_section("section-general", "General settings", null, "theme-form-widget");
    add_settings_field("form_gen_active", "Form active", "display_form_active", "theme-form-widget", "section-general");
    add_settings_field("form_gen_img", "Background Image Form", "upload_form_image_metabox", "theme-form-widget", "section-general");
    register_setting("section-form-widget", "form_gen_active");
    register_setting("section-form-widget", "form_gen_img");

    add_settings_section("section-front", "Widget Frontpage", null, "theme-form-widget");
    add_settings_field("form_front_title", "Form Title", "display_form_title", "theme-form-widget", "section-front");
    add_settings_field("form_front_subtitle", "Form Subtitle", "display_form_subtitle", "theme-form-widget", "section-front");
    add_settings_field("form_front_highlight", "Form Highlight", "display_form_highlight", "theme-form-widget", "section-front");
    register_setting("section-form-widget", "form_front_title");
    register_setting("section-form-widget", "form_front_subtitle");
    register_setting("section-form-widget", "form_front_highlight");

    add_settings_section("section-email", "Widget Email", null, "theme-form-widget");
    add_settings_field("form_email_address", "Email address", "display_form_email_address", "theme-form-widget", "section-email");
    add_settings_field("form_email_subject", "Email subject", "display_form_email_subject", "theme-form-widget", "section-email");
    register_setting("section-form-widget", "form_email_address");
    register_setting("section-form-widget", "form_email_subject");



}

add_action("admin_init", "display_theme_panel_fields");
