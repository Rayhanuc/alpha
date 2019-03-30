<?php
$alpha_layout_class = "col-md-8";
$alpha_text_class = "";
if (!is_active_sidebar("sidebar-1")) {
    $alpha_layout_class = "col-md-10 offset-md-1";
    $alpha_text_class = "text-center";
}
?>


<?php get_header()?>

<body <?php body_class(array("first_class", "second_class", "thirt_class", "fourth_class"));?>>

<?php get_template_part("/template-parts/common/hero")?>

<div class="container">
    <div class="row">
        <div class="<?php echo $alpha_layout_class;?>">
            <div class="posts"><!-- posts start div -->
                <?php
                    while(have_posts()) :
                        the_post();
                    
                ?><!-- While loop start for post -->
                <div <?php post_class(array("first_post_class", "second_post_class", "thirt_post_class", "fourth_post_class"));?>><!-- single post start div -->
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="post-title <?php echo $alpha_text_class?>">
                                    <?php the_title();?>
                                </h2>
                                <p class="<?php echo $alpha_text_class?>">
                                    <strong><?php the_author_posts_link(); ?></strong><br/>
                                    <?php echo get_the_date();?>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="slider">
                                    <?php
                                        if ( class_exists( 'Attachments' ) ) {
                                            $attachments = new Attachments( 'slider' );
                                            if ( $attachments->exist() ) {
                                                while ($attachment = $attachments->get() ) {
                                                    ?>
                                                        <div>
                                                            <?php echo $attachments->image( 'large' );?>
                                                        </div>
                                                    <?php
                                                }
                                            }
                                        }
                                    ?>
                                </div>
                                <div>
                                    <?php
                                        if ( !class_exists( 'Attachments' ) ) {
                                            // for post thumbnail/image
                                            if(has_post_thumbnail()) {
                                                //$thumbnail_url = get_the_post_thumbnail_url( null, "large" );
                                                // echo "<a href="'.$thumbnail_url.'" data-featherlight="image">";
                                                echo '<a class="phpup" href="#" data-featherlight="image">';
                                                the_post_thumbnail("large", array("class"=>"img-fluid"));
                                                echo "</a>";
                                            }
                                        }
                                        
                                        the_content();

                                        if(get_post_format() == "image" && function_exists("the_field")) :

                                            /* $camera_model = get_post_meta(get_the_ID(), "camera_model", true);                                            
                                            $related_posts = get_post_meta(get_the_ID(), "related_posts", true);
                                            print_r($related_posts); */
                                        ?>
                                        <div class="metainfo">
                                            <strong>Camera Model : </strong> <?php the_field("camera_model") ; ?> <br>
                                            <strong>Location : </strong>
                                                <?php
                                                    $alpha_location = get_field("location") ;
                                                    echo esc_html($alpha_location)
                                                ?> 
                                            <br>
                                            <strong>Date : </strong> <?php the_field("date") ; ?> <br>
                                            
                                            <?php
                                            if(get_field("licensed")) :
                                            ?>
                                            <p>
                                                <?php echo apply_filters("the_content", get_field("license_information")) ; ?>
                                            </p>

                                            <?php endif; ?>

                                            <p>
                                                <?php 
                                                    $alpha_image = get_field("rendom_image");
                                                    $alpha_image_details = wp_get_attachment_image_src($alpha_image,"alpha-square");
                                                    echo "<img src='" . esc_url($alpha_image_details [0]) . "'/>'";
                                                ?>
                                            </p>


                                            <p>                                                
                                                <?php
                                                $file = get_field("attachment");
                                                if($file){
                                                    $file_url = wp_get_attachment_url( $file );
                                                    $file_thumb = get_field("thumbnail", $file);
                                                    if($file_thumb){
                                                        $file_thumbnail_details = wp_get_attachment_image_src( $file_thumb, "thumbnail" );
                                                        echo "<a target='_blank' href='{$file_url}'><img src='" . esc_url($file_thumbnail_details [0]) . "'/>'</a>";
                                                    }else {
                                                        echo "<a target='_blank' href='{$file_url}'>{$file_url}</a>";
                                                    }
                                                }
                                                ?>                                                
                                            </p>

                                            <?php if(function_exists("the_field")) : ?>
                                                <div>
                                                    <h1><?php _e("Reloated Posts", "alpha");?></h1>
                                                    <?php
                                                        $related_posts = get_field("related_posts");
                                                        $alpha_rp   = new WP_Query(array(
                                                            'post__in' => $related_posts,
                                                            'orderby' => 'post__in',
                                                        ));

                                                        while ($alpha_rp->have_posts() ) {
                                                            $alpha_rp->the_post();
                                                            ?>
                                                            <h4><?php the_title() ; ?></h4>
                                                            <?php
                                                                }
                                                                wp_reset_query(  );
                                                            ?>
                                                </div>
                                            <?php endif; ?>

                                        </div>

                                        <?php
                                        endif;
                                        ?>


                                        <?php
                                        

                                        // this is just for test of image size
                                        /* the_post_thumbnail("alpha-square-new1");
                                        echo "<br/>";
                                        the_post_thumbnail("alpha-square-new2");
                                        echo "<br>";
                                        the_post_thumbnail("alpha-square-new3"); */



                                        wp_link_pages();

                                        /*/next_post_link();
                                        echo "<br/>";
                                        previous_post_link();*/
                                    ?>
                                </div>
                                
                            </div>

                            <div class="authorsection">
                                <div class="row">
                                    <div class="col-md-2 authorimage">
                                        <?php 
                                            echo get_avatar(get_the_author_meta( "ID" ));
                                        ?>
                                    </div>
                                    <div class="col-md-10">
                                        <h4>
                                            <?php echo get_the_author_meta("display_name");?>
                                        </h4>
                                        <p>
                                            <?php echo get_the_author_meta("description");?>
                                        </p>


                                        <?php if(function_exists("the_field")) : ?>
                                        <p>
                                            Facebook URL: <?php the_field("facebook", "user_".get_the_author_meta( "ID" ));?>
                                            <br/>
                                            Twitter URL: <?php the_field("twitter", "user_".get_the_author_meta( "ID" ));?>
                                            <br/>
                                            Linkedin URL: <?php the_field("linkedin", "user_".get_the_author_meta( "ID" ));?>
                                        </p>
                                        <?php endif; ?>
                                    </div>
                                </div>                            
                            </div>

                            <?php if(!post_password_required() ) : ?>
                                <div class="col-md-10 offset-md-1">
                                    <?php comments_template();  ?>
                                </div>
                            <?php endif;?>
                        </div>

                    </div>
                </div><!-- single post end div -->
                <?php endwhile;?><!-- end While loop for post -->

                <div class="continer post-pagination">
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
        </div><!-- col-md-8 end -->
        <?php
            if (is_active_sidebar("sidebar-1")):
        ?>
        <div class="col-md-4">
            <?php
            if(is_active_sidebar("sidebar-1")) {
                dynamic_sidebar("sidebar-1");
            }?>
        </div>
        <?php
            endif;
        ?>
    </div>
</div>



<?php get_footer();?>