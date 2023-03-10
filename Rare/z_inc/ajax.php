<?php
add_action('wp_ajax_nopriv_z_do_ajax', 'z_do_ajax');
add_action('wp_ajax_z_do_ajax', 'z_do_ajax');
function z_do_ajax() {

    // check_ajax_referer( 'z_do_ajax', 'nonce' );
    $res = array('mes' => 'ajax-processed');
    $_action = $_POST['_action'];


    wp_send_json( $res );
    die();
} ?>