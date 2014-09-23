<?php
require_once locate_template('/lib/init.php');
require_once locate_template('/lib/custom.php');
require_once locate_template('/lib/wrapper.php');
require_once locate_template('/inc/news.php');
require_once locate_template('/lib/nav.php');

// CSS and JS
function pandg_scripts() {
    wp_enqueue_style('pandg_main', get_template_directory_uri() . '/assets/css/main.min.css', false, '64c2848549e90cef42796141ccce4c3e');
    wp_register_script('pandg_scripts', get_template_directory_uri() . '/assets/js/scripts.min.js', array(), '0fc6af96786d8f267c8686338a34cd38', true);
    wp_enqueue_script('pandg_scripts');
}
add_action('wp_enqueue_scripts', 'pandg_scripts', 100);

// Remove default post type
add_action('admin_menu', 'remove_admin_items');

function remove_admin_items() {
    // Posts
    remove_menu_page('edit.php');
    // Comments
    remove_menu_page('edit-comments.php');
}