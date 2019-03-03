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
        $posts_per_page = 3;
        $post_ids = array(41,45,35,26,39,36,32);
        $_p = new WP_Query(array(
            // 'category_name' => 'new',
            // 'tag' => 'special',
            'posts_per_page' => $posts_per_page,
            'paged' => $paged,
            'tax_query' => array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => array(
                        'post-format-audio',
                        'post-format-video'
                    ),
                    'operator'=>"NOT IN"
                )
            )

            /* 'monthnum' => 2,
            'year' => 2019,
            'post_status ' => 'draft' */
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
            <div class="col-md-12">
                <?php
                echo paginate_links(array(
                    'total' => $_p->max_num_pages,
                    'current' => $paged,
                    'prev_next'=> false,
                    /* 'prev_text' => __('Old posts', 'alpha'),
                    'next_text' => __('Next posts', 'alpha'), */
                ))
                ?>
            </div>
        </div>
    </div>

</div><!-- posts end div -->

<?php get_footer();?>