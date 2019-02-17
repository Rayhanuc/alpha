<?php
/* 
* Template Name: Custom Query
*/
?>

<?php get_header()?>
<body <?php body_class();?>>
<?php get_template_part("/template-parts/common/hero")?>

<div class="posts text-center"><!-- posts start div -->
    
    <?php
        $_p = get_posts(array(
			'posts_per_page'=> 3,
            'post__in' => array(41,45,26,39,35),
            'orderby' => 'post__in'
        ));
        foreach ($_p as $post) {
            setup_postdata( $post );
            ?>
                <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
            <?php
			
		}
		wp_reset_postdata(  );
    ?>

	<div class="container post-pagination">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <?php
                    the_posts_pagination(array(
                        "screen_reader_text" => " ",
                        "prev_text" => __("New Posts", "alpha"),
                        "next_text" => __("Next Posts", "alpha"),
                    ));
                ?>
            </div>
        </div>
    </div>

</div><!-- posts end div -->

<?php get_footer();?>