<?php
function zing_custom_post_type() {
    $labels = array(
        'name'                  => 'Room',
        'singular_name'         => 'Room',
        'menu_name'             => 'Rooms',
        'name_admin_bar'        => 'Rooms',
        'archives'              => 'Rooms',
        'all_items'             => 'Rooms',
        'add_new_item'          => 'New Room',
        'add_new'               => 'New Room',
        'new_item'              => 'New Room',
        'edit_item'             => 'Update Room',
        'update_item'           => 'Update Room',
        'view_item'             => 'View Room',
        'search_items'          => 'Search Rooms',
        'not_found'             => 'No item found',
        'not_found_in_trash'    => 'No item found in trash'
    );
    $args = array(
        'label'                 => 'Room',
        'description'           => 'Room',
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor' ),
        'taxonomies'            => array(),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-lock',
        'show_in_admin_bar'     => false,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'rewrite' => array(
            'slug' => 'rooms'
        )
    );
    register_post_type( 'room', $args );
}
add_action('init', 'zing_custom_post_type'); ?>