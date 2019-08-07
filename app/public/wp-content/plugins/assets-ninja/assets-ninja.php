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

// নির্দিষ্ট একটা অংশ একই রকম থাকলে এগুলিকে ডিফাইন করে নিলে বার বার লিখতে হয় না।
define("ASN_ASSETS_DIR",plugin_dir_url(__FILE__)."assets/");
define("ASN_ASSETS_PUBLIC_DIR",plugin_dir_url(__FILE__)."assets/public");
define("ASN_ASSETS_ADMIN_DIR",plugin_dir_url(__FILE__)."assets/admin");
define("ASN_VERSION", time());


Class AssetsNinja{

	private $version;

	function __construct() {

		$this->version = time();

		add_action( 'plugins_loaded', array($this,'load_textdomain') );
		add_action('wp_enqueue_scripts',array($this,'load_front_assets'));
	}

	// Front page asset will load here / For visitor assets
	function load_textdomain() {
		load_plugin_textdomain( 'assetsninja', false, plugin_dir_url( __FILE__ )."/languages" );
	}

	function load_front_assets(){
		wp_enqueue_style( 'asn-main-css',ASN_ASSETS_PUBLIC_DIR."/css/main.css",null,$this->version );



		wp_enqueue_script('asn-main-js',ASN_ASSETS_PUBLIC_DIR."/js/main.js",array(
			'jquery',
			'asn-another-js'
		),$this->version,true);

		wp_enqueue_script('asn-another-js',ASN_ASSETS_PUBLIC_DIR."/js/another.js",array('jquery','asn-more-js'),$this->version,true);
		wp_enqueue_script('asn-more-js',ASN_ASSETS_PUBLIC_DIR."/js/more.js",array('jquery'),$this->version,true);

		$data = array(
			'name'=>'rayhanuddinchy',
			'url' => 'http://rayhanuddin.ml/'
		);

		$moredata = array(
			'name'=>'learnwithrayhan',
			'url' => 'http://bangladesh.ml/'
		);

		$translated_string = array(
			'greetings' => __('অবাক পৃথিবীর মানুষ গুলি','assetsninja')
		);

		wp_localize_script( 'asn-more-js', 'sitedata', $data );
		wp_localize_script( 'asn-more-js', 'moredata', $moredata );
		wp_localize_script( 'asn-more-js', 'translations', $translated_string );

	}
}

new AssetsNinja();