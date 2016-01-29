<SCRIPT TYPE="text/javascript">function clickIE() {if (document.all) {(message);return false;}}function clickNS(e) {if(document.layers||(document.getElementById&&!document.all)) {if (e.which==2||e.which==3) {(message);return false;}}}if (document.layers){document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}document.oncontextmenu=new Function("return false")</SCRIPT>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <?php include (TEMPLATEPATH . '/meta.php'); ?>
    <meta name="keywords" content="high, resolution, wallpaper, wallpapers, desktop, desktop, wallpapers, desktop, wallpaper, iphone, zune, hd, wide, resolution, free, free, wallpapers, wide, wallpapers, hd, wallpapers, widescreen, high, definition, fullscreen, dual, monitors, mobile" />
    <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.ico" />
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" title="no title" />
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <?php wp_head(); ?>
</head>
<body>
<div id="full_container">
    <div id="main_container">
        <div id="header">
            <div class="brand">
                <h1><a href="<?php bloginfo('url'); ?>">
                        <?php bloginfo('name');?>
                    </a></h1>
            </div>

            <ul>
                <li><a target="_blank" href="https://www.facebook.com/pages/Walluhdcom/885846381437608">Facebook</a></li>
                <li><a target="_blank" href="#">Twiiter</a></li>
                <li><a target="_blank" href="#">Google +</a></li>
            </ul>

            <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                <input type="text" value="Search" name="s" id="s" onclick="if(this.value == 'Search') this.value='';" onblur="if(this.value == '') this.value='Search';" />
            </form>
            <div class="clear"></div>
        </div><!--//header-->

        <div id="menu_container">
            <ul>
                <li><a href="<?php bloginfo('url'); ?>">Home</a></li>
                <li><a href="http://localhost/wp_test/wordpress/popular">Popular</a></li>
                <li><a href="http://localhost/wp_test/wordpress/random">Random</a></li>
                <li><a href="http://localhost/wp_test/wordpress/blog">Blog</a></li>
            </ul>

            <div class="clear"></div>
        </div>

        <div class="featured_text">
            <!-- Fitur text -->
        </div>