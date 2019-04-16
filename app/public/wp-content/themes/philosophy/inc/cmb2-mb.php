<?php
add_action( 'cmb2_init', 'cmb2_add_image_info_metabox' );
function cmb2_add_image_info_metabox() {

	$prefix = '_philosophy_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'image_',
		'title'        => __( 'Image Information', 'philosophy' ),
		'object_types' => array( 'post' ),
		'context'      => 'normal',
		'priority'     => 'default',
	) );

	$cmb->add_field( array(
		'name' => __( 'Camera Model', 'philosophy' ),
		'id' => $prefix . 'camera_model',
		'type' => 'text',
		'default' => 'canon',
	) );

	$cmb->add_field( array(
		'name' => __( 'Location', 'philosophy' ),
		'id' => $prefix . 'location',
		'type' => 'text',
	) );

	$cmb->add_field( array(
		'name' => __( 'Date', 'philosophy' ),
		'id' => $prefix . 'date',
		'type' => 'text_date',
	) );

	$cmb->add_field( array(
		'name' => __( 'Licensed', 'philosophy' ),
		'id' => $prefix . 'licensed',
		'type' => 'checkbox',
	) );

	$cmb->add_field( array(
		'name' => __( 'Licensed Information', 'philosophy' ),
		'id' => $prefix . 'licensed_information',
        'type' => 'textarea',
        'attributes'  => array(
            'data-conditional-id' => $prefix . 'licensed',
        ),
    ) );

    $cmb->add_field( array(
		'name' => __( 'Image', 'philosophy' ),
		'id' => $prefix . 'image',
		'type' => 'file',
	) );

    $cmb->add_field( array(
		'name' => __( 'Upload Resume', 'philosophy' ),
		'id' => $prefix . 'resume',
		'type' => 'file',
		'text' => array(
            'add_upload_file_text'=> __('Upload PDF', 'philosophy')
        ),
		'query_args' => array(
            'type'=> array('Application/pdf')
        ),
		'options' => array(
            'url'=> false,
        ),
	) );

}

// For pricing table
function cmb2_add_pricingtable() {

	$prefix = '_philosophy_pt_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'pricing_table',
		'title'        => __( 'Pricing Table', 'philosophy' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'default',
	) );

	$group = $cmb->add_field( array(
		'name' => __( 'Pricing Table', 'philosophy' ),
		'id' => $prefix . 'pricing_table',
		'type' => 'group',
	) );

	$cmb->add_group_field( $group, array(
		'name' => __( 'Caption', 'philosophy' ),
		'id' => $prefix . 'pricing_caption',
        'type' => 'text',
    ) );
    
	$cmb->add_group_field( $group, array(
		'name' => __( 'Pricing Option', 'philosophy' ),
		'id' => $prefix . 'pricing_option',
        'type' => 'text',
        'repeatable' => true,
    ) );

    $cmb->add_group_field( $group, array(
		'name' => __( 'Price', 'philosophy' ),
		'id' => $prefix . 'price',
        'type' => 'text',
    ) );

}
add_action( 'cmb2_init', 'cmb2_add_pricingtable' );




/* 
Services
 */

add_action( 'cmb2_init', 'philosophy_add_services' );
function philosophy_add_services() {

	$prefix = '_philosophy_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'services',
		'title'        => __( 'Services', 'philosophy' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'default',
	) );

	$service = $cmb->add_field( array(
		'name' => __( 'service', 'philosophy' ),
		'id' => $prefix . 'service',
		'type' => 'group',
	) );

	$cmb->add_group_field($service, array(
		'name' => __( 'icon', 'philosophy' ),
		'id' => $prefix . 'icon',
		'type' => 'text',
	) );

	$cmb->add_group_field($service, array(
		'name' => __( 'title', 'philosophy' ),
		'id' => $prefix . 'title',
		'type' => 'text',
    ) );
    
	$cmb->add_group_field($service, array(
		'name' => __( 'content', 'philosophy' ),
		'id' => $prefix . 'content',
		'type' => 'text',
	) );

}
