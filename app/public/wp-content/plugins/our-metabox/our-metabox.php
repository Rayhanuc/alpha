<?php

/**
 * Plugin Name: Our Metabox
 * Description: Metabox API Demo
 * Plugin URI: 
 * Author: Rayhan Uddin Chowdhury
 * Author URI: 
 * Version: 1.0.0
 * License: GPL2
 * Text Domain: our-metabox
 * Domain Path: domain/path
 */


// omb === Our Metabox
class OurMetabox{
	public function __construct() {
		add_action('plugins_loaded',array($this,'omb_load_textdomain'));

		add_action('admin_menu', array($this,'omb_add_metabox'));
		add_action('save_post',array($this,'omb_save_location'));
	}

	function omb_save_location($post_id){
		$location = isset($_POST['omb_location'])?$_POST['omb_location']:'';
		if ($location == '') {
			return $post_id;
		}

		update_post_meta($post_id,'omb_location',$location);
	}

	function omb_add_metabox() {
		add_meta_box(
			'omb_post_location',
			__('Location Info','our-metabox'),
			array($this,'omb_display_post_location'),
			'post'


		);
	}

	function omb_display_post_location($post) {
		$location = get_post_meta($post->ID,'omb_location',true);
		$label = __('Location','our-metabox');
		$metabox_html = <<<EOD
<p></p>
<label for="omb_location">{$label}: </label>
<input type="text" name="omb_location" id="omb_location" value="{$location}"/>
EOD;

		echo $metabox_html;
	}

	public function omb_load_textdomain(){
		load_plugin_textdomain( 'our-metabox', false, dirname(__FILE__)."/languages" );
	}
}


new OurMetabox();