<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 30/06/2017
 * Time: 23:30
 */

// 1. Custom Post Type Registration (Slider)

add_action( 'init', 'create_poi_postype' );

function create_poi_postype() {

    $labels = array(
        'name' => _x('POI', 'post type general name'),
        'singular_name' => _x('Poi', 'post type singular name'),
        'add_new' => _x('Add New', 'poi'),
        'add_new_item' => __('Add New Poi'),
        'edit_item' => __('Edit Poi'),
        'new_item' => __('New Poi'),
        'view_item' => __('View Poi'),
        'search_items' => __('Search Poi'),
        'not_found' =>  __('No poi found'),
        'not_found_in_trash' => __('No poi found in Trash'),
        'parent_item_colon' => '',
    );

    $args = array(
        'label' => __('POI'),
        'labels' => $labels,
        'public' => false,
        'can_export' => true,
        'show_ui' => true,
        '_builtin' => false,
        'capability_type' => 'post',
        'menu_icon' => "dashicons-location-alt",
        'hierarchical' => false,
        'rewrite' => array( "slug" => "poi"),
        'supports'=> array('title') ,
        'show_in_nav_menus' => true,
        "menu_position" => 6,
    );

    register_post_type( 'tf_poi', $args);

}

flush_rewrite_rules( false );


// 3. Show Columns

add_filter ("manage_edit-tf_poi_columns", "tf_poi_edit_columns");
add_action ("manage_posts_custom_column", "tf_poi_custom_columns");

function tf_poi_edit_columns($columns) {

    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => "Name",
        "tf_col_poi_address" => "Address",
        "tf_col_poi_position" => "Position",
        'author' => 'Author',
        'date' => 'Date'
    );
    return $columns;
}

function tf_poi_custom_columns($column)
{
    $custom = get_post_custom();
    switch ($column)
    {
        case "tf_col_poi_position":
            echo $custom["tf_poi_position"][0];
            break;
        case "tf_col_poi_address":
            // - show Location -
            echo $custom["tf_poi_address"][0];
            break;
    }
}

// 4. Show Meta-Box

add_action( 'admin_init', 'tf_poi_create' );

function tf_poi_create() {
    add_meta_box('tf_poi_meta', 'Poi details', 'tf_poi_meta', 'tf_poi');
}

function tf_poi_meta () {

// - grab data -

    global $post;
    $custom = get_post_custom($post->ID);

    $address = $custom["tf_poi_address"][0];
    $position = $custom["tf_poi_position"][0];

    $latitude = $custom["tf_poi_lat"][0];
    $longitude = $custom["tf_poi_lng"][0];



// - security -

    echo '<input type="hidden" name="tf-poi-nonce" id="tf-poi-nonce" value="' .
        wp_create_nonce( 'tf-poi-nonce' ) . '" />';

// - output -

    ?>
    <div class="tf-meta">
        <ul>
            <li>
                <label>Address</label><input name="tf_poi_address" value="<?php echo $address; ?>" />
            </li>
        </ul>
        <hr/>
        <ul>
            <li>
                <label>Latitude</label><input name="tf_poi_lat" value="<?php echo $latitude; ?>" />
            </li>
            <li>
                <label>Longitude</label><input name="tf_poi_lng" value="<?php echo $longitude; ?>" />
            </li>
        </ul>
        <hr/>
        <ul>
            <li>
                <label>Position</label><input name="tf_poi_position" value="<?php echo $position; ?>" type="number" /><em>The order the poi</em>
            </li>
        </ul>
    </div>
    <?php
}

// 5. Save Data

add_action ('save_post', 'save_tf_poi');

function save_tf_poi(){

    global $post;

// - still require nonce

    if ( !wp_verify_nonce( $_POST['tf-poi-nonce'], 'tf-poi-nonce' )) {
        return $post->ID;
    }

    if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;

// - convert back to unix & update post

    // Update subtitle
    if(!isset($_POST["tf_poi_address"])):
        return $post;
    endif;
    update_post_meta($post->ID, "tf_poi_address", $_POST["tf_poi_address"] );

    // Update position
    if(!isset($_POST["tf_poi_position"])):
        return $post;
    endif;
    update_post_meta($post->ID, "tf_poi_position", (int)$_POST["tf_poi_position"] );

    // Update latitude
    if(!isset($_POST["tf_poi_lat"])):
        return $post;
    endif;
    update_post_meta($post->ID, "tf_poi_lat", floatval($_POST["tf_poi_lat"]) );

    // Update latitude
    if(!isset($_POST["tf_poi_lng"])):
        return $post;
    endif;
    update_post_meta($post->ID, "tf_poi_lng", floatval($_POST["tf_poi_lng"]) );

}

// 6. Customize Update Messages

add_filter('post_updated_messages', 'poi_updated_messages');

function poi_updated_messages( $messages ) {

    global $post, $post_ID;

    $messages['tf_poi'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => sprintf( __('Event updated. <a href="%s">View item</a>'), esc_url( get_permalink($post_ID) ) ),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Poi updated.'),
        /* translators: %s: date and time of the revision */
        5 => isset($_GET['revision']) ? sprintf( __('Poi restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __('Poi published. <a href="%s">View Poi</a>'), esc_url( get_permalink($post_ID) ) ),
        7 => __('Event saved.'),
        8 => sprintf( __('Poi submitted. <a target="_blank" href="%s">Preview Poi</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __('Poi scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Poi</a>'),
            // translators: Publish box date format, see http://php.net/date
            date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('Poi draft updated. <a target="_blank" href="%s">Preview event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );

    return $messages;
}


// 7. Display logic for getting the events overview

function getPoi ( $atts )
{

    // - define arguments -
    extract(shortcode_atts(array(
        'limit' => '2', // # of events to show
    ), $atts));


    // - query -
    global $wpdb;
    $querystr = "
                        SELECT *
                        FROM $wpdb->posts wposts, $wpdb->postmeta metaaddress, $wpdb->postmeta metaposition, $wpdb->postmeta metalat, $wpdb->postmeta metalng
                        WHERE (wposts.ID = metaaddress.post_id AND wposts.ID = metaposition.post_id AND wposts.ID = metalat.post_id AND wposts.ID = metalng.post_id)
                        AND metaaddress.meta_key = 'tf_poi_address' AND metaposition.meta_key = 'tf_poi_position'
                        AND metalat.meta_key = 'tf_poi_lat' AND metalng.meta_key = 'tf_poi_lng'
                        AND wposts.post_type = 'tf_poi'
                        AND wposts.post_status = 'publish'
                        ORDER BY metaposition.meta_value ASC LIMIT $limit
                     ";

    $poi = $wpdb->get_results($querystr, OBJECT);

    return $poi;
}