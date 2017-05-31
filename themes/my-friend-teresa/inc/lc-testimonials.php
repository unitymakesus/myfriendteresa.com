<?php
// Register Custom Post Type
function testimonials_custom_post_type() {

    $labels = array(
        'name'                => _x( 'Testimonials', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'Testimonials', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Testimonials', 'text_domain' ),
        'name_admin_bar'      => __( 'Testimonial', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent Testimonial:', 'text_domain' ),
        'all_items'           => __( 'All Testimonials', 'text_domain' ),
        'add_new_item'        => __( 'Add New Testimonials', 'text_domain' ),
        'add_new'             => __( 'Add New', 'text_domain' ),
        'new_item'            => __( 'New Testimonials', 'text_domain' ),
        'edit_item'           => __( 'Edit Testimonials', 'text_domain' ),
        'update_item'         => __( 'Update Testimonials', 'text_domain' ),
        'view_item'           => __( 'View Testimonials', 'text_domain' ),
        'search_items'        => __( 'Search Testimonials', 'text_domain' ),
        'not_found'           => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
    );
    $args = array(
        'label'               => __( 'testimonials', 'text_domain' ),
        'description'         => __( 'Testimonials Description', 'text_domain' ),
        'labels'              => $labels,
        'supports'            => array( ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'testimonials', $args );

}

// Hook into the 'init' action
add_action( 'init', 'testimonials_custom_post_type', 0 );