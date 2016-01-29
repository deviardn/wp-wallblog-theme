<?php get_header(); ?>

    <h1 class="center">Download <?php the_title() ?> Full Size</h1>

    <div class="attachment_page">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <center>
                <div class="attimage"><?php echo wp_get_attachment_image( $post->ID, 'large' ); ?></div>
            </center>

            <br />

            <?php if ( wp_attachment_is_image( get_the_ID() ) ) { ?>
                <div class="image-meta">
                    <?php printf( __( 'Download Sizes: %s', 'example-textdomain'), my_get_image_size_links() ); ?>
                </div>
            <?php } ?>

        <?php endwhile; else: ?>

            <h3>Sorry, no posts matched your criteria.</h3>

        <?php endif; ?>
    </div>
    <div class="clear"></div>

    <div>
        <?php include (TEMPLATEPATH . '/disclaimer-bro.php'); ?>
    </div>

<?php include (TEMPLATEPATH . '/random-image.php'); ?>
    <div class="clear"></div>

<?php get_footer(); ?>