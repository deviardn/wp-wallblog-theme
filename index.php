<?php get_header(); ?>
<!--

Letak Iklan

-->


<div class="full-content">
    <?php if ( is_home() ) {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        query_posts($query_string . '&cat=-993&paged='.$paged);
    } ?>
    <?php if (is_paged()){ }
    while (have_posts()) : the_post(); ?>


        <div class="home_post_box" >
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php the_post_thumbnail('featured-home', array( 'title' => get_the_title() )); ?>
            </a>
            <!--<img src="<?php //bloginfo('stylesheet_directory'); ?>/images/home-big-image1.png" />-->
            <h2>
                <strong>
                    <a href="<?php the_permalink(); ?>">
                        <?php if ( strlen(get_the_title()) > 50 ) {
                            echo substr(get_the_title(), 0, 50)."...";
                        } else {
                            the_title();
                        } ?>
                    </a>
                </strong>
            </h2>
            <?php
            $img_id = get_post_thumbnail_id($post->ID);
            $image = wp_get_attachment_image_src($img_id, $optional_size);
            ?>
            <p><?php echo '' . ($image[1]) . 'x' . ($image[2]); ?> Pixel</p>
        </div><!--//home_post_box-->




    <?php endwhile; ?>

</div>

<div class="clear"></div>

<!--

Letak Iklan

-->
<?php include (TEMPLATEPATH . '/nav-homebro.php'); ?>

<div class="clear"></div>
<?php wp_reset_query(); ?>

<?php get_footer(); ?>  