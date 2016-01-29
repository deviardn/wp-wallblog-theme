<div class="sidebar-kiri">
    <div class="brand-kategori"><h3>Image Details</h3></div>
    <div>
        <?php the_post_thumbnail('featured-home', array( 'title' => get_the_title() )); ?>
    </div>
    <div id="images_details">
        <div><strong>Tittle :</strong> <?php the_title(); ?></div>
        <div><strong>Category :</strong> <?php the_category(' '); ?></div>
        <div><strong>Posted :</strong> <?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?></div>
        <div><strong>Viewed :</strong> <?php setPostViews(get_the_ID()); ?><?php echo getPostViews(get_the_ID()); ?> view</div>
        <div><strong>Tags :</strong> <?php the_tags(' '); ?></div>
        <div><strong>File type :</strong> <span class="imgtype"><?php $args = array( 'post_type' => 'attachment', 'numberposts' => 1, 'post_status' => null, 'post_parent' => $post->ID ); $attachments = get_posts($args); if ($attachments) { foreach ( $attachments as $attachment ) { echo $attachment->post_mime_type; } } ?></span></div>
        <div><strong>File Size :</strong> <?php echo attfilesize(); ?></div>
        <div><strong>Resolution : </strong>  <?php
            $img_id = get_post_thumbnail_id($post->ID);
            $image = wp_get_attachment_image_src($img_id, $optional_size);
            ?>
            <?php echo '' . ($image[1]) . 'x' . ($image[2]); ?> Pixel </div>
        <div><strong>Total Download :</strong> <?php echo rand(10,50); ?> Download</div>

        <div>
            <strong>Download : </strong><a target="_blank" href="<?php $attachments = get_children( array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image') ); foreach ( $attachments as $attachment_id => $attachment ) { echo '' . get_attachment_link( $attachment_id ) . ''; } ?>">Here</a>
        </div>
        <div><strong>Author :</strong> <?php the_author_posts_link(); ?></div>

        <div>
            <strong>Blog : </strong><a target="_blank" href="http://walluhd.com/blog">www.walluhd.com/blog</a>
        </div>
    </div>
</div>
