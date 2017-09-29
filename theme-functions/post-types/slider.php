<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 30/06/2017
 * Time: 23:30
 */

// 1. Custom Post Type Registration (Slider)

add_action( 'init', 'create_slider_postype' );

function create_slider_postype() {

    $labels = array(
        'name' => _x('Slider', 'post type general name'),
        'singular_name' => _x('Slide', 'post type singular name'),
        'add_new' => _x('Add New', 'slider'),
        'add_new_item' => __('Add New Slide'),
        'edit_item' => __('Edit Slide'),
        'new_item' => __('New Slide'),
        'view_item' => __('View Slide'),
        'search_items' => __('Search Slides'),
        'not_found' =>  __('No events found'),
        'not_found_in_trash' => __('No slides found in Trash'),
        'parent_item_colon' => '',
    );

    $args = array(
        'label' => __('Slider'),
        'labels' => $labels,
        'public' => true,
        'can_export' => true,
        'show_ui' => true,
        '_builtin' => false,
        'capability_type' => 'post',
        'menu_icon' => "dashicons-images-alt2",
        'hierarchical' => false,
        'rewrite' => array( "slug" => _x('s', 'slug for the highlight slider', 'medica-theme')),
        'supports'=> array('title', 'thumbnail', 'editor') ,
        'show_in_nav_menus' => true,
        "menu_position" => 6,
        'capabilities' => array(
            'edit_post' => 'edit_slide',
            'edit_posts' => 'edit_slides',
            'edit_others_posts' => 'edit_other_slides',
            'publish_posts' => 'publish_slides',
            'read_post' => 'read_slide',
            'read_private_posts' => 'read_private_slides',
            'delete_post' => 'delete_slide'
        ),
        'map_meta_cap' => true
    );

    register_post_type( 'tf_slider', $args);

}

// 3. Show Columns

add_filter ("manage_edit-tf_slider_columns", "tf_slider_edit_columns");
add_action ("manage_posts_custom_column", "tf_slider_custom_columns");

function tf_slider_edit_columns($columns) {

    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => "Slide",
        "tf_col_slider_subtitle" => "Subtitle",
        "tf_col_slider_position" => "Position",
        "tf_col_slider_img" => "Thumbnails",
        'author' => 'Author',
        'date' => 'Date'
    );
    return $columns;
}

function tf_slider_custom_columns($column)
{
    global $post;
    $custom = get_post_custom();
    switch ($column)
    {
        case "tf_col_slider_position":
            echo $custom["tf_slider_position"][0];
            break;
        case "tf_col_slider_subtitle":
            // - show Location -
            echo $custom["tf_slider_subtitle"][0];
            break;
        case 'tf_col_slider_img':
            echo the_post_thumbnail( array(70, 70));
            break;
    }
}

// 4. Show Meta-Box

add_action( 'admin_init', 'tf_slider_create' );

function tf_slider_create() {
    add_meta_box('tf_slider_meta', 'Slide details', 'tf_slider_meta', 'tf_slider');
}

function tf_slider_meta () {

// - grab data -

    global $post;
    $custom = get_post_custom($post->ID);

    $subtitle = $custom["tf_slider_subtitle"][0];
    $postition = $custom["tf_slider_position"][0];


// - security -

    echo '<input type="hidden" name="tf-slider-nonce" id="tf-slider-nonce" value="' .
        wp_create_nonce( 'tf-slider-nonce' ) . '" />';

// - output -

    ?>
    <div class="tf-meta">
        <ul>
            <li>
                <label>Subtitle</label><input name="tf_slider_subtitle" value="<?php echo $subtitle; ?>" />
            </li>
        </ul>
        <hr/>
        <ul>
            <li>
                <label>Position</label><input name="tf_slider_position" value="<?php echo $postition; ?>" type="number" /><em>The order of the visible slides</em>
            </li>
        </ul>
    </div>
    <?php
}

// 5. Save Data

add_action ('save_post', 'save_tf_slider');

function save_tf_slider(){

    global $post;

// - still require nonce

    if ( !wp_verify_nonce( $_POST['tf-slider-nonce'], 'tf-slider-nonce' )) {
        return $post->ID;
    }

    if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;

// - convert back to unix & update post

    // Update subtitle
    if(!isset($_POST["tf_slider_subtitle"])):
        return $post;
    endif;
    update_post_meta($post->ID, "tf_slider_subtitle", $_POST["tf_slider_subtitle"] );

    // Update position
    if(!isset($_POST["tf_slider_position"])):
        return $post;
    endif;
    update_post_meta($post->ID, "tf_slider_position", (int)$_POST["tf_slider_position"] );

}

// 6. Customize Update Messages

add_filter('post_updated_messages', 'slider_updated_messages');

function slider_updated_messages( $messages ) {

    global $post, $post_ID;

    $messages['tf_slider'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => sprintf( __('Event updated. <a href="%s">View item</a>'), esc_url( get_permalink($post_ID) ) ),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Slide updated.'),
        /* translators: %s: date and time of the revision */
        5 => isset($_GET['revision']) ? sprintf( __('Slide restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __('Slide published. <a href="%s">View slide</a>'), esc_url( get_permalink($post_ID) ) ),
        7 => __('Event saved.'),
        8 => sprintf( __('Slide submitted. <a target="_blank" href="%s">Preview slide</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __('Slide scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview dlide</a>'),
            // translators: Publish box date format, see http://php.net/date
            date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('Slide draft updated. <a target="_blank" href="%s">Preview event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );

    return $messages;
}


// 7. Display logic for getting the events overview

function getSlides ( $atts )
{

    // - define arguments -
    extract(shortcode_atts(array(
        'limit' => '10', // # of events to show
    ), $atts));


    // - query -
    global $wpdb;
    $querystr = "
                        SELECT *
                        FROM $wpdb->posts wposts, $wpdb->postmeta metasubtitle, $wpdb->postmeta metaposition
                        WHERE (wposts.ID = metasubtitle.post_id AND wposts.ID = metaposition.post_id)
                        AND metasubtitle.meta_key = 'tf_slider_subtitle' AND metaposition.meta_key = 'tf_slider_position'
                        AND wposts.post_type = 'tf_slider'
                        AND wposts.post_status = 'publish'
                        ORDER BY metaposition.meta_value ASC LIMIT $limit
                     ";

    $events = $wpdb->get_results($querystr, OBJECT);

    return $events;
}