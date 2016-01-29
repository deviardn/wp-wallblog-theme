<?Php
/*
Template Name: Page Random
*/
get_header ( ) ;  ?>
<?php include (TEMPLATEPATH . '/brand-web.php'); ?>
    <div class="full-content">
        <div class="brand-center center">
            <h1>Random Post In WalluHD.com</h1>
        </div>
        <div class="contentpopular">
            <?php include(TEMPLATEPATH . '/contentrandom.php'); ?>
        </div>
        <div class="mtop">
            <?php
            $posts = get_posts('orderby=rand&numberposts=15');
            foreach($posts as $post) {
                ?>
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
            <?php } ?>
        </div>
        <div class="clear"></div>
    </div>
<?php  get_footer ( ) ;  ?>