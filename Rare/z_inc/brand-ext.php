<?php
function zing_custom_login() {
  echo '<link rel="stylesheet" type="text/css" href="' . CSS . '/custom-login.css" />';
}
add_action('login_head', 'zing_custom_login');

function zing_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'zing_login_logo_url' );

// Update Admin Footer
function zing_footer_admin() {
    echo 'Theme by <a href="mailto:trangdv@outlook.com">Trangdv</a>';
}
add_filter( 'admin_footer_text', 'zing_footer_admin' ); ?>