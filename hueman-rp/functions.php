<?php

/* enque my stylesheet and override parent theme's enque of it */
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css', array( 'hueman-main-style' ),
        filemtime( get_stylesheet_directory() . '/style.css' ), 'all');
    wp_deregister_style( 'theme-stylesheet' );
    wp_dequeue_style( 'theme-stylesheet' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles', 999 );

/* Whide Dashboard View from all users by default */
add_action("user_register", "set_user_admin_bar_false_by_default", 10, 1);
function set_user_admin_bar_false_by_default($user_id) {
    update_user_meta( $user_id, 'show_admin_bar_front', 'false' );
    update_user_meta( $user_id, 'show_admin_bar_admin', 'false' );
}

// Stop jetpack from placing social sharing butttons inside content
function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
add_action( 'loop_start', 'jptweak_remove_share' );

// remove admin toolbar items
function RP_remove_toolbar_node($wp_admin_bar) {
  $wp_admin_bar->remove_node('wp-logo');              // WordPress Logo
  $wp_admin_bar->remove_node('new-content');          // Add new content
  $wp_admin_bar->remove_node('stats');                // Svr Load Bargraph
}
add_action('admin_bar_menu', 'RP_remove_toolbar_node', 999);

// remove admin toolbar items - part 2 - alt technique
function RP_remove_toolbar_menu() {
	global $wp_admin_bar;
  $wp_admin_bar->remove_menu('wpseo-menu');           // Yoast SEO
  $wp_admin_bar->remove_menu('ybi_plugin_shortcut');  // Upload Plugin
	$wp_admin_bar->remove_menu('wpaas');                // GoDaddy Logo
}
add_action('wp_before_admin_bar_render', 'RP_remove_toolbar_menu', 999);

/* Add linkedin field to user metadata */
function add_to_author_profile( $contactmethods ) {
  $contactmethods['linkedin'] = 'LinkedIn profile URL';
  return $contactmethods;
}
add_filter( 'user_contactmethods', 'add_to_author_profile', 10, 1);
