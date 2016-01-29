<?php get_header(); ?>
<?php //include (TEMPLATEPATH . '/brand-web.php'); ?>

    <div id="content_left">
        <div class="single_content">
            <div class="brand-single-cat-blog"><h1><?php the_title() ?></h1></div>
            <div><?php include (TEMPLATEPATH . '/content-single-blog.php'); ?></div>
            <div class="single-blog">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="single_image">
                    <?php the_content(); ?>
                    <?php endwhile; else: ?>
                        <h3>Sorry, no posts matched your criteria.</h3>
                    <?php endif; ?>
                    <?php setPostViews(get_the_ID()); ?>
                </div><!--//bigimages-->
            </div>
            <div class="clear"></div>
        </div><!--//content_left-->
        <?php include (TEMPLATEPATH . '/disclaimer-bro.php'); ?>
    </div>
<?php include (TEMPLATEPATH . '/sidebar-blog.php'); ?>
    <div class="clear"></div>
    <div class="single_related">
        <?php include (TEMPLATEPATH . '/related-by-category.php'); ?>
    </div>
    <div class="clear"></div>
<?php comments_template(); ?>
    <div class="clear"></div>
<?php get_footer(); ?>