<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 30/06/2017
 * Time: 23:30
 */

// 1. Custom Post Type Registration (Workgroup)

add_action( 'init', 'create_workgroup_postype' );

function create_workgroup_postype() {

    $labels = array(
        'name' => _x('Workgroup', 'post type general name'),
        'singular_name' => _x('Workgroup', 'post type singular name'),
        'add_new' => _x('Add New', 'workgroup'),
        'add_new_item' => __('Add New workgroup'),
        'edit_item' => __('Edit Workgroup'),
        'new_item' => __('New Workgroup'),
        'view_item' => __('View Workgroup'),
        'search_items' => __('Search Workgroup'),
        'not_found' =>  __('No events found'),
        'not_found_in_trash' => __('No workgroup found in Trash'),
        'parent_item_colon' => '',
    );

    $args = array(
        'label' => __('Workgroup'),
        'labels' => $labels,
        'public' => false,
        'can_export' => true,
        'show_ui' => true,
        '_builtin' => false,
        'capability_type' => 'post',
        'menu_icon' => "dashicons-groups",
        'hierarchical' => false,
        'rewrite' => array( "slug" => "workgroup"),
        'supports'=> array('title', 'editor') ,
        'show_in_nav_menus' => false,
        "menu_position" => 6,
    );

    register_post_type( 'tf_workgroup', $args);

}


// 7. Display logic for getting the workgroups overview

function getWorkgroups ( $atts )
{

    // - define arguments -
    extract(shortcode_atts(array(
        'limit' => '10', // # of events to show
    ), $atts));


    // - query -
    global $wpdb;
    $querystr = "
                        SELECT *
                        FROM $wpdb->posts wposts
                        WHERE wposts.post_type = 'tf_workgroup'
                        AND wposts.post_status = 'publish'
                        LIMIT $limit
                     ";

    $workgroups = $wpdb->get_results($querystr, OBJECT);

    return $workgroups;
}