
<?php do_action( 'philosophy_category_page', single_cat_title('',false) ) ; ?>

<?php get_header(); ?>


    <!-- s-content
    ================================================== -->
    <section class="s-content">

        <div class="row narrow">
            <div class="col-full s-content__header" data-aos="fade-up">

                <!-- apply filters example -->
                <?php // echo apply_filters("philisophy_text","hello","wornderful","world");?>
                
                <!-- before action hook -->
                <?php do_action('philosophy_before_category_title');?>

                <h3><?php _e( "New Translatable Text", "philosophy" ); ?></h3>
                <h3><?php printf(__( "%s New Translatable Text 2", "philosophy" ),"Hi,"); ?></h3>

                <h1>
                <?php single_cat_title(  ) ; ?>
                </h1>
                
                <!-- after action hook -->
                <?php do_action( 'philosophy_after_category_title' ) ; ?>

                <!-- before action hooke -->
                <?php do_action( 'philosophy_before_category_description' ) ; ?>
                <p class="lead">
                <?php
                echo category_description();
                ?>
                </p>
                <!-- after action hooke -->
                <?php do_action( 'philosophy_after_category_description' ) ; ?>
            </div>
        </div>
        
        <div class="row masonry-wrap">
            <div class="masonry">

                <div class="grid-sizer"></div>

                <?php 
                    if (!have_posts()) :
                ?>

                <h5 class="text-center"><?php _e( "There is no post in this category.", "philosophy" ) ; ?></h5>

                <?php
                    endif;
                ?>

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