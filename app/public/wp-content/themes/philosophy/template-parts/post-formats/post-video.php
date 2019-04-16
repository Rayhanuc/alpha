<?php
$philosophy_video_file = "";
if(function_exists("the_field")){
    $philosophy_video_file = get_field("source_file");
}
?>

<article <?php post_class("masonry__brick entry format-video"); ?> data-aos="fade-up">
                        
    <div class="entry__thumb video-image">
        <a href="https://player.vimeo.com/video/<?php echo esc_url( $philosophy_video_file ); ?>?color=01aef0&title=0&byline=0&portrait=0" data-lity>
            <?php the_post_thumbnail("philosophy-home-square") ; ?>
        </a>
    </div>

    <?php get_template_part( "template-parts/common/post/summery" ) ; ?>

</article> <!-- end article -->






<!-- <article class="masonry__brick entry format-video" data-aos="fade-up">
                        
    <div class="entry__thumb video-image">
        <a href="https://player.vimeo.com/video/117310401?color=01aef0&title=0&byline=0&portrait=0" data-lity>
            <img src="images/thumbs/masonry/shutterbug-400.jpg" 
                    srcset="images/thumbs/masonry/shutterbug-400.jpg 1x, images/thumbs/masonry/shutterbug-800.jpg 2x" alt="<?php //the_title(); ?>">
        </a>
    </div>

    <?php //get_template_part( "template-parts/common/post/summery" ) ; ?>

</article> end article -->