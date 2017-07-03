<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 30/06/2017
 * Time: 23:30
 */

// 1. Custom Post Type Registration (Slider)

add_action( 'init', 'create_sponsors_postype' );

function create_sponsors_postype() {

    $labels = array(
        'name' => _x('Sponsors', 'post type general name'),
        'singular_name' => _x('Link', 'post type singular name'),
        'add_new' => _x('Add New', 'sponsors'),
        'add_new_item' => __('Add New Link'),
        'edit_item' => __('Edit Link'),
        'new_item' => __('New Link'),
        'view_item' => __('View Link'),
        'search_items' => __('Search Sponsors'),
        'not_found' =>  __('No sponsors found'),
        'not_found_in_trash' => __('No sponsors found in Trash'),
        'parent_item_colon' => '',
    );

    $args = array(
        'label' => __('Sponsors'),
        'labels' => $labels,
        'public' => false,
        'can_export' => true,
        'show_ui' => true,
        '_builtin' => false,
        'capability_type' => 'post',
        'menu_icon' => "dashicons-money",
        'hierarchical' => false,
        'rewrite' => array( "slug" => "sponsors"),
        'supports'=> array('title', 'thumbnail') ,
        'show_in_nav_menus' => true,
        "menu_position" => 99,
    );

    register_post_type( 'tf_sponsors', $args);

}

flush_rewrite_rules( false );


// 3. Show Columns

add_filter ("manage_edit-tf_sponsors_columns", "tf_sponsors_edit_columns");
add_action ("manage_posts_custom_column", "tf_sponsors_custom_columns");

function tf_sponsors_edit_columns($columns) {

    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => "Name",
        "tf_col_sponsors_url" => "URL",
        "tf_col_sponsors_main" => "Main sponsor",
        "tf_col_sponsors_img" => "Thumbnails",
        'author' => 'Author',
        'date' => 'Date'
    );
    return $columns;
}

function tf_sponsors_custom_columns($column)
{
    $custom = get_post_custom();
    switch ($column)
    {
        case "tf_col_sponsors_url":
            echo $custom["tf_sponsors_url"][0];
            break;
        case "tf_col_sponsors_main":
            echo $custom["tf_sponsors_main"][0] == 1 ? _e('yes', "medica-theme") : _e('no', "medica-theme");
            break;
        case 'tf_col_sponsors_img':
            echo the_post_thumbnail( array(70, 70));
            break;
    }
}

// 4. Show Meta-Box

add_action( 'admin_init', 'tf_sponsors_create' );

function tf_sponsors_create() {
    add_meta_box('tf_sponsors_meta', 'Sponsors details', 'tf_sponsors_meta', 'tf_sponsors');
}

function tf_sponsors_meta () {

// - grab data -

    global $post;
    $custom = get_post_custom($post->ID);

    $url = $custom["tf_sponsors_url"][0];
    $main = $custom["tf_sponsors_main"][0];


// - security -

    echo '<input type="hidden" name="tf-sponsors-nonce" id="tf-sponsors-nonce" value="' .
        wp_create_nonce( 'tf-sponsors-nonce' ) . '" />';

// - output -

    ?>
    <div class="tf-meta">
        <ul>
            <li>
                <label>Url</label><input name="tf_sponsors_url" value="<?php echo $url; ?>" />
            </li>
        </ul>
        <hr/>
        <ul>
            <li>
                <label>Main sponsor</label>
                <select name="tf_sponsors_main">
                    <option value="1" <?php echo $main === "1" ? 'selected="selected"' : ""; ?>><?php _e('yes', "medica-theme") ?></option>
                    <option value="0" <?php echo $main === "0" ? 'selected="selected"' : ""; ?>><?php _e('no', "medica-theme") ?></option>
                </select>
                <em>Main sponsor, showable in the footer</em>
            </li>
        </ul>
    </div>
    <?php
}

// 5. Save Data

add_action ('save_post', 'save_tf_sponsors');

function save_tf_sponsors(){

    global $post;

// - still require nonce

    if ( !wp_verify_nonce( $_POST['tf-sponsors-nonce'], 'tf-sponsors-nonce' )) {
        return $post->ID;
    }

    if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;

// - convert back to unix & update post

    // Update subtitle
    if(!isset($_POST["tf_sponsors_url"])):
        return $post;
    endif;
    update_post_meta($post->ID, "tf_sponsors_url", $_POST["tf_sponsors_url"] );

    // Update position
    if(!isset($_POST["tf_sponsors_main"])):
        return $post;
    endif;
    update_post_meta($post->ID, "tf_sponsors_main", (int)$_POST["tf_sponsors_main"] );

}

// 6. Customize Update Messages

add_filter('post_updated_messages', 'sponsors_updated_messages');

function sponsors_updated_messages( $messages ) {

    global $post, $post_ID;

    $messages['tf_sponsors'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => sprintf( __('Event updated. <a href="%s">View item</a>'), esc_url( get_permalink($post_ID) ) ),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Link updated.'),
        /* translators: %s: date and time of the revision */
        5 => isset($_GET['revision']) ? sprintf( __('Link restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __('Link published. <a href="%s">View Link</a>'), esc_url( get_permalink($post_ID) ) ),
        7 => __('Event saved.'),
        8 => sprintf( __('Link submitted. <a target="_blank" href="%s">Preview Link</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __('Link scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Link</a>'),
            // translators: Publish box date format, see http://php.net/date
            date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('Link draft updated. <a target="_blank" href="%s">Preview event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );

    return $messages;
}


// 7. Display logic for getting the events overview

function getRegularSponsors ( $atts )
{

    // - define arguments -
    extract(shortcode_atts(array(
        'limit' => '4', // # of events to show
    ), $atts));


    // - query -
    global $wpdb;
    $querystr = "
                        SELECT *
                        FROM $wpdb->posts wposts, $wpdb->postmeta metaurl, $wpdb->postmeta metamain
                        WHERE (wposts.ID = metaurl.post_id AND wposts.ID = metamain.post_id)
                        AND metaurl.meta_key = 'tf_sponsors_url' AND metamain.meta_key = 'tf_sponsors_main'
                        AND wposts.post_type = 'tf_sponsors'
                        AND wposts.post_status = 'publish'
                        AND metamain.meta_value = 0
                        LIMIT $limit
                     ";

    $sponsors = $wpdb->get_results($querystr, OBJECT);

    return $sponsors;
}

function getMainSponsors ( $atts )
{

    // - define arguments -
    extract(shortcode_atts(array(
        'limit' => '4', // # of events to show
    ), $atts));


    // - query -
    global $wpdb;
    $querystr = "
                        SELECT *
                        FROM $wpdb->posts wposts, $wpdb->postmeta metaurl, $wpdb->postmeta metamain
                        WHERE (wposts.ID = metaurl.post_id AND wposts.ID = metamain.post_id)
                        AND metaurl.meta_key = 'tf_sponsors_url' AND metamain.meta_key = 'tf_sponsors_main'
                        AND wposts.post_type = 'tf_sponsors'
                        AND wposts.post_status = 'publish'
                        AND metamain.meta_value = 1
                        ORDER BY RAND() 
                        LIMIT $limit
                     ";

    $sponsors = $wpdb->get_results($querystr, OBJECT);

    return $sponsors;
}