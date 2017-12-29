<?php

add_action( 'init', 'ifba_subscribe_form_function' ); add_action('admin_menu', 'ifba_custom_menu_pages');

function ifba_subscribe_form_function() { $labels = array( 'name' => _x( 'Instagram Feeds', 'post type general name' ), 'singular_name' => _x( 'Instagram Feed', 'post type singular name' ), 'menu_name' => _x( 'Instagram Feed', 'admin menu' ), 'name_admin_bar' => _x( 'Instagram Feed', 'add new on admin bar' ), 'add_new' => _x( 'Add New', 'Form' ), 'add_new_item' => __( 'Add New Instagram Feed' ), 'new_item' => __( 'New Instagram Feed' ), 'edit_item' => __( 'Edit Instagram Feed' ), 'view_item' => __( 'View Instagram Feed' ), 'all_items' => __( 'All Instagram Feeds' ), 'search_items' => __( 'Search Instagram Feeds' ), 'parent_item_colon' => __( 'Parent Instagram Feeds:' ), 'not_found' => __( 'No Feed Forms found.' ), 'not_found_in_trash' => __( 'No Feed Forms found in Trash.' ) );

 $args = array( 'labels' => $labels, 'description' => __( 'Add responsive instagram feed into your post, page & widgets' ), 'public' => true, 'publicly_queryable' => false, 'show_ui' => true, 'show_in_menu' => true, 'rewrite' => array( 'slug' => 'arrow_instagram_feed' ), 'capability_type' => 'post', 'has_archive' => false, 'hierarchical' => false, 'menu_position' => 25, 'menu_icon' => 'dashicons-schedule', 'supports' => array( 'title' , 'custom_fields') );

 register_post_type( 'ifba_instagram_feed', $args ); }

function ifba_custom_menu_pages() {

add_submenu_page( 'edit.php?post_type=ifba_instagram_feed', 'Support', 'Support', 'manage_options', 'ifba_form_support', 'ifba_support_page' );

} 

function ifba_support_page(){ include_once( 'ifba-support-page.php' ); }

function ifba_after_title() {

 $scr = get_current_screen(); if( $scr-> post_type !== 'ifba_instagram_feed' ) return;

 include_once( 'ifba-settings-page.php' ); }

add_action( 'edit_form_after_title', 'ifba_after_title' ); 

add_action('load-post-new.php', 'ifbp_limit_cpt' );

function ifbp_limit_cpt() { global $typenow;

if( 'ifba_instagram_feed' !== $typenow ) return;

$total = get_posts( array( 'post_type' => 'ifba_instagram_feed', 'numberposts' => -1, 'post_status' => 'publish,future,draft' ));

if( $total && count( $total ) >= 2 ) wp_die( '<p style="text-align:center;font-weight:bold;">Sorry, Creation of maximum number of Feeds reached, Please <a href="https://www.arrowplugins.com/instagram-feed">Buy Premium Version</a> to create more amazing Feeds With Awesome Features</p>', 'Maximum reached', array( 'response' => 500, 'back_link' => true ) ); }