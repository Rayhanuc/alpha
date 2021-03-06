<?php

  /**
 * 
 * Plugin Name: Post And Texonomy Selector
 * Plugin URI:  
 * Description: 
 * Version:  1.0   
 * Author: Rayhan Uddin Chowdhury     
 * Author URI:  
 * License:     GPLv2 or later
 * License URI: 
 * Text Domain: post-tax-metafield
 * Domain Path: /languages/
 */


// taxtdomain
function ptmf_load_taxtdomain(){
	load_plugin_textdomain('post-tax-metafield',false,dirname(__FILE__)."/languages");
}
add_action('plugins_loaded','ptmf_load_taxtdomain');


// function created for assets file enqueue
function ptmf_init(){
	add_action('admin_enqueue_scripts','ptmf_admin_assets');
}
add_action('admin_init','ptmf_init');

// assets enqueue
function ptmf_admin_assets() {
	wp_enqueue_style('ptmf-admin-style',plugin_dir_url(__FILE__)."assets/admin/css/style.css",null,time());
	wp_enqueue_style('select2',"//cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css",null,time());
	// wp_enqueue_style('jquery-ui-css',plugin_dir_url(__FILE__)."assets/admin/css/jquery-ui.css",null,time());
	wp_enqueue_script('ptmf-admin-js',plugin_dir_url(__FILE__)."assets/admin/js/main.js",array('jquery','jquery-ui-datepicker'),time(),true);
	wp_enqueue_script('ptmf-admin-js',"//cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js",array('jquery'),time(),true);
}



function ptmf_add_metabox(){
	add_meta_box(
		'ptmf_select_posts_mb',
		__('Select Posts','post-tax-metafield'),
		'ptmf_display_metabox', /*new function will be create by this name.*/
		array('page')
	);
}
add_action('admin_menu','ptmf_add_metabox');


function ptmf_save_metabox($post_id){
	// Location start
	if (!ptmf_is_secured('ptmf_posts_nonce','ptmf_posts',$post_id)) {
		return $post_id;
	}

	$selected_post_id = $_POST['ptmf_posts'];	
	if ($selected_post_id>0) {
		update_post_meta( $post_id, 'ptmf_selected_posts', $selected_post_id );
	}

	$selected_term_id = $_POST['ptmf_term'];
	if ($selected_term_id>0) {
		update_post_meta( $post_id, 'ptmf_selected_term', $selected_term_id );
	}

	return $post_id;
}
add_action('save_post', 'ptmf_save_metabox' );


function ptmf_display_metabox($post){

	$selected_post_id = get_post_meta($post->ID,'ptmf_selected_posts',true);
	$selected_term_id = get_post_meta($post->ID,'ptmf_selected_term',true);
	// print_r($selected_post_id);
	// print_r($selected_term_id);

	wp_nonce_field('ptmf_posts','ptmf_posts_nonce');

	// post take out by this way.
	$args = array(
		'post_type' => 'post',
		'post_per_page' => -1,			
	);

	$dropdown_list = '';

	// wp query for post
	$_posts = new wp_query($args);
	while($_posts->have_posts()) {
		$extra = '';
		$_posts->the_post();
		if (in_array(get_the_ID(),$selected_post_id)) {
			$extra = 'selected';
		}
		$dropdown_list .= sprintf("<option %s value='%s'>%s</option>",$extra,get_the_ID(),get_the_title());
	}
	wp_reset_query();

	// wp query for term
	$_terms = get_terms( array(
	    // 'taxonomy' => 'category',
	    'taxonomy' => 'genre',
	    'hide_empty' => false,
	) );

	$term_dropdown_list = '';
	foreach ($_terms as $_term) {
		$extra = '';
		// $_term->term_id;
		if ($_term->term_id == $selected_term_id ) {
			$extra = 'selected';
		}
		$term_dropdown_list .= sprintf("<option %s value='%s'>%s</option>",$extra,$_term->term_id,$_term->name);

	}

	$label = __('Select Posts','post-tax-metafield');
	$label2 = __('Select Term','post-tax-metafield');
	$metabox_html = <<<EOD
<div class="fields">
	<div class="field_c">
		<div class="label_c">
			<label>{$label}</label>
		</div>
		<div class="input_c">
			<select multiple="multiple" name="ptmf_posts[]" id="ptmf_posts">
				<option value="0">{$label}</option>
				{$dropdown_list}
			</select>
		</div>
		<div class="folat_c"></div>
	</div>

	<div class="field_c">
		<div class="label_c">
			<label for="ptmf_term">{$label2}</label>
		</div>
		<div class="input_c">
			<select name="ptmf_term" id="ptmf_term">
				<option value="0">{$label2}</option>
				{$term_dropdown_list}
			</select>
		</div>
		<div class="folat_c"></div>
	</div>
</div>

EOD;
	echo $metabox_html;
}


if(!function_exists('ptmf_is_secured')) {
	function ptmf_is_secured($nonce_field,$action,$post_id){
		$nonce = isset($_POST[$nonce_field])?$_POST[$nonce_field]:'';
		
		if ($nonce == '') {
			return false;
		}

		if (!wp_verify_nonce($nonce, $action)) {
			return false;
		}

		if (!current_user_can('edit_post',$post_id)) {
			return false;
		}

		if (wp_is_post_autosave($post_id)) {
			return false;
		}

		if (wp_is_post_revision( $post_id )) {
			return false;
		}

		return true; 
	}
}