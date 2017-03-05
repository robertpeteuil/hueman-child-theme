<?php

/* enque parent stylesheet into shild-theme */
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    $parent_style = 'parent-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/assets/front/css/main.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        // array( $parent_style ),
        array(),
        // wp_get_theme()->get('Version')
        rand(111,9999), 'all'
    );
}
// wp_register_style( 'custom-style', get_template_directory_uri() . '/css/custom-style.css', array(), rand(111,9999), 'all' );

/* WHide Dashboard View from all users by default */
add_action("user_register", "set_user_admin_bar_false_by_default", 10, 1);
function set_user_admin_bar_false_by_default($user_id) {
    update_user_meta( $user_id, 'show_admin_bar_front', 'false' );
    update_user_meta( $user_id, 'show_admin_bar_admin', 'false' );
}

// Stop jetpack from placing social sharing butttons inside content
//    It does this by default by adding these from inside the_content() function
// This function stops it from automatically displaying them
//    Then you need to put function on page where you want them displayed.
//    described here:  https://jetpack.com/2013/06/10/moving-sharing-icons/
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
  $wp_admin_bar->remove_node('wp-logo');              // WordPress Logo
  $wp_admin_bar->remove_node('new-content');          // Icon to add new site content
}
add_action('admin_bar_menu', 'shapeSpace_remove_toolbar_node', 999);

// remove admin toolbar items - part 2 - alt technique
function shapeSpace_remove_toolbar_menu() {
	global $wp_admin_bar;
  $wp_admin_bar->remove_menu('wpseo-menu');           // Yoast SEO Menu Item
  $wp_admin_bar->remove_menu('ybi_plugin_shortcut');  // Upload Plugin item f curation suite
	$wp_admin_bar->remove_menu('wpaas');                // GoDaddy Branding Logo
}
add_action('wp_before_admin_bar_render', 'shapeSpace_remove_toolbar_menu', 999);

/* Add linkedin field to user metadata */
function add_to_author_profile( $contactmethods ) {
  $contactmethods['linkedin'] = 'LinkedIn profile URL';
  return $contactmethods;
}
add_filter( 'user_contactmethods', 'add_to_author_profile', 10, 1);
