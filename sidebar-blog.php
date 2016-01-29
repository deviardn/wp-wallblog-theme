<div class="sidebar-kiri">
    <div class="brand-kategori"><h3>Blog Details</h3></div>
    <div>
        <?php the_post_thumbnail('sidebar-blog', array( 'title' => get_the_title() )); ?>
    </div>
    <div id="images_details">
        <div><strong>Tittle :</strong> <?php the_title(); ?></div>
        <div><strong>Posted :</strong> <?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?></div>
        <div><strong>Viewed :</strong> <?php setPostViews(get_the_ID()); ?><?php echo getPostViews(get_the_ID()); ?> view</div>
        <div><strong>Tags :</strong> <?php the_tags(' '); ?></div>
        <div><strong>Author : </strong><?php the_author_posts_link(); ?></div>
    </div>

</div>