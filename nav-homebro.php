<div id="dol-pagination">
    <?php if (function_exists('custom_wp_pagenavi_home')) : ?>
        <?php custom_wp_pagenavi_home(); ?>
    <?php else : ?>
        <div class="alignleft"><?php posts_nav_link('',__('&laquo; Newer Posts'),'') ?></div>
        <div class="alignright"><?php posts_nav_link('','',__('Older Posts &raquo;')) ?></div>
    <?php endif; ?>
    <div class="clearfix"></div>
</div>