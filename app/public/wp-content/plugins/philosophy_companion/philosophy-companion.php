<?php
/*
	Plugin Name: Philosophy-Companion
	Plugin URI: 
	Description: Companion plugin for the philosophy theme.
	Author: LWHH
	Author URI: 
	License: GPLv2 or later
	Text Domain: philosophy_companion
	Domain Path: 
	Version: 1.0
*/

function philosophy_companion_register_my_cpts_book() {

	/**
	 * Post Type: Books.
	 */

	$labels = array(
		"name" => __( "Books", "philosophy" ),
		"singular_name" => __( "Book", "philosophy" ),
		"all_items" => __( "My Books", "philosophy" ),
		"add_new" => __( "New Book", "philosophy" ),
		"featured_image" => __( "Book Cover", "philosophy" ),
	);

	$args = array(
		"label" => __( "Books", "philosophy" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "book", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-book",
		"supports" => array( "title", "editor", "thumbnail", "excerpt", "author" ),
		"taxonomies" => array( "category", "post_tag" ),
	);

	register_post_type( "book", $args );
}

add_action( 'init', 'philosophy_companion_register_my_cpts_book' );
