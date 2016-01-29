<?php get_header(); ?>

    <div class="konten_dewe">
        <div id="content_left">
            <div class="single_content">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <h1><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                    <br /><br />
                <?php endwhile; else: ?>
                    <h3>Sorry, no posts matched your criteria.</h3>
                <?php endif; ?>
            </div><!--//single_content-->
        </div><!--//content_left-->
    </div>
    <div class="clear"></div>
<?php get_footer(); ?>