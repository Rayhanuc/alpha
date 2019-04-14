<?php

require_once get_theme_file_path( "/inc/tgm.php" );
require_once get_theme_file_path( "/lib/attachments.php" );

//FOR DYNAMIC VERSION
if(site_url() == "http://hellodolly.local"){
    define("VERSION", time());
}else {
    define("VERSION", wp_get_theme()->get("version"));
}

function philosophy_theme_setup() {
    load_theme_textdomain( "philosophy" );
    add_theme_support("post-thumbnails");
    add_theme_support("title-tag");
    add_theme_support('html5', array('search-form', 'comment-list'));
    add_theme_support("post-formats", array("image","gallery","quote","audio","video","link"));
    add_editor_style( "/assets/css/editor-style.css" );


    register_nav_menu("topmenu",__("Top Menu","philosophy"));

    register_nav_menus( array(
        "footer-left" => __("Footer Left Menu", "philosophy"),
        "footer-middle" => __("Footer Middle Menu", "philosophy"),
        "footer-right" => __("Footer Right Menu", "philosophy"),
    ) );

    add_image_size("philosophy-home-square",400,400,true);
}
add_action("after_setup_theme", "philosophy_theme_setup");



function philosophy_assets() {
    //CSS enqueue
    wp_enqueue_style("fontawesome-css", get_theme_file_uri( "/assets/css/font-awesome/font-awesome.min.css" ),null,"1.0");
    wp_enqueue_style("fonts-css", get_theme_file_uri( "/assets/css/fonts.css" ),null,"1.0");
    wp_enqueue_style("base-css", get_theme_file_uri( "/assets/css/base.css" ),null,"1.0");
    wp_enqueue_style("vendor-css", get_theme_file_uri( "/assets/css/vendor.css" ),null,"1.0");
    wp_enqueue_style("main-css", get_theme_file_uri( "/assets/css/main.css" ),null,"1.0");
    wp_enqueue_style("philosophy-css", get_stylesheet_uri(),null,VERSION);

    //JS enqueue
    wp_enqueue_script("modernizr-js",get_theme_file_uri("/assets/js/modernizr.js"),null,"1.0");
    wp_enqueue_script("pace-js",get_theme_file_uri("/assets/js/pace.min.js"),null,"1.0");
    wp_enqueue_script("plugins-js",get_theme_file_uri("/assets/js/plugins.js"),array("jquery"),"1.0",true);
    wp_enqueue_script("main-js",get_theme_file_uri("/assets/js/main.js"),array("jquery"),"1.0",true);
}
add_action("wp_enqueue_scripts", "philosophy_assets");



function philosophy_pagination(){
    global $wp_query;
    $links = paginate_links(array(
        'current' => max(1,get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'type' => 'list',
        'mid_size' => 3
    ));

    $links = str_replace("page-numbers", "pgn__num",$links);
    $links = str_replace("<ul class='pgn__num'>", "<ul>",$links);
    $links = str_replace("prev pgn__num", "pgn__prev",$links);
    $links = str_replace("next pgn__num", "pgn__next",$links);
    echo $links;
}


remove_action( "term_description", "wpautop" );



/*For About us page*/
function philosophy_widgets() {
    register_sidebar( array(
        'name'          => __( 'About us page', 'philosophy' ),
        'id'            => 'about-us',
        'description'   => __('Widgets in this area will be shown on about us page.','philosophy'),
        'before_widget' => '<div id="%1$s" class="%2$s col-block">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="quarter-top-margin">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Contact Page Maps Section', 'philosophy' ),
        'id'            => 'contact-maps',
        'description'   => __('Widgets in this area will be shown on contact page.','philosophy'),
        'before_widget' => '<div id="map-wrap %1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => '',
    ) );

    register_sidebar( array(
        'name'          => __( 'Contact Page Information Seciton', 'philosophy' ),
        'id'            => 'contact-info',
        'description'   => __('Widgets in this area will be shown on contact page.','philosophy'),
        'before_widget' => '<div id="%1$s" class="%2$s col-block">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="quarter-top-margin">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Before Footer Section', 'philosophy' ),
        'id'            => 'before-footer-right',
        'description'   => __('Before footer section, right side.','philosophy'),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Section', 'philosophy' ),
        'id'            => 'footer-right',
        'description'   => __('Footer section, right side.','philosophy'),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Bottom Section', 'philosophy' ),
        'id'            => 'footer-bottom',
        'description'   => __('Footer section, bottom side.','philosophy'),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => '',
    ) );
}
add_action( "widgets_init", "philosophy_widgets");