<?php

require_once get_theme_file_path( "/inc/tgm.php" );
require_once get_theme_file_path( "/inc/cmb2-mb.php" );
require_once get_theme_file_path( "/inc/cmb2-attached-posts.php" );
require_once get_theme_file_path( "/lib/attachments.php" );
require_once get_theme_file_path( "/lib/csf/cs-framework.php" );
require_once get_theme_file_path( "/inc/codestar/cs.php" );

define( 'CS_ACTIVE_LIGHT_THEME',  true  ); // default false


if ( ! isset( $content_width ) ) $content_width = 960;

//FOR DYNAMIC VERSION
if(site_url() == "http://hellodolly.local"){
    define("VERSION", time());
}else {
    define("VERSION", wp_get_theme()->get("version"));
}

function philosophy_theme_setup() {
    load_theme_textdomain( "philosophy",get_theme_file_path( "/languages" ) );
    add_theme_support("post-thumbnails");
    add_theme_support( "automatic-feed-links" );

    add_theme_support("title-tag");
    add_theme_support("custom-logo");
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

function wpse_add_title_support() {
    add_theme_support( 'title-tag' );
}
add_action ( 'after_setup_theme', 'wpse_add_title_support' );



function philosophy_assets() {
    //CSS enqueue
    wp_enqueue_style("fontawesome-css", get_theme_file_uri( "/assets/css/font-awesome/font-awesome.min.css" ),null,"1.0");
    wp_enqueue_style("fonts-css", get_theme_file_uri( "/assets/css/fonts.css" ),null,"1.0");
    wp_enqueue_style("base-css", get_theme_file_uri( "/assets/css/base.css" ),null,"1.0");
    wp_enqueue_style("vendor-css", get_theme_file_uri( "/assets/css/vendor.css" ),null,"1.0");
    wp_enqueue_style("main-css", get_theme_file_uri( "/assets/css/main.css" ),null,"1.0");
    wp_enqueue_style("fontawesome", "//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css");
    wp_enqueue_style("philosophy-css", get_stylesheet_uri(),null,VERSION);

    //JS enqueue
    wp_enqueue_script("modernizr-js",get_theme_file_uri("/assets/js/modernizr.js"),null,"1.0");
    wp_enqueue_script("pace-js",get_theme_file_uri("/assets/js/pace.min.js"),null,"1.0");
    wp_enqueue_script("plugins-js",get_theme_file_uri("/assets/js/plugins.js"),array("jquery"),"1.0",true);

    if ( is_singular() ) {
        wp_enqueue_script( "comment-reply" );
    }

    if (is_page_template( 'ajax.php' )) {
        wp_enqueue_script("ajaxtest-js",get_theme_file_uri("/assets/js/ajaxtest.js"),array("jquery"),time(),true);
        $ajaxurl = admin_url('admin-ajax.php');

        wp_localize_script( 'ajaxtest-js', 'urls', array('ajaxurl'=>$ajaxurl) );
    }
        
    wp_enqueue_script("main-js",get_theme_file_uri("/assets/js/main.js"),array("jquery"),"1.0",true);
}
add_action("wp_enqueue_scripts", "philosophy_assets");

// Plugabble function
if (!function_exists("philosophy_pagination")) {
    function philosophy_pagination(){
        global $wp_query;
        $links = paginate_links(array(
            'current' => max(1,get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'type' => 'list',
            'mid_size' => apply_filters("philosophy_pagination_mid_size",3),
        ));

        $links = str_replace("page-numbers", "pgn__num",$links);
        $links = str_replace("<ul class='pgn__num'>", "<ul>",$links);
        $links = str_replace("prev pgn__num", "pgn__prev",$links);
        $links = str_replace("next pgn__num", "pgn__next",$links);
        echo wp_kses_post($links);
    }
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


    register_sidebar( array(
        'name'          => __( 'Header Seciton', 'philosophy' ),
        'id'            => 'header-section',
        'description'   => __('Widgets in this area will be shown on header section.','philosophy'),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
}
add_action( "widgets_init", "philosophy_widgets");


function philosophy_search_form($form){
    $homedir = home_url("/");
    $label = __( "Search for:", "philosophy" );
    $button_label = __("Search","philosophy");
    $post_type = <<<PT
<input type="hidden" name="post_type" value="post">
PT;

    if (is_post_type_archive( 'book' )) {
         $post_type = <<<PT
<input type="hidden" name="post_type" value="book">
PT;
    }

    $newform = <<<FORM
<form role="search" method="get" class="header__search-form" action="{$homedir}">
    <label>
        <span class="hide-content">{$label}</span>
        <input type="search" class="search-field" placeholder="Type Keywords" value="" name="s" title="{$label}" autocomplete="off">
    </label>
    {$post_type}
    <input type="submit" class="search-submit" value="{$button_label}">
</form>
FORM;

    return $newform;
}
add_filter( "get_search_form", "philosophy_search_form" );


function category_before_title1(){
    echo "<p>Before Title 1</p>";
}
add_action("philosophy_before_category_title","category_before_title1");

function category_before_title2(){
    echo "<p>Before Title 2</p>";
}
add_action("philosophy_before_category_title","category_before_title2",1);

function category_before_title3(){
    echo "<p>Before Title 3</p>";
}
add_action("philosophy_before_category_title","category_before_title3",8);

function category_after_title(){
    echo "<p>after Title</p>";
}
add_action("philosophy_after_category_title","category_after_title");

// description
function category_after_description(){
    echo "<p>After Description</p>";
}
add_action("philosophy_after_category_description","category_after_description");


// Remove hook
remove_action("philosophy_before_category_title", "category_before_title1");
remove_action("philosophy_before_category_title", "category_before_title2",1);
remove_action("philosophy_before_category_title", "category_before_title3",8);
remove_action("philosophy_after_category_title", "category_after_title");
remove_action("philosophy_after_category_description", "category_after_description");


function beginning_category_page($category_title) {
    if ("New" == $category_title) {
        $visit_count = get_option( 'category_new' );
        $visit_count = $visit_count ? $visit_count:0;
        $visit_count++;
        update_option("category_new", $visit_count);
    }
}
add_action( "philosophy_category_page", "beginning_category_page" );


function philisophy_home_banner_class($class_name){
    if (is_home()) {
        return $class_name;
    }else {
        return "";
    }
}
add_filter("philisophy_home_banner_class","philisophy_home_banner_class");


function pagination_mid_size($size){
    return 2;
}
add_filter( "philosophy_pagination_mid_size", "pagination_mid_size" );



function uppercase_text($param1,$param2,$param3) {
    return ucwords($param1)." ". strtoupper($param2)." ".ucwords($param3);
}
add_filter("philisophy_text", "uppercase_text",10,3 );




function philosophy_cpt_slug_fix($post_link,$id) {
    $p = get_post($id);

    if (is_object($p) && 'chapter' == get_post_type($id)) {
        $parant_post_id = get_field('parent_book');
        $parant_post = get_post($parant_post_id);
        if ($parant_post) {
            $post_link = str_replace('%book%', $parant_post->post_name, $post_link);
        }        
    }

    if (is_object($p) && 'book' == get_post_type($p)) {
        $genre = wp_get_post_terms($p->ID,'genre');
        if (is_array($genre) && count($genre)>0) {
            $slug = $genre[0]->slug;
            $post_link = str_replace('%genre%', $slug, $post_link);
        }else {
            $slug = "generic";
            $post_link = str_replace('%genre%', $slug, $post_link);
        }
    }
    return $post_link;
}
add_filter('post_type_link','philosophy_cpt_slug_fix',1,2);




function philosophy_footer_language_heading($title) {
    if (is_post_type_archive( 'book' ) || is_tax('language')) {
        $title = __('Languages', 'philosophy');
    }
    return $title;
}
add_filter( 'philosophy_footer_tag_heading', 'philosophy_footer_language_heading' );


function philosophy_footer_language_terms($tags) {
    if (is_post_type_archive( 'book' )) {
        $tags = get_terms(array(
            'taxonony' => 'language',
            'hide_empty' => false,
        ));
    }
    return $tags;
}
add_filter( 'philosophy_footer_tag_items', 'philosophy_footer_language_terms' );



// AJAX FUNCTION
function philisophy_ajaxtest(){
    if (check_ajax_referer('ajaxtest','s')) {
        $info = $_POST['info'];
        echo strtoupper($info);

        die();        
    }
}
add_action('wp_ajax_ajaxtest','philisophy_ajaxtest');

function philisophy_ajaxtest_nopriv(){
     if (check_ajax_referer('ajaxtest','s')) {
        $info = $_POST['info'];
        echo strtoupper("GLOBAL ".$info);

        die();       
    }
}
add_action('wp_ajax_nopriv_ajaxtest','philisophy_ajaxtest_nopriv');



function philosophy_nonce_life(){
    return 20;
}
add_filter('nonce_life','philosophy_nonce_life');
