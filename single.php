<?php get_header(); ?>

    <div id="content_left">
        <div class="single_content">

            <h1><strong><?php the_title() ?></strong></h1>
            <div class="breadchumb">
                <?php include (TEMPLATEPATH . '/breadchumb.php'); ?>
            </div>
            <!--

            Letak Iklan

            -->
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="single_image">
                <?php
                $argsThumb = array(
                    'order'          => 'ASC',
                    'post_type'      => 'attachment',
                    'post_parent'    => $post->ID,
                    'post_mime_type' => 'image',
                    'post_status'    => null
                );
                $attachments = get_posts($argsThumb);
                $thumb_title = get_the_title( $thumb_id );
                if ($attachments) {
                    foreach ($attachments as $attachment) {
                        //echo apply_filters('the_title', $attachment->post_title);
                        echo '<img src="' . wp_get_attachment_url($attachment->ID, 'large') . '" alt="' . $thumb_title . ' Wallpaper" title="' . $thumb_title . ' Wallpaper" />'; } }
                ?>
                <!--h2><strong><?php the_title(); ?> Wallpaper</strong></h2-->
                <?php endwhile; else: ?>
                    <h3>Sorry, no posts matched your criteria.</h3>
                <?php endif; ?>
                <?php setPostViews(get_the_ID()); ?>
            </div><!--//bigimages-->

            <?php include (TEMPLATEPATH . '/content-single-description.php');; ?>


        </div><!--//content_left-->
        <div class="clear"></div>
        <?php include (TEMPLATEPATH . '/disclaimer-bro.php'); ?>
    </div>

<?php include (TEMPLATEPATH . '/image-details.php'); ?>

    <div class="clear"></div>

    <div class="single_related">
        <?php include (TEMPLATEPATH . '/advance-related.php'); ?>
    </div>
<?php get_footer(); ?>