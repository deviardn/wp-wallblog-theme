<div id="breadchumb">
    <?php if (is_home()) { ?> <a href="<?php bloginfo('url'); ?>">home <?php print '&raquo;';?></a> <?php bloginfo('description');?><?php  if ( get_query_var('paged') ) { echo ' ('; echo __('page') . ' ' . get_query_var('paged');   echo ')';  } ?>
    <?php } else {?><?php if (function_exists('breadcrumbs')) breadcrumbs(); ?>
    <?php }?>
</div>