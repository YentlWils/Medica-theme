<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 30/06/2017
 * Time: 23:30
 */

// 1. Custom Post Type Registration (Slider)

add_action( 'init', 'create_links_postype' );

function create_links_postype() {

    $labels = array(
        'name' => _x('Links', 'post type general name'),
        'singular_name' => _x('Link', 'post type singular name'),
        'add_new' => _x('Add New', 'links'),
        'add_new_item' => __('Add New Link'),
        'edit_item' => __('Edit Link'),
        'new_item' => __('New Link'),
        'view_item' => __('View Link'),
        'search_items' => __('Search Links'),
        'not_found' =>  __('No links found'),
        'not_found_in_trash' => __('No links found in Trash'),
        'parent_item_colon' => '',
    );

    $args = array(
        'label' => __('Links'),
        'labels' => $labels,
        'public' => false,
        'can_export' => true,
        'show_ui' => true,
        '_builtin' => false,
        'capability_type' => 'post',
        'menu_icon' => "dashicons-admin-links",
        'hierarchical' => false,
        'rewrite' => array( "slug" => "links"),
        'supports'=> array('title', 'thumbnail') ,
        'show_in_nav_menus' => false,
        "menu_position" => 6,
        'capabilities' => array(
            'edit_post' => 'edit_link',
            'edit_posts' => 'edit_links',
            'edit_others_posts' => 'edit_other_links',
            'publish_posts' => 'publish_links',
            'read_post' => 'read_link',
            'read_private_posts' => 'read_private_links',
            'delete_post' => 'delete_link'
        ),
        'map_meta_cap' => true
    );

    register_post_type( 'tf_links', $args);

}

flush_rewrite_rules( false );


// 3. Show Columns

add_filter ("manage_edit-tf_links_columns", "tf_links_edit_columns");
add_action ("manage_posts_custom_column", "tf_links_custom_columns");

function tf_links_edit_columns($columns) {

    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => "Name",
        "tf_col_links_url" => "URL",
        "tf_col_links_position" => "Position",
        'author' => 'Author',
        'date' => 'Date'
    );
    return $columns;
}

function tf_links_custom_columns($column)
{
    $custom = get_post_custom();
    switch ($column)
    {
        case "tf_col_links_position":
            echo $custom["tf_links_position"][0];
            break;
        case "tf_col_links_url":
            // - show Location -
            echo $custom["tf_links_url"][0];
            break;
    }
}

// 4. Show Meta-Box

add_action( 'admin_init', 'tf_links_create' );

function tf_links_create() {
    add_meta_box('tf_links_meta', 'Links details', 'tf_links_meta', 'tf_links');
}

function tf_links_meta () {

// - grab data -

    global $post;
    $custom = get_post_custom($post->ID);

    $url = $custom["tf_links_url"][0];
    $postition = $custom["tf_links_position"][0];


// - security -

    echo '<input type="hidden" name="tf-links-nonce" id="tf-links-nonce" value="' .
        wp_create_nonce( 'tf-links-nonce' ) . '" />';

// - output -

    ?>
    <div class="tf-meta">
        <ul>
            <li>
                <label>Url</label><input name="tf_links_url" value="<?php echo $url; ?>" />
            </li>
        </ul>
        <hr/>
        <ul>
            <li>
                <label>Position</label><input name="tf_links_position" value="<?php echo $postition; ?>" type="number" /><em>The order the links</em>
            </li>
        </ul>
    </div>
    <?php
}

// 5. Save Data

add_action ('save_post', 'save_tf_links');

function save_tf_links(){

    global $post;

// - still require nonce

    if ( !wp_verify_nonce( $_POST['tf-links-nonce'], 'tf-links-nonce' )) {
        return $post->ID;
    }

    if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;

// - convert back to unix & update post

    // Update subtitle
    if(!isset($_POST["tf_links_url"])):
        return $post;
    endif;
    update_post_meta($post->ID, "tf_links_url", $_POST["tf_links_url"] );

    // Update position
    if(!isset($_POST["tf_links_position"])):
        return $post;
    endif;
    update_post_meta($post->ID, "tf_links_position", (int)$_POST["tf_links_position"] );

}

// 6. Customize Update Messages

add_filter('post_updated_messages', 'links_updated_messages');

function links_updated_messages( $messages ) {

    global $post, $post_ID;

    $messages['tf_links'] = array(
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

function getLinks ( $atts )
{

    // - define arguments -
    extract(shortcode_atts(array(
        'limit' => '2', // # of events to show
    ), $atts));


    // - query -
    global $wpdb;
    $querystr = "
                        SELECT *
                        FROM $wpdb->posts wposts, $wpdb->postmeta metaurl, $wpdb->postmeta metaposition
                        WHERE (wposts.ID = metaurl.post_id AND wposts.ID = metaposition.post_id)
                        AND metaurl.meta_key = 'tf_links_url' AND metaposition.meta_key = 'tf_links_position'
                        AND wposts.post_type = 'tf_links'
                        AND wposts.post_status = 'publish'
                        ORDER BY metaposition.meta_value ASC LIMIT $limit
                     ";

    $links = $wpdb->get_results($querystr, OBJECT);

    return $links;
}