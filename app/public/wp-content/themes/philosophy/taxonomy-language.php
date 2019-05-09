<?php get_header(); ?>


    <!-- s-content
    ================================================== -->
    <section class="s-content"> 


        <h2 class="text-center"><?php single_cat_title() ; ?></h2>
        
        <div class="text-center">
            <?php

            $philosophy_term = get_queried_object();
            $philosophy_term_meta = get_term_meta($philosophy_term->term_id, 'language_featured_image', true);
            // print_r($term_meta);
            if (isset($philosophy_term_meta['featured_image']) && $philosophy_term_meta['featured_image']>0 ) {
                echo wp_get_attachment_image($philosophy_term_meta['featured_image'],'medium');
            }
            
            ?>
        </div>   	

        <div class="row masonry-wrap">
            <div class="masonry">


                <div class="grid-sizer"></div>

                <?php
                while(have_posts()){
                    the_post();
                    get_template_part( "template-parts/post-formats/post",get_post_format(  ) );
                }
                
                ?>

            </div> <!-- end masonry -->
        </div> <!-- end masonry-wrap -->

        <!-- Pagination -->
        <div class="row">
            <div class="col-full">
                <nav class="pgn">
                    <?php philosophy_pagination() ; ?>
                </nav>
            </div>
        </div>

    </section> <!-- s-content -->


<?php get_footer(); ?>