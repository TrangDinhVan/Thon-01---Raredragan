<?php
/* Template name: Dev */
get_header();

$ps = get_posts(array(
    'post_type' => 'inavii_account',
    'post_status' => 'any',
    'showposts' => 2
));

$p = $ps[0];
fw_print( get_field( 'inavii_social_feed_media', $p ) );

get_footer(); ?>