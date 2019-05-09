<?php
if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.


function philosophy_language_featured_image($options) {

	$options[]   = array(
	  'id'       => 'language_featured_image',
	  'taxonomy' => 'language',
	  'fields'   => array(

	    array(
	      'id'    => 'featured_image',
	      'type'  => 'image',
	      'title' => __('Featured Image','philosophy'),
	    ),

	  ),
	);

	return $options;

}
add_filter('cs_taxonomy_options', 'philosophy_language_featured_image');