<?php
require_once locate_template('/lib/custom.php');
require_once locate_template('/lib/wrapper.php');
require_once locate_template('/inc/news.php');

// Remove default post type
add_action('admin_menu', 'remove_admin_items');

function remove_admin_items() {
    // Posts
    remove_menu_page('edit.php');
    // Comments
    remove_menu_page('edit-comments.php');
}