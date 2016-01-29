<?Php
/*
Template Name: Page Popular
*/
?>
<?php get_header(); ?>
<?php include (TEMPLATEPATH . '/brand-web.php'); ?>
    <div class="full-content">
        <div class="brand-center center">
            <h1>50 Popular Wallpaper Post To Day</h1>
        </div>
        <div class="contentpopular">
            <?php include(TEMPLATEPATH . '/contentpopular.php'); ?>
        </div>
        <div class="mtop">
            <?php if (have_posts()) : ?>
                <?php
                $paged = ( get_query_var('paged') ? get_query_var('paged') : 1 );
                query_posts(array(
                    'posts_per_page' => 50,
                    'meta_key' => 'post_views_count',
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC',
                    //'ignore_sticky_posts' => 'true',
                    'paged' => $paged,
                ));
                ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php if (in_category(993)){ ?>
                        <div class="home_post_box">
                            <div class="hijau">
                                <a class="home_featured_post_hover" href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('featured-home', array( 'title' => get_the_title() )); ?>
                                </a>

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

                            </div>
                        </div>
                    <?php }else { ?>
                        <div class="home_post_box">
                            <div class="kuning">
                                <a class="home_featured_post_hover" href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('featured-home', array( 'title' => get_the_title() )); ?>
                                </a>

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

                                <div class="home-detail">
                                    <?php
                                    $img_id = get_post_thumbnail_id($post->ID);
                                    $image = wp_get_attachment_image_src($img_id, $optional_size);
                                    ?>
                                    <p><?php echo '' . ($image[1]) . 'x' . ($image[2]); ?> Pixel</p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php endwhile; else: ?>
                <?php _e('Sorry, no posts matched your criteria.'); ?>
            <?php endif; ?>
            <?php wp_reset_query(); ?>
        </div>
    </div>
    <div class="clear"></div>
<?php get_footer(); ?>