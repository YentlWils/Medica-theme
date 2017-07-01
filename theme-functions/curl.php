<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 30/06/2017
 * Time: 23:24
 */

/*
 * Development function for instagram curl
 */
function api_curl_connect( $api_url ){
    $connection_c = curl_init(); // initializing
    curl_setopt($connection_c, CURLOPT_SSL_VERIFYPEER, false);
//    curl_setopt($connection_c, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt( $connection_c, CURLOPT_URL, $api_url ); // API URL to connect
    curl_setopt( $connection_c, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
    curl_setopt( $connection_c, CURLOPT_TIMEOUT, 20 );
    $json_return = curl_exec( $connection_c ); // connect and get json data
    curl_close( $connection_c ); // close connection
    return json_decode( $json_return ); // decode and return
}