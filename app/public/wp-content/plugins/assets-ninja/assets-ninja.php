<?php
/* 
Plugin Name: AssetsNinja
Plugin URI: http://rayhanuddin.ml/
Description: Assets Management In Depth
Version: 1.0
Author: Rayhan Uddin Chowdhury
Author URI: http://rayhanuddin.ml/
License: GPLv2 or later
Text Domain: assetsninja
Domain Path: /languages/
 */


Class AssetsNinja{
	function __construct() {

		add_action( 'plugins_loaded', array($this,'load_textdomain') );
		add_action('wp_enqueue_scripts',array($this,'load_front_assets'));
	}

	// Front page asset will load here / For visitor assets
	function load_textdomain() {
		load_plugin_textdomain( 'assetsninja', false, plugin_dir_url( __FILE__ )."/languages" );
	}

	function load_front_assets(){

	}
}

new AssetsNinja();