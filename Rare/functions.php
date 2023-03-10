<?php
global $wpdb;
define("CSS", get_template_directory_uri().'/css');
define("JS", get_template_directory_uri().'/js');
define("IMG", get_template_directory_uri().'/images');
define("LAZY_IMG", "data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs=");

global $cu; $cu = false;
if( is_user_logged_in() ) $cu = wp_get_current_user();

// 1. customize ACF path
add_filter('acf/settings/path', 'my_acf_settings_path');
function my_acf_settings_path( $path ) {
    $path = get_template_directory() . '/acf/';
    return $path;
}

// 2. customize ACF dir
add_filter('acf/settings/dir', 'my_acf_settings_dir');
function my_acf_settings_dir( $dir ) {
    $dir = get_template_directory_uri() . '/acf/';
    return $dir;
}

// 3. Hide ACF field group menu item
add_filter('acf/settings/show_admin', '__return_true');
// 4. Include ACF
include_once( get_template_directory() . '/acf/acf.php' );
include_once( get_template_directory() . '/acf/options.php' );

function z_include( $folder ){ foreach (glob("{$folder}/*.php") as $filename){ include $filename; } } z_include( dirname(__FILE__).'/z_inc' ); ?>