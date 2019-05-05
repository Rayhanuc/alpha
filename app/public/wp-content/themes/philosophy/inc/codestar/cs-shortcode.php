<?php


// Shortcode
function philosophy_cs_google_map($options) {

	$options[]     = array(
		'name'          => 'group_1',
		'title'         => 'Group #1',
		'shortcodes'    => array(
			array(
				'name'      => 'gmap',
				'title'     => __('Google Map', 'philosophy'),
				'fields'    => array(
				array(
					'id'    => 'place',
					'type'  => 'text',
					'title' => __('Place','philosophy'),
					'help'  => 'Write place name.',
					'default' => 'Notre Dame College, Dhaka'
				),
				array(
					'id'    => 'width',
					'type'  => 'text',
					'title' => __('Width','philosophy'),
					'default' => '100%'
				),
				array(
					'id'    => 'height',
					'type'  => 'text',
					'title' => __('Height','philosophy'),
					'default' => 500,
				),
				array(
					'id'    => 'zoom',
					'type'  => 'text',
					'title' => __('Zoom','philosophy'),
					'default' => 14
				)
			),
			),

		)
	);

	
	return $options;
}
add_filter('cs_shortcode_options', 'philosophy_cs_google_map');