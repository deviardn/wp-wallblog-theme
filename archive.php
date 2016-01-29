<?php get_header(); ?>

<div class="full-content">
    <div class="authorbro">
        <?php if (have_posts()) : ?>

        <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
        <?php /* If this is a category archive */ if (is_category()) { ?>
            <h1>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h1>
            <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
            <h1>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h1>
            <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
            <h1>Archive for <?php the_time('F jS, Y'); ?></h1>
            <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
            <h1>Archive for <?php the_time('F, Y'); ?></h1>
            <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
            <h1>Archive for <?php the_time('Y'); ?></h1>
            <?php /* If this is an author archive */ } elseif (is_author()) { ?>
            <h1>Author Archive</h1>
            <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
            <h1>Blog Archives</h1>
        <?php } ?>
    </div>
    <div class="contentpopular">
        <?php include(TEMPLATEPATH . '/content-archive.php'); ?>
    </div>

    <div class="mtop">
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

        <?php endwhile; ?>

        <?php else :

            if ( is_category() ) { // If this is a category archive
                printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
            } else if ( is_date() ) { // If this is a date archive
                echo("<h2 class='center'>Sorry, but there aren't any posts with this date.</h2>");
            } else if ( is_author() ) { // If this is a category archive
                $userdata = get_userdatabylogin(get_query_var('author_name'));
                printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
            } else {
                echo("<h2 class='center'>Upss, No posts found.</h2>
");
            }
            ?> <div class="center" style="margin: 10px 0px 10px 0px"> <?php  get_search_form(); ?></div>
        <?php endif; ?>
    </div>

    <div class="clear"></div>

    <div class="navigation">
        <?php include (TEMPLATEPATH . '/nav.php'); ?>
        <div class="clear"></div>
    </div><!--//navigation-->

    <?php wp_reset_query(); ?>

</div>
<div class="clear"></div>

<?php get_footer(); ?>    