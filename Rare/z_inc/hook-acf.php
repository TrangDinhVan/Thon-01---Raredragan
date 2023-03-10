<?php
/* Thêm trang Settings > Other Settings  trong Admin */
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' => 'Site Data',
        // 'page_title' => 'Other Settings',
        'menu_slug' => 'other_settings',
        'position' => 21,
        // 'icon_url' => 'store'
        // 'parent_slug' => 'options-general.php'
    ));
} ?>