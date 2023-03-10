<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

function zing_setup() {
    load_theme_textdomain( 'zing', get_template_directory() . '/languages' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( get_option( 'thumbnail_size_w' ), get_option( 'thumbnail_size_h' ), true );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
    add_image_size('zmedium', get_option( 'medium_size_w' ), get_option( 'medium_size_h' ), true );
    add_image_size('zlarge', get_option( 'large_size_w' ), get_option( 'large_size_h' ), true );
    register_nav_menus(array(
        'primary' => __('Primary', 'zing')
    ));
}
add_action( 'after_setup_theme', 'zing_setup' );

add_filter('big_image_size_threshold', '__return_false');

function zing_custom_img_sizes($sizes) {
    unset($sizes['medium']);
    unset($sizes['large']);
    unset($sizes['medium_large']); // disable 768px size images
	unset($sizes['1536x1536']); // disable 2x medium-large size
	unset($sizes['2048x2048']); // disable 2x large size
	return $sizes;

}
add_filter('intermediate_image_sizes_advanced', 'zing_custom_img_sizes');

function mycustom_embed_defaults($embed_size){
    $embed_size['width'] = 840;
    $embed_size['height'] = 475;
    return $embed_size;
}
add_filter('embed_defaults', 'mycustom_embed_defaults');

// show_admin_bar( false );