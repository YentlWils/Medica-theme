<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 26/07/2017
 * Time: 14:51
 */

function rewrite_event_url() {
    add_rewrite_rule(
        _x("calendar", 'slug for the events' ,'medica-theme').'/(\d{2})/(\d{4})/?',
        'index.php?post_type=tf_events&event_month=$matches[1]&event_year=$matches[2]',
        'top'
    );
}
add_action( 'init', 'rewrite_event_url' );

function register_custom_query_vars( $vars ) {
    array_push( $vars, 'event_month' );
    array_push( $vars, 'event_year' );

    return $vars;
}
add_filter( 'query_vars', 'register_custom_query_vars', 1 );

function events_pre_get_posts( $query ) {
    if (is_admin() || !is_archive() || !in_array ( $query->get('post_type'), array('tf_events') ) ) {
        return;
    }

    $month = empty(get_query_var("event_month")) ? date("m") : get_query_var("event_month");
    $year = empty(get_query_var("event_year")) ? date("Y") : get_query_var("event_year");

    $numberOfDays = cal_days_in_month(CAL_GREGORIAN, intval($month), intval($year));

    $startDate = strtotime('01-' . $month . "-" . $year);
    $endDate = strtotime($numberOfDays . '-' . $month . "-" . $year);


    $query->set( 'post_type', 'tf_events' );
    $query->set( 'orderby', 'tf_events_startdate' );
    $query->set( 'order', 'ASC' );
    $query->set( 'meta_query', array(
        array(
            'key' => 'tf_events_startdate',
            'value' => $startDate,
            'compare' => '>=',
            'type' => 'numeric'
        ),
        array(
            'key' => 'tf_events_startdate',
            'value' => $endDate,
            'compare' => '<=',
            'type' => 'numeric'
        )
    ));


    return $query;
}
add_action('pre_get_posts', 'events_pre_get_posts', 10, 1);

