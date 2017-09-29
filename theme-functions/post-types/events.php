<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 30/06/2017
 * Time: 23:30
 */

// 1. Custom Post Type Registration (Events)

add_action( 'init', 'create_event_postype' );

function create_event_postype() {

    $labels = array(
        'name' => _x('Calendar', 'post type general name', 'medica-theme'),
        'singular_name' => _x('Event', 'post type singular name'),
        'add_new' => _x('Add New', 'events'),
        'add_new_item' => __('Add New Event'),
        'edit_item' => __('Edit Event'),
        'new_item' => __('New Event'),
        'view_item' => __('View Event'),
        'search_items' => __('Search Events'),
        'not_found' =>  __('No events found'),
        'not_found_in_trash' => __('No events found in Trash'),
        'parent_item_colon' => '',
    );

    $args = array(
        'label' => __('Calendar','medica-theme'),
        'labels' => $labels,
        'public' => true,
        'can_export' => true,
        'show_ui' => true,
        'has_archive' => true,
        '_builtin' => false,
        'capability_type' => 'post',
        'menu_icon' => "dashicons-calendar-alt",
        'hierarchical' => false,
        'rewrite' => array( "slug" => _x("calendar", 'slug for the events' ,'medica-theme')),
        'supports'=> array('title', 'thumbnail', 'editor') ,
        'show_in_nav_menus' => true,
        "menu_position" => 6,
        'capabilities' => array(
            'edit_post' => 'edit_event',
            'edit_posts' => 'edit_events',
            'edit_others_posts' => 'edit_other_events',
            'publish_posts' => 'publish_events',
            'read_post' => 'read_event',
            'read_private_posts' => 'read_private_events',
            'delete_post' => 'delete_event'
        ),
        'map_meta_cap' => true
    );

    register_post_type( 'tf_events', $args);

}

// 3. Show Columns

add_filter ("manage_edit-tf_events_columns", "tf_events_edit_columns");
add_action ("manage_posts_custom_column", "tf_events_custom_columns");

function tf_events_edit_columns($columns) {

    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => "Event",
        "tf_col_ev_location" => "Location",
        "tf_col_ev_start_date" => "Start date",
        "tf_col_ev_end_date" => "End date",
    );
    return $columns;
}

function tf_events_custom_columns($column)
{
    global $post;
    $custom = get_post_custom();
    switch ($column)
    {
        case "tf_col_ev_location":
            // - show Location -
            echo $custom["tf_events_location"][0];
            break;
        case "tf_col_ev_start_date":
            // - show dates -
            $startd = $custom["tf_events_startdate"][0];
            $startdate = date("l j F Y", $startd);

            $time_format = get_option('time_format');
            $starttime = date($time_format, $startd);

            echo $startdate . ' ' . $starttime;
            break;
        case "tf_col_ev_end_date":
            // - show times -
            $endd = $custom["tf_events_enddate"][0];
            $enddate = date("l j F Y", $endd);


            $time_format = get_option('time_format');
            $endtime = date($time_format, $endd);

            echo $enddate . ' ' .$endtime;
            break;
    }
}

// 4. Show Meta-Box

add_action( 'admin_init', 'tf_events_create' );

function tf_events_create() {
    add_meta_box('tf_events_meta', 'Event details', 'tf_events_meta', 'tf_events');
}

function tf_events_meta () {

// - grab data -

    global $post;
    $custom = get_post_custom($post->ID);
    $meta_sd = $custom["tf_events_startdate"][0];
    $meta_ed = $custom["tf_events_enddate"][0];
    $meta_st = $meta_sd;
    $meta_et = $meta_ed;

    $location = $custom["tf_events_location"][0];

// - grab wp time format -

    $date_format = get_option('date_format'); // Not required in my code
    $time_format = get_option('time_format');

// - populate today if empty, 00:00 for time -

    if ($meta_sd == null) {
        $meta_sd = time(); $meta_ed = $meta_sd; $meta_st = 0; $meta_et = 0;
    }

// - convert to pretty formats -

    $clean_sd = date($date_format, $meta_sd);
    $clean_ed = date($date_format, $meta_ed);
    $clean_st = date($time_format, $meta_st);
    $clean_et = date($time_format, $meta_et);

// - security -

    echo '<input type="hidden" name="tf-events-nonce" id="tf-events-nonce" value="' .
        wp_create_nonce( 'tf-events-nonce' ) . '" />';

// - output -

    ?>
    <div class="tf-meta">
        <ul>
            <li>
                <label>Location</label><input name="tf_events_location" value="<?php echo $location; ?>" />
            </li>
        </ul>
        <hr/>
        <ul>
            <li>
                <label>Start Date</label><input name="tf_events_startdate" class="tfdate" value="<?php echo $clean_sd; ?>" />
                <div class="clear"></div>
            </li>
            <li>
                <label>Start Time</label><input name="tf_events_starttime" value="<?php echo $clean_st; ?>" /><em>Use 24h format</em>
            </li>
        </ul>
        <hr/>
        <ul>
            <li><label>End Date</label><input name="tf_events_enddate" class="tfdate" value="<?php echo $clean_ed; ?>" /></li>
            <li><label>End Time</label><input name="tf_events_endtime" value="<?php echo $clean_et; ?>" /><em>Use 24h format</em></li>
        </ul>
    </div>
    <?php
}

// 5. Save Data

add_action ('save_post', 'save_tf_events');

function save_tf_events(){

    global $post;

// - still require nonce

    if ( !wp_verify_nonce( $_POST['tf-events-nonce'], 'tf-events-nonce' )) {
        return $post->ID;
    }

    if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;

// - convert back to unix & update post

    if(!isset($_POST["tf_events_startdate"])):
        return $post;
    endif;
    $updatestartd = strtotime ( $_POST["tf_events_startdate"] . " " . $_POST["tf_events_starttime"] );
    update_post_meta($post->ID, "tf_events_startdate", $updatestartd );

    if(!isset($_POST["tf_events_enddate"])):
        return $post;
    endif;
    $updateendd = strtotime ( $_POST["tf_events_enddate"]  . " " . $_POST["tf_events_endtime"]);
    update_post_meta($post->ID, "tf_events_enddate", $updateendd );

    // Update location
    if(!isset($_POST["tf_events_location"])):
        return $post;
    endif;
    update_post_meta($post->ID, "tf_events_location", $_POST["tf_events_location"] );

}

// 6. Customize Update Messages

add_filter('post_updated_messages', 'events_updated_messages');

function events_updated_messages( $messages ) {

    global $post, $post_ID;

    $messages['tf_events'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => sprintf( __('Event updated. <a href="%s">View item</a>'), esc_url( get_permalink($post_ID) ) ),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Event updated.'),
        /* translators: %s: date and time of the revision */
        5 => isset($_GET['revision']) ? sprintf( __('Event restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __('Event published. <a href="%s">View event</a>'), esc_url( get_permalink($post_ID) ) ),
        7 => __('Event saved.'),
        8 => sprintf( __('Event submitted. <a target="_blank" href="%s">Preview event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __('Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview event</a>'),
            // translators: Publish box date format, see http://php.net/date
            date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('Event draft updated. <a target="_blank" href="%s">Preview event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );

    return $messages;
}

// 7. Display logic for getting the events overview

function getEvents ( $atts )
{

    // - define arguments -
    extract(shortcode_atts(array(
        'limit' => '10', // # of events to show
        'fromToday' => true
    ), $atts));


    // ===== LOOP: FULL EVENTS SECTION =====

    // - hide events that are older than 6am today (because some parties go past your bedtime) -

    $today6am = strtotime('today 6:00') + ( get_option( 'gmt_offset' ) * 3600 );

    // - query -
    global $wpdb;
    $querystr = "
                        SELECT *
                        FROM $wpdb->posts wposts, $wpdb->postmeta metastart, $wpdb->postmeta metaend
                        WHERE (wposts.ID = metastart.post_id AND wposts.ID = metaend.post_id)
                        AND (metaend.meta_key = 'tf_events_enddate' AND metaend.meta_value > $today6am )
                        AND metastart.meta_key = 'tf_events_enddate'
                        AND wposts.post_type = 'tf_events'
                        AND wposts.post_status = 'publish'
                        ORDER BY metastart.meta_value ASC LIMIT $limit
                     ";

    $events = $wpdb->get_results($querystr, OBJECT);

    return $events;
}