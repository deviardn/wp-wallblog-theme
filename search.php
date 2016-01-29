<?php get_header(); ?>
    <div class="full-content">
        <div class="brand-center center">
            <h1>Page Search</h1>
        </div>
        <div class="contentpopular">
            <?php include(TEMPLATEPATH . '/content-search.php'); ?>
        </div>

        <div class="mtop">
            <?php if (have_posts()) : ?>

                <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

                <?php $x = 0; ?>
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



                    <?php $x++; ?>
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

    </div>
<?php include (TEMPLATEPATH . '/nav.php'); ?>

<?php wp_reset_query(); ?>

<?php get_footer(); ?>