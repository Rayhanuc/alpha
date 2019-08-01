<?php
/*
Plugin Name: Posts To QR Code
Plugin URI: http://rayhanuddin.ml/
Description: Display QR Code Under Every Posts
Version: 1.0
Author: Rayhan Uddin Chowdhury
Author URI: http://rayhanuddin.ml/
License: GPLv2 or later
Text Domain: posts-to-qrcode
Domain Path: /languages/
 */

/* function wordcount_activation_hook() {
}
register_activation_hook(__FILE__, "wordcount_activation_hook");

function wordcount_deactivation_hook(){
}
register_deactivation_hook(__FILE__, "wordcount_deactivation_hook"); */

function posts_to_qucode_load_textdomain() {
	load_plugin_textdomain("posts-to-qrcode", false, dirname(__FILE__), "/languages/");
}
add_action("plugins_loaded", "posts_to_qucode_load_textdomain");

function pqrc_display_qr_code($content) {
	$current_post_id = get_the_ID();
	$current_post_title = get_the_title($current_post_id);
	$current_post_url = urlencode(get_the_permalink($current_post_id));
	$current_post_type = get_post_type($current_post_id);

	// Post Type Check
	$excluded_post_types = apply_filters('pqrc_excluded_post_types', array());
	if (in_array($current_post_type, $excluded_post_types)) {
		return $content;
	}

	$height = get_option('pqrc_height');
	$width = get_option('pqrc_width');
	$height = $height ? $height : 180;
	$width = $width ? $width : 180;
	// Dimension Hook
	$dimension = apply_filters('pqrc_qrcode_dimension', "{$width}x{$height}");

	// Image Attributes
	$image_attributes = apply_filters('pqrc_image_attributes', ''); //or null

	$image_src = sprintf('https://api.qrserver.com/v1/create-qr-code/?size=%s&data=%s', $dimension, $current_post_url);
	$content .= sprintf("<div class='qrcode'><img %s src='%s' alt='%s'></div>", $image_attributes, $image_src, $current_post_title);
	return $content;
}
add_filter('the_content', 'pqrc_display_qr_code');

// Setting for this plugin include in admin pannel
function pqrc_settings_init() {

	// add_settings_section( $id, $title, $callback, $page );
	add_settings_section('pqrc_section', __('Posts to QR Code', 'posts-to-qrcode'), 'pqrc_section_callback', 'general');

	// add_settings_field( $id, $title, $callback, $page, $section = 'default', $args = array )
	add_settings_field('pqrc_height', __('QR Code Height', 'posts-to-qrcode'), 'qprc_diplay_height', 'general', 'pqrc_section');
	add_settings_field('pqrc_width', __('QR Code Width', 'posts-to-qrcode'), 'qprc_diplay_width', 'general', 'pqrc_section');

	// register_setting( $option_group, $option_name, $args = array );
	register_setting('general', 'pqrc_height', array('sanitize_callback' => 'esc_attr'));
	register_setting('general', 'pqrc_width', array('sanitize_callback' => 'esc_attr'));
}

function pqrc_section_callback() {
	echo "<p>" . __('Settings for Posts To QR Plugin', 'posts-to-qrcode') . "</p>";
}

function qprc_diplay_height() {
	$height = get_option('pqrc_height');
	printf("<input type='text' id='%s' name='%s' value='%s'/>", 'pqrc_height', 'pqrc_height', $height);
}

function qprc_diplay_width() {
	$width = get_option('pqrc_width');
	printf("<input type='text' id='%s' name='%s' value='%s'/>", 'pqrc_width', 'pqrc_width', $width);
}

add_action("admin_init", "pqrc_settings_init");
