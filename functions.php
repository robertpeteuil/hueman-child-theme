<?php

// enque my stylesheet and override parent theme's enqueue of it
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css', array( 'hueman-main-style' ),
        filemtime( get_stylesheet_directory() . '/style.css' ), 'all');
    wp_deregister_style( 'theme-stylesheet' );
    wp_dequeue_style( 'theme-stylesheet' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles', 999 );

// hide dashboard view from users by default
add_action("user_register", "set_user_admin_bar_false_by_default", 10, 1);
function set_user_admin_bar_false_by_default($user_id) {
    update_user_meta( $user_id, 'show_admin_bar_front', 'false' );
    update_user_meta( $user_id, 'show_admin_bar_admin', 'false' );
}

// stop jetpack social sharing butttons from displaying inside the_content
function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
add_action( 'loop_start', 'jptweak_remove_share' );

// remove admin toolbar items via remove_node
function admintweak_remove_toolbar_node($wp_admin_bar) {
  $wp_admin_bar->remove_node('wp-logo');
  $wp_admin_bar->remove_node('new-content');
  $wp_admin_bar->remove_node('stats');
}
add_action('admin_bar_menu', 'admintweak_remove_toolbar_node', 999);

// remove admin toolbar items via remove_menu
function admintweak_remove_toolbar_menu() {
	global $wp_admin_bar;
  $wp_admin_bar->remove_menu('wpseo-menu');
  $wp_admin_bar->remove_menu('ybi_plugin_shortcut');
	$wp_admin_bar->remove_menu('wpaas');
}
add_action('wp_before_admin_bar_render', 'admintweak_remove_toolbar_menu', 999);

// add LinkedIn field to user metadata
function add_to_author_profile( $contactmethods ) {
  $contactmethods['linkedin'] = 'LinkedIn profile URL';
  return $contactmethods;
}
add_filter( 'user_contactmethods', 'add_to_author_profile', 10, 1);
