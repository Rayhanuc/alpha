<?php
/* 
* Template Name: Custom Query WPQuery
*/
?>

<?php get_header()?>
<body <?php body_class();?>>
<?php get_template_part("/template-parts/common/hero")?>

<div class="posts text-center"><!-- posts start div -->
    
    <?php
        $paged = get_query_var("paged")?get_query_var("paged"):1;
        $posts_per_page = 2;
        $total_post = 9;
        $post_ids = array(41,45,35,26,39,36,32);
        $_p = new WP_Query(array(
			// 'posts_per_page'=> $posts_per_page,
            'numberposts' => $total_post,
            'orderby' => 'post__in',
            'paged' => $paged,
        ));
        while ($_p->have_posts()) {
            $_p->the_post();
            ?>
                <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
            <?php
			
        }
        wp_reset_query(  );
    ?>

	<div class="container post-pagination">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8 text-center">
                <!-- pagination setting -->
            </div>
        </div>
    </div>

</div><!-- posts end div -->

<?php get_footer();?>