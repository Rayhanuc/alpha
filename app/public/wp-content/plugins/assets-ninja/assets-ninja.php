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

		// Enqueue file deregister way / function created
		add_action('init',array($this,'asn_init'));

		add_action( 'plugins_loaded', array($this,'load_textdomain') );
		add_action('wp_enqueue_scripts',array($this,'load_front_assets'));
		add_action('admin_enqueue_scripts', array($this,'load_admin_assets'));
		add_shortcode('bgmedia',array($this,'asn_bgmedia_shortcode'));
	}

	function asn_bgmedia_shortcode($attributes){
		
		$shortcode_outrput = <<<EOD

<div id="bgmedia"></div>
EOD;

		return $shortcode_outrput;
	}

	// Enqueue file deregister way
	function asn_init(){
		wp_deregister_style( 'fontawesome' );
		wp_register_style( 'fontawesome','//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' );

		/*wp_deregister_script('tinyslider-js');
		wp_register_script('tinyslider-js','//cdn.jsdelivr.net/npm/tiny-slider@2.9.2/dist/tiny-slider.min.js',null,'1.0',true); */
	}

	// Load admin assets
	function load_admin_assets($screen){
		$_screen = get_current_screen();
		/*if ('edit.php' == $screen && ('page' == $_screen->post_type || 'book' == $_screen->post_type)) {
			wp_enqueue_script('ans-admin-js',ASN_ASSETS_ADMIN_DIR."/js/admin.js",array('jquery'),$this->version,true);
		}*/

		if ('edit-tags.php' == $screen && 'category' == $_screen->taxonomy) {
			wp_enqueue_script('ans-admin-js',ASN_ASSETS_ADMIN_DIR."/js/admin.js",array('jquery'),$this->version,true);
		}
	}

	// Front page asset will load here / For visitor assets
	function load_textdomain() {
		load_plugin_textdomain( 'assetsninja', false, plugin_dir_url( __FILE__ )."/languages" );
	}

	function load_front_assets(){
		// wp_enqueue_style( 'asn-main-css',ASN_ASSETS_PUBLIC_DIR."/css/main.css",array('fontawesome'),$this->version );
		wp_enqueue_style( 'asn-main-css',ASN_ASSETS_PUBLIC_DIR."/css/main.css",$this->version );

		/*inline css system start
		====================
		*/
		$attachment_image_src = wp_get_attachment_image_src(473,'medium');
		$data = <<<EOD
		#bgmedia {
			background-image:url($attachment_image_src[0])
		}
EOD;

		wp_add_inline_style('asn-main-css',$data);
		/*inline css system end
		====================
		*/



		/* OLD STYLE ENQUEUE JS
		wp_enqueue_script('asn-main-js',ASN_ASSETS_PUBLIC_DIR."/js/main.js",array(
			'jquery',
			'asn-another-js'
		),$this->version,true);

		wp_enqueue_script('asn-another-js',ASN_ASSETS_PUBLIC_DIR."/js/another.js",array('jquery','asn-more-js'),$this->version,true);
		wp_enqueue_script('asn-more-js',ASN_ASSETS_PUBLIC_DIR."/js/more.js",array('jquery'),$this->version,true);*/

		// NEW STYLE ENQUEUE
		$js_files = array(
			// STYLE ONE
			'asn-main-js' => array('path' => ASN_ASSETS_PUBLIC_DIR."/js/main.js",'dep'  => array('jquery','asn-another-js')),
			// STYLE TWO
			'asn-another-js' => array(
					'path' => ASN_ASSETS_PUBLIC_DIR."/js/another.js",
					'dep'  => array(
						'jquery',
						'asn-more-js'
					)
				),
			'asn-more-js' => array('path' => ASN_ASSETS_PUBLIC_DIR."/js/more.js",'dep'  => array('jquery')),
		);

		foreach ($js_files as $handle => $file_info) {
			wp_enqueue_script($handle,$file_info['path'],$file_info['dep'],$this->version,true);
		}


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


		$data = <<<EOD
		alert('Hello From Inline Script.');
EOD;
		wp_add_inline_script( 'asn-more-js', $data, $position = 'after' );

	}

	
}

new AssetsNinja();