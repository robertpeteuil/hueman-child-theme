<?php
/* Write your awesome functions below */
add_action("user_register", "set_user_admin_bar_false_by_default", 10, 1);
function set_user_admin_bar_false_by_default($user_id) {
    update_user_meta( $user_id, 'show_admin_bar_front', 'false' );
    update_user_meta( $user_id, 'show_admin_bar_admin', 'false' );
}
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
