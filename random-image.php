<div class="single_related">
    <div class="relatedku">
        <div class="brand-related">
            <h2>More Images :</h2>
        </div>
        <div class="mtop">
            <?php //randompost
            query_posts(array('orderby' => 'rand', 'showposts' => 10));
            if (have_posts()) :
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
                        <!--<img src="<?php //bloginfo('stylesheet_directory'); ?>/images/home-big-image1.png" />-->
                        <?php
                        $img_id = get_post_thumbnail_id($post->ID);
                        $image = wp_get_attachment_image_src($img_id, $optional_size);
                        ?>
                        <p><?php echo '' . ($image[1]) . 'x' . ($image[2]); ?> Pixel</p>
                    </div><!--//home_post_box-->

                <?php endwhile;
            endif; ?>
        </div>
    </div>
</div>