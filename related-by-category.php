<div class="clear-top"></div>
<div class="brand-related"><h3 class="htree"> More Blog Post : </h3></strong></div>

<div style="overflow: hidden">
    <?php
    $related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 6, 'post__not_in' => array($post->ID) ) );
    if( $related ) foreach( $related as $post ) {
        setup_postdata($post); ?>
        <div class="mtop">
            <div class="blog_post_box">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured-blog'); ?></a>

                <h2>
                    <strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong>
                </h2>
                <p><?php echo substr(strip_tags(get_the_content()),0,100); ?>...</p>

                <div class="btn">
                    <a href="<?php the_permalink(); ?>">
                        <div style="padding-left: 40px; padding-right: 40px">
                            <div class="btn-readmore">
                                Read More
                            </div>
                        </div>
                    </a>
                </div>
            </div><!--//blog_post_box-->
        </div>
    <?php }
    wp_reset_postdata(); ?>

</div>