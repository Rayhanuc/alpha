<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.




define( 'CS_ACTIVE_FRAMEWORK',   true  ); // default true
define( 'CS_ACTIVE_METABOX',     true ); // default true
define( 'CS_ACTIVE_TAXONOMY',    true ); // default true
define( 'CS_ACTIVE_SHORTCODE',   true ); // default true
define( 'CS_ACTIVE_CUSTOMIZE',   false ); // default true


// Shortcode by codestar file include
require_once get_theme_file_path( "/inc/codestar/cs-shortcode.php" );
require_once get_theme_file_path( "/inc/codestar/cs-taxnomoy.php" );

function philosophy_csf_metabox(){
	// CSFramework::instance(array());
	CSFramework_Metabox::instance(array());
	CSFramework_Taxonomy::instance(array());
	
	CSFramework_Shortcode_Manager::instance(array());
}
add_action('init', 'philosophy_csf_metabox');




function philosophy_page_metabox($options) {


	$page_id = 0;
	if (isset($_REQUEST['post']) || isset($_REQUEST['post_ID'])) {
		$page_id = empty($_REQUEST['post_ID']) ? $_REQUEST['post'] : $_REQUEST['post_ID'];
	}

	$current_page_template = get_post_meta($page_id,'_wp_page_template',true);
	echo $current_page_template;
	/*if ('about.php'!= $current_page_template) {
		return $options;
	}*/

	if (!in_array($current_page_template,array('about.php','contact.php'))) {
		return $options;
	}

	$options[] = array(
		'id' => 'page-metabox',
		'title' => __('Page Meta Info', 'philosophy'),
		'post_type' => 'page',
		'context' => 'normal',
		'priority' => 'default',
		'sections' => array(
			array(
				'name' => 'page-section1',
				'title' => __('Page Settings','philosophy'),
				'icon' => 'fa fa-image',
				'fields' => array(
					array(
						'id' => 'page-heading',
						'type' => 'text',
						'title' => __('Page Heading', 'philosophy'),
						'default' => __( 'Page Heading', 'philosophy' ),					
					),
					array(
						'id' => 'page-teaser',
						'type' => 'textarea',
						'title' => __( 'Teaser Text', 'philosophy' ),					
						'default' => __( 'Teaser Text', 'philosophy' ),					
					),
					array(
						'id'    => 'is-favorit',
						'type'  => 'switcher',
						'title' => __('Is Favorit?','philosophy'),
						'default' => 1,
					),
					// second method of dependency
					array(
						'id'    => 'is-favorit-extra',
						'type'  => 'switcher',
						'title' => __('Extra check', 'philosophy'),
						'default' => 0,
						'dependency' => array('is-favorit','==','1')
					),
					array(
						'id' => 'is-favorit-extra',
						'type' => 'text',
						'title' => __('Favorit Text', 'philosophy'),
						'dependency' => array('is-favorit-extra','==','1'),
					),

					/*array(
						'id' => 'page-favorit-text',
						'type' => 'text',
						'title' => __('Favorit Text', 'philosophy'),
						'dependency' => array('is-favorit|is-favorit-extra','==|==','1|1'),
					),*/

					array(
						'id' => 'support-language',
						'type' => 'checkbox',
						'title' => __('Languages', 'philosophy'),
						'options'    => array(
						    'bangla'   	=> 'Bangla',
						    'english'	=> 'English',
						    'french'    => 'French'
						),
						/*'attributes' => array(
							'data-depend-id' => 'support-language'
						)*/
					),
					array(
						'id' => 'extra-language-data',
						'type' => 'text',
						'title' => __('Extra Language Data', 'philosophy'),
						'dependency' => array('support-language','any','bangla,english'),
					),
				)
			),


			array(
				'name' => 'page-section2',
				'title' => __('Extra Settings','philosophy'),
				'icon' => 'fa fa-book',
				'fields' => array(
					array(
						'id' => 'page-heading2',
						'type' => 'text',
						'title' => __('Page Heading 2', 'philosophy'),
						'default' => __( 'Page Heading 2', 'philosophy' ),					
					),
					array(
						'id' => 'page-teaser2',
						'type' => 'textarea',
						'title' => __( 'Teaser Tex 2t', 'philosophy' ),					
						'default' => __( 'Teaser Text 2', 'philosophy' ),					
					),
					array(
						'id'    => 'is-favorit2',
						'type'  => 'switcher',
						'title' => 'Is Favorit 2',
						'default' => 1,
					),
				)
			)
		),

	);


	return $options;
}
add_filter( 'cs_metabox_options', 'philosophy_page_metabox' );


function philosophy_upload_metabox() {

	$options[] = array(
		'id' => 'page-upload-metabox',
		'title' => __('Upload Files', 'philosophy'),
		'post_type' => 'page',
		'context' => 'normal',
		'priority' => 'default',
		'sections' => array(
			array(
				'name' => 'page-section1',
				// 'title' => __('Upload Files','philosophy'),
				'icon' => 'fa fa-image',
				'fields' => array(
					array(
						'id' => 'page-upload',
						'type' => 'upload',
						'title' => __('Upload PDF', 'philosophy'),
						'settings'      => array(
							'upload_type'  => 'application/pdf',
							'button_title' => __('Upload File','philosophy'),
							'frame_title'  => __('Select an PDF','philosophy'),
							'insert_title' => __('Use this PDF','philosophy'),
						),					
					),
					array(
						'id' => 'page-image',
						'type' => 'image',
						'title' => __('Upload Image', 'philosophy'),
						'add_title' => __('Add an Image', 'philosophy'),
					),
					array(
						'id'          => 'page-gallery',
						'type'        => 'gallery',
						'title'       => __('Upload Image', 'philosophy'),
						'add_title'   => __('Add Images', 'philosophy'),
						'edit_title'  => __('Edit Gallery', 'philosophy'),
						'clear_title' => __('Remove Gallery', 'philosophy'),
					),

					// Fieldset
					array(
						'id'        => 'fieldset_1',
						'type'      => 'fieldset',
						'title'     => 'Fieldset Field',
						'fields'    => array(

							array(
								'id'    => 'fieldset_1_text',
								'type'  => 'text',
								'title' => 'Text Field',
							),

							array(
								'id'    => 'fieldset_1_textarea',
								'type'  => 'textarea',
								'title' => 'Textarea Field',
							),

						),
					),


					// Group field
					array(
						'id'              => 'unique_option_901',
						'type'            => 'group',
						'title'           => 'Group Field',
						'button_title'    => 'Add New',
						'accordion_title' => 'Add New Field',
						'fields'          => array(
							array(
								'id'    	=> 'featured_posts',
								'type'  	=> 'select',
								'title' 	=> __('Select a book','philosophy'),
								'options'   => 'posts',
								'query_args' => array(
									'post_type' => 'book',
									'post_per_page' => -1,
									'orderby' => 'post_date',
									'order' => 'DESC'
								)
							),
						),
					),
				)
			)
		),

	);
	return $options;
}
add_filter( 'cs_metabox_options', 'philosophy_upload_metabox' );


function philosophy_custom_post_types($options){

	$page_id = 0;
	if (isset($_REQUEST['post']) || isset($_REQUEST['post_ID'])) {
		$page_id = empty($_REQUEST['post_ID']) ? $_REQUEST['post'] : $_REQUEST['post_ID'];
	}

	$options[] = array(
		'id' => 'page-custom-post-type',
		'title' => __('Select Post Type', 'philosophy'),
		'post_type' => 'page',
		'context' => 'normal',
		'priority' => 'default',
		'sections' => array(
			array(
				'name' => 'page-section1',
				// 'title' => __('Post Type','philosophy'),
				'icon' => 'fa fa-star',
				'fields' => array(
					array(
						'id'    	=> 'cpt_type',
						'type'  	=> 'select',
						'title' 	=> __('Select a custom post type','philosophy'),
						'options'   => array(
							'none' => 'None',
							'book' => 'Book',
							'chapter' => 'Chapter',

						)
					),
				)
			)
		),

	);

	$page_meta_info = get_post_meta($page_id, 'page-custom-post-type',true);



	if (isset($page_meta_info['cpt_type']) && $page_meta_info['cpt_type']=='book') {

		$options[] = array(
			'id' => 'page-custom-post-type-book',
			'title' => __('Options For Book', 'philosophy'),
			'post_type' => 'page',
			'context' => 'normal',
			'priority' => 'default',
			'sections' => array(
				array(
					'name' => 'page-section1',
					// 'title' => __('Post Type','philosophy'),
					'icon' => 'fa fa-star',
					'fields' => array(
						array(
							'id'    	=> 'option_book_text',
							'type'  	=> 'text',
							'title' 	=> __('Some Book Info','philosophy'),
						),
					)
				)
			),
		);

	}


	if (isset($page_meta_info['cpt_type']) && $page_meta_info['cpt_type']=='chapter') {

		$options[] = array(
			'id' => 'page-custom-post-type-chapter',
			'title' => __('Options For Chapter', 'philosophy'),
			'post_type' => 'page',
			'context' => 'normal',
			'priority' => 'default',
			'sections' => array(
				array(
					'name' => 'page-section1',
					// 'title' => __('Post Type','philosophy'),
					'icon' => 'fa fa-star',
					'fields' => array(
						array(
							'id'    	=> 'option_chapter_text',
							'type'  	=> 'text',
							'title' 	=> __('Some Chapter Info','philosophy'),
						),
					)
				)
			),
		);
	}

	return $options;

}
add_filter( 'cs_metabox_options', 'philosophy_custom_post_types' );


function philosophy_theme_option_init(){
	$settings           = array(
		'menu_title'      => __('Philosophy Options','philosophy'),
		'menu_type'       => 'submenu', // menu, submenu, options, theme, etc.
		'menu_parent' => 	'themes.php',
		'menu_slug'       => 'philosophy_option_panel',
		'ajax_save'       => true,
		'show_reset_all'  => false,
		'framework_title' => __('Philosophy Options','philosophy'),
		'menu_icon' => 'dashions-dashboard'
	);
	$options = philosophy_theme_options();
	CSFramework::instance($settings,$options);
}
add_action("init","philosophy_theme_option_init");

function philosophy_theme_options(){
	// Framework Options
	// $options      = array();

	$options[] = array(
		'name' => 'footer_options',
		'title' => __('Footer Options','philosophy'),
		'icon' => 'fa fa-edit',
		'fields' => array(
			array(
				'id'    => 'footer_tag',
				'type'  => 'switcher',
				'title' => __('Tags Area Visible?','philosophy'),
				'default' => '0'
			),
			array(
				'id'    => 'social_facebook',
				'type'  => 'text',
				'title' => __('Facebook Url','philosophy'),
			),
			array(
				'id'    => 'social_pinterest',
				'type'  => 'text',
				'title' => __('Pinterest Url','philosophy'),
			),
			array(
				'id'    => 'social_linkedin',
				'type'  => 'text',
				'title' => __('Linkedin Url','philosophy'),
			),
		),
	);

	$options[]    = array(
		'name'      => 'section_unique_id',
		'title'     => 'First Section',
		'icon'      => 'fa fa-yelp',
		'fields'    => array(
			array(
			'id'    => 'option_id',
			'type'  => 'text',
			'title' => 'First Option',
			),
			array(
			'id'    => 'another_option_id',
			'type'  => 'textarea',
			'title' => 'Secondary Option',
			),
		)
	);

	$options[]    = array(
		'name'      => 'section_unique_id2',
		'title'     => 'First Section2',
		'icon'      => 'fa fa-xing',
		'fields'    => array(
			array(
			'id'    => 'option_id2',
			'type'  => 'text',
			'title' => 'First Option2',
			),
			array(
			'id'    => 'another_option_id2',
			'type'  => 'textarea',
			'title' => 'Secondary Option2',
			),
		)
	);


	$options[]    = array(
		'name'      => 'group_section',
		'title'     => __('Group Section','philosophy'),
		'icon'      => 'fa fa-xing',
		'fields'    => array(

				// a field
				array(
				'id'    => 'group_field',
				'type'  => 'group',
				'title' => __('Group Field','philosophy'),
				'button_title' => __('Add New','philosophy'),
				'accordion_title' => __('Add New Data', 'philosophy'),
				'fields' => array(
					array(
						'id'    => 'text_data',
						'type'  => 'text',
						'title' => __('Some Text','philosophy'),
					),
					array(
						'id'    => 'select_data',
						'type'  => 'select',
						'title' => __('Select Book','philosophy'),
						'options' => 'post',
						'query_args' => array(
							'post_per_page' => -1,
							'post_type' => 'book',							
						),
					),
					array(
						'id'    => 'image_data',
						'type'  => 'image',
						'title' => __('Upload Image','philosophy'),
					),
				),
			),			

		),
	);

	return $options;
}
// add_filter('cs_framework_options','philosophy_theme_options');



function philosophy_group_field_demo($options) {
	$options[]      = array(
		'id'            => 'post_group_data',
		'title'         => __('Group Data Demo','philosophy'),
		'post_type'     => 'post', // or post or CPT or array( 'page', 'post' )
		'context'       => 'normal',
		'priority'      => 'default',
		'sections'      => array(

			

			// begin section
			array(
			'name'      => 'group_section',
			'icon'      => 'fa fa-image',
			'fields'    => array(

				array(
					'id'    => 'section_icon',
					'type'  => 'icon',
					'title' => __('Icon Field','philosophy'),
				),
				array(
					'id'    => 'unique_option_3001',
					'type'  => 'color_picker',
					'title' => 'Color Picker Field',
					'default' => '#222',
				),
				array(
				'id'        => 'unique_option_4002',
				'type'      => 'typography',
				'title'     => 'Typography Field',
				'default'   => array(
					'family'  => 'Open Sans',
					'variant' => '800',
					'font'    => 'google', // this is helper for output
					),
				),

				// a field
				array(
				'id'    => 'group_field',
				'type'  => 'group',
				'title' => __('Group Field','philosophy'),
				'button_title' => __('Add New','philosophy'),
				'accordion_title' => __('Add New Data', 'philosophy'),
				'fields' => array(
					array(
						'id'    => 'text_data',
						'type'  => 'text',
						'title' => __('Some Text','philosophy'),
					),
					array(
						'id'    => 'image_data',
						'type'  => 'image',
						'title' => __('Upload Image','philosophy'),
					),
					// Heading
					array(
						'type'    => 'heading',
						'content' => __('Books Heading','philosophy'),
					),
					// Subheading
					array(
						'type'    => 'subheading',
						'content' => __('Books subheading','philosophy'),
					),
					// Select field
					array(
						'id'    => 'select_data',
						'type'  => 'select',
						'title' => __('Select Book','philosophy'),
						'options' => 'post',
						'query_args' => array(
							'post_per_page' => -1,
							'post_type' => 'book',							
						),
					),
					array(
						'type'    => 'content',
						'content' => __('Lorem ipsum dollar.','philosophy'),
					),
				),
			),			

		),
	),
),
);

return $options;

}
add_filter("cs_metabox_options","philosophy_group_field_demo");