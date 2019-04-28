<?php

/*
Template Name: Tax Query Example

*/

$philosophy_query_arg = array(
	'post_type' => 'book',
	'posts_per_page' =>-1,
	'tax_query' => array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'language',
			'field' => 'slug',
			'terms' => array('bangla')
		),

		array(
			'taxonomy' => 'language',
			'field' => 'slug',
			'terms' => array('english'),
			'operator' => 'NOT IN'
		),
	),
);

$philosophy_posts = new WP_Query($philosophy_query_arg);

// echo $philosophy_posts->found_posts;

while ($philosophy_posts->have_posts()) {
	$philosophy_posts->the_post();
	the_title();
	echo "<br/>";
}

wp_reset_query();