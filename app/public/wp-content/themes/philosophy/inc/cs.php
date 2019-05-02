<?php


define( 'CS_ACTIVE_FRAMEWORK',   false  ); // default true
define( 'CS_ACTIVE_METABOX',     true ); // default true
define( 'CS_ACTIVE_TAXONOMY',    false ); // default true
define( 'CS_ACTIVE_SHORTCODE',   false ); // default true
define( 'CS_ACTIVE_CUSTOMIZE',   false ); // default true



function philosophy_csf_metabox(){
	CSFramework_Metabox::instance(array());
}
add_action('init', 'philosophy_csf_metabox');

function philosophy_page_metabox($options) {
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