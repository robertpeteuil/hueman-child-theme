<?php
/* Write your awesome functions below */
add_action("user_register", "set_user_admin_bar_false_by_default", 10, 1);
function set_user_admin_bar_false_by_default($user_id) {
    update_user_meta( $user_id, 'show_admin_bar_front', 'false' );
    update_user_meta( $user_id, 'show_admin_bar_admin', 'false' );
}

// Stop jetpack from including its sharing butttons in the_content() function
function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
add_action( 'loop_start', 'jptweak_remove_share' );

// remove admin toolbar items
// https://digwp.com/2016/06/remove-toolbar-items/
function shapeSpace_remove_toolbar_node($wp_admin_bar) {
  $wp_admin_bar->remove_node('wp-logo');
	$wp_admin_bar->remove_node('comments');
  $wp_admin_bar->remove_node('new-content');
}
add_action('admin_bar_menu', 'shapeSpace_remove_toolbar_node', 999);

// remove admin toolbar items (alt technique)
function shapeSpace_remove_toolbar_menu() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('ybi_plugin_shortcut');
	$wp_admin_bar->remove_menu('wpaas');
}
add_action('wp_before_admin_bar_render', 'shapeSpace_remove_toolbar_menu', 999);

// COMMENTED OUT (TURNED OFF)
//      Turning off was necessary to re-enable user self editing bio
//      this was necessary to adhere to privacy policy
//
// The adjustment to allow HTML is user bios is documented here
// http://wordpress.stackexchange.com/questions/21326/how-can-html-be-allowed-in-author-bio
// https://premium.wpmudev.org/blog/enable-or-disable-all-html-tags-in-wordpress-author-biography-profiles/
//
// remove the standard filter which strips most HTML from bios
// remove_filter('pre_user_description', 'wp_filter_kses');
//add sanitization for WordPress posts
// add_filter( 'pre_user_description', 'wp_filter_post_kses');
