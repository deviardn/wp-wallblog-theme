<?php
/*
Template Name: Meta
*/
?>
<?php if (is_single()) { ?>
    <meta name='robots' content='index,follow' />
    <title><?php echo ucwords(substr($post->post_title,0,46)).' #'.$post->ID.''; ?> Wallpaper | <?php bloginfo('name'); ?></title>
    <meta name="description" content="<?php echo ucwords(substr($post->post_title,0,100)).' #'.$post->ID.''; ?> Wallpaper <?php
    $img_id = get_post_thumbnail_id($post->ID);
    $image = wp_get_attachment_image_src($img_id, $optional_size);
    ?>
<?php echo 'Res: ' . ($image[1]) . 'x' . ($image[1]); ?>, Added on <?php echo get_the_date("F d Y" ,time()); ?>, Tagged : <?php $posttags = get_the_tags(); if ($posttags) { foreach($posttags as $tag) { echo '#' . $tag->name . ' '; }}?>at <?php bloginfo('name'); ?>" />
<?php } ?>
<?php if ( is_home() ) { ?><meta name='robots' content='index,follow' /><?php } ?>
<?php if(is_home()) {
    echo '<title>';
    if ( $paged < 2 ) {
    } else {
        echo 'Page ' . ($paged) . ' › ' ;
    }
    echo 'Download Wallpapers, HD Wallpapers, Pictures, Widescreen Wallpaper, Images, Photos for Desktop Background, Laptop or Gadget | walluHD.com</title>';
}
?>
<?php if(is_home()) {
    echo '<meta name="description" content="';
    if ( $paged < 2 ) {
    } else {
        echo 'Page ' . ($paged) . ' › Post: '.ucwords(substr($post->post_title,0,100)).' #'.$post->ID.' Wallpaper ' ;
    }
    echo 'Download Wallpapers, HD Wallpapers, Pictures, Widescreen Wallpaper, Images, Photos for Desktop Background, Laptop or Gadget on walluHD.com"/>';
}
?>
<?php if ( is_category() ) { ?>
    <meta name='robots' content='index,follow' />
    <title>Category: <?php echo wp_title('',true,'right' );?>›› Page <?php echo $paged ?> | <?php bloginfo('name'); ?></title>
    <meta name="description" content="Page <?php echo $paged ?> ›› Category:<?php wp_title($ID); ?>, Post: <?php echo ucwords(substr($post->post_title,0,100)).' #'.$post->ID.''; ?> end more at <?php bloginfo('name'); ?>."/>
<?php } ?>
<?php if ( is_tag() ) { ?>
    <meta name='robots' content='index,follow' />
    <title><?php echo wp_title('',true,'right');?>hd wallpapers ›› Page <?php echo $paged ?> | <?php bloginfo('name'); ?></title>
    <meta name="description" content="Page <?php echo $paged ?> ›› Tagged:<?php wp_title($ID); ?> hd wallpapers, Post: <?php echo ucwords(substr($post->post_title,0,100)).' #'.$post->ID.''; ?> end more at <?php bloginfo('name'); ?>."/>
<?php } ?>
<?php if (is_page()) { ?>
    <meta name='robots' content='noindex,follow' />
    <title><?php echo (substr($post->post_title,0,100)).''.$data[0]; ?> at <?php bloginfo('name'); ?></title>
    <meta name="description" content="Pages of <?php echo (substr($post->post_title,0,100)).''.$data[0]; ?> at <?php bloginfo('name'); ?>"/>
<?php } ?>
<?php if (is_search()) { ?>
    <meta name='robots' content='noindex,follow' />
    <title>Result for <?php ucwords(the_search_query()); ?> at <?php bloginfo('name'); ?></title>
    <meta name="description" content="Search result for <?php ucwords(the_search_query()); ?> at <?php bloginfo('name'); ?>."/>
<?php } ?>
<?php if (is_author()) { ?>
    <meta name='robots' content='noindex,follow' />
<?php } ?>
<?php if (is_404()) { ?>
    <meta name='robots' content='noindex,follow' />
<?php } ?>
