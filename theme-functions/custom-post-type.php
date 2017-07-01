<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 30/06/2017
 * Time: 23:29
 */

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