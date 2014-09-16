<?php
/**
 * news functions and definitions
 *
 */

/*-----------------------------------------------------------------------------------*/
/*	Register news post format.
/*-----------------------------------------------------------------------------------*/
add_action( 'init', 'news_posttype_init' );
if ( !function_exists( 'news_posttype_init' ) ) :
function news_posttype_init() {

    global $custom_menu_position;

	$news_labels = array(
		'name' => _x('News', 'post type general name'),
		'singular_name' => _x('News Article', 'post type singular name'),
		'menu_name' => __('News Articles')

	);
	$news_args = array(
		'labels' => $news_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => $custom_menu_position,
		'supports' => array( 'title', 'excerpt', 'thumbnail', 'editor')
	); 
	register_post_type( 'news', $news_args );

}
endif;