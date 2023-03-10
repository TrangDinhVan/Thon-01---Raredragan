<?php
add_shortcode( 'foo', 'thon_foo' );
function thon_foo(){
    ob_start();
    echo get_field( 'home_desc', 'option' );
    return ob_get_clean();
} ?>