<?php

include('settings.php');

if (function_exists('add_theme_support')) {
    add_theme_support('menus');
}

if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
    add_theme_support( 'post-thumbnails' );

    /*
    Default featured-home : 498,285
    */
    add_image_size('sidebar-blog',192,130,true);
    add_image_size('featured-home',187,130,true);
    add_image_size('featured-blog',687,331,true);

    /*
    Defautl Featured-sidebar : 268,153
    */
    add_image_size('featured-sidebar',268,153,true);
}



function get_category_id($cat_name){
    $term = get_term_by('name', $cat_name, 'category');
    return $term->term_id;
}

function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];

    if(empty($first_img)){ //Defines a default image
        $first_img = "/images/post_default.png";
    }
    return $first_img;
}

// WP-PageNavi//
function custom_wp_pagenavi($before = '', $after = '', $prelabel = '', $nxtlabel = '', $pages_to_show = 6, $always_show = falses) {
    global $request, $posts_per_page, $wpdb, $paged;
    if(empty($prelabel)) {
        $prelabel  = '<strong>&laquo;</strong>';
    }
    if(empty($nxtlabel)) {
        $nxtlabel = '<strong>&raquo;</strong>';
    }
    $half_pages_to_show = round($pages_to_show/2);
    if (!is_single()) {
        if(!is_category()) {
            preg_match('#FROM\s(.*)\sORDER BY#siU', $request, $matches);
        } else {
            preg_match('#FROM\s(.*)\sGROUP BY#siU', $request, $matches);
        }
        $fromwhere = $matches[1];
        $numposts = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $fromwhere");
        $max_page = ceil($numposts /$posts_per_page);
        if(empty($paged)) {
            $paged = 1;
        }
        if($max_page > 1 || $always_show) {
            echo "$before <div class=\"wp-pagenavi\"><span class=\"pages\">Page $paged of $max_page:</span>";
            if ($paged >= ($pages_to_show-1)) {
                echo '<a href="'.get_pagenum_link().'">&laquo; First</a>&nbsp;';
            }
            previous_posts_link($prelabel);
            for($i = $paged - $half_pages_to_show; $i  <= $paged + $half_pages_to_show; $i++) {
                if ($i >= 1 && $i <= $max_page) {
                    if($i == $paged) {
                        echo "<strong class='current'>$i</strong>";
                    } else {
                        echo ' <a href="'.get_pagenum_link($i).'">'.$i.'</a> ';
                    }
                }
            }
            next_posts_link($nxtlabel, $max_page);
            if (($paged+$half_pages_to_show) < ($max_page)) {
                echo '&nbsp;<a href="'.get_pagenum_link($max_page).'">Last &raquo;</a>';
            }
            echo "</div> $after";
        }
    }
}


function custom_wp_pagenavi_home($before = '',  $after = '', $prelabel = '', $nxtlabel = '', $pages_to_show = 6, $always_show = false ) {
    global $request, $posts_per_page, $wpdb, $paged;
    $category = get_category(993);
    $count = $category->category_count;

    if(empty($prelabel)) {
        $prelabel  = '<strong>&laquo;</strong>';
    }


    if(empty($nxtlabel)) {
        $nxtlabel = '<strong>&raquo;</strong>';
    }


    $half_pages_to_show = round($pages_to_show/2);

    if (!is_single()) {

        if(!is_category()) {
            preg_match('#FROM\s(.*)\sORDER BY#siU', $request, $matches);
        } else {
            preg_match('#FROM\s(.*)\sGROUP BY#siU', $request, $matches);
        }


        $fromwhere = $matches[1];
        $numposts = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $fromwhere");
        $max_page = ceil(($numposts - $count) / $posts_per_page);

        if(empty($paged)) {
            $paged = 1;
        }


        if($max_page > 1 || $always_show) {
            echo "$before <div class=\"wp-pagenavi\"><span class=\"pages\">Page $paged of $max_page:</span>";

            if ($paged >= ($pages_to_show-1)) {
                echo '<a href="'.get_pagenum_link().'">&laquo; First</a>&nbsp;';
            }

            previous_posts_link($prelabel);

            for($i = $paged - $half_pages_to_show; $i  <= $paged + $half_pages_to_show; $i++) {

                if ($i >= 1 && $i <= $max_page) {
                    if($i == $paged) {
                        echo "<strong class='current'>$i</strong>";
                    } else {
                        echo ' <a href="'.get_pagenum_link($i).'">'.$i.'</a> ';
                    }
                }

            }


            next_posts_link($nxtlabel, $max_page);
            if (($paged+$half_pages_to_show) < ($max_page)) {
                echo '&nbsp;<a href="'.get_pagenum_link($max_page).'">Last &raquo;</a>';
            }
            echo "</div> $after";
        }
    }
}

//breadcrumbs
function breadcrumbs() {

    $delimiter = '&raquo;';
    $name = 'Home';
    $currentBefore = '<span class="current1">';
    $currentAfter = '</span>';

    if ( !is_home() && !is_front_page() || is_paged() ) {

        echo '<div id="crumbs">';

        global $post;
        $home = get_bloginfo('url');
        echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';

        if ( is_category() ) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
            echo $currentBefore . '';
            single_cat_title();
            echo '' . $currentAfter;

        } elseif ( is_day() ) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
            echo $currentBefore . get_the_time('d') . $currentAfter;

        } elseif ( is_month() ) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo $currentBefore . get_the_time('F') . $currentAfter;

        } elseif ( is_year() ) {
            echo $currentBefore . get_the_time('Y') . $currentAfter;

        } elseif ( is_single() && !is_attachment() ) {
            $cat = get_the_category(); $cat = $cat[0];
            echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo $currentBefore;
            the_title();
            echo $currentAfter;

        } elseif ( is_attachment() ) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
            echo $currentBefore;
            the_title();
            echo $currentAfter;

        } elseif ( is_page() && !$post->post_parent ) {
            echo $currentBefore;
            the_title();
            echo $currentAfter;

        } elseif ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
            echo $currentBefore;
            the_title();
            echo $currentAfter;

        } elseif ( is_search() ) {
            echo $currentBefore . '' . get_search_query() . '' . $currentAfter;

        } elseif ( is_tag() ) {
            echo $currentBefore . 'Posts tagged &#39;';
            single_tag_title();
            echo '&#39;' . $currentAfter;

        } elseif ( is_author() ) {
            global $author;
            $userdata = get_userdata($author);
            echo $currentBefore . 'Articles posted by ' . $userdata->display_name . $currentAfter;

        } elseif ( is_404() ) {
            echo $currentBefore . 'Error 404' . $currentAfter;
        }

        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
            echo __(' page') . ' ' . get_query_var('paged');
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }

        echo '</div>';

    }
}



//post view
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return ''.$count;
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


//filesizes
function attfilesize() {
    global $post;
    $attachments = get_children(array('post_parent'=>$post->ID));
    $nbImg = count($attachments);
    if ( $images = get_children(array(
        'post_parent' => $post->ID,
        'post_type' => 'attachment',
        'numberposts' => 1,
        'post_mime_type' => 'image',)))
    {
        foreach( $images as $image ) {
            $myfile = filesize( get_attached_file( $image->ID ) );
            $docsize = size_format($myfile);
            echo $docsize;
        }
    } else {
        echo "Unknown Size";
    }
}

// **** SIZESDOWNLOAD ****
function my_get_image_size_links() {

    /* If not viewing an image attachment page, return. */
    if ( !wp_attachment_is_image( get_the_ID() ) )
        return;

    /* Set up an empty array for the links. */
    $links = array();

    /* Get the intermediate image sizes and add the full size to the array. */
    $sizes = get_intermediate_image_sizes();
    $sizes[] = 'full';

    /* Loop through each of the image sizes. */
    foreach ( $sizes as $size ) {

        /* Get the image source, width, height, and whether it's intermediate. */
        $image = wp_get_attachment_image_src( get_the_ID(), $size );

        /* Add the link to the array if there's an image and if $is_intermediate (4th array value) is true or full size. */
        if ( !empty( $image ) && ( true == $image[3] || 'full' == $size ) )
            $links[] = "<a class='image-size-link' href='{$image[0]}'>{$image[1]} &times; {$image[2]}</a>";
    }

    /* Join the links in a string and return. */
    return join( ' <span class="sep">/</span> ', $links );

}

/* Page Random Post
add_action('init','random_add_rewrite');
function random_add_rewrite() {
    global $wp;
    $wp->add_query_var('random');
    add_rewrite_rule('random/?$', 'index.php?random=1', 'top');
}

add_action('template_redirect','random_template');
function random_template() {
    if (get_query_var('random') == 1) {
        $posts = get_posts('post_type=post&orderby=rand&numberposts=1');
        foreach($posts as $post) {
            $link = get_permalink($post);
        }
        wp_redirect($link,307);
        exit;
    }
}
*/
// **** EX SOCIAL START ****

/*
class ex_social extends WP_Widget {

	function ex_social() {
		parent::WP_Widget(false, 'Photographer Social');
	}

	function widget($args, $instance) {
                $args['social_title'] = $instance['social_title'];
		$args['dribbble_link'] = $instance['dribbble_link'];
                $args['forrst_link'] = $instance['forrst_link'];
                $args['facebook_link'] = $instance['facebook_link'];
                $args['twitter_link'] = $instance['twitter_link'];
                $args['tumblr_link'] = $instance['tumblr_link'];
		ex_func_social($args);
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function form($instance) {
                $social_title = esc_attr($instance['social_title']);
		$dribbble_link = esc_attr($instance['dribbble_link']);
                $forrst_link = esc_attr($instance['forrst_link']);
                $facebook_link = esc_attr($instance['facebook_link']);
                $twitter_link = esc_attr($instance['twitter_link']);
                $tumblr_link = esc_attr($instance['tumblr_link']);
?>
                <p><label for="<?php echo $this->get_field_id('social_title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('social_title'); ?>" name="<?php echo $this->get_field_name('social_title'); ?>" type="text" value="<?php echo $social_title; ?>" /></label></p>

                <p><label for="<?php echo $this->get_field_id('facebook_link'); ?>"><?php _e('Facebook Link:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('facebook_link'); ?>" name="<?php echo $this->get_field_name('facebook_link'); ?>" type="text" value="<?php echo $facebook_link; ?>" /></label></p>

                <p><label for="<?php echo $this->get_field_id('twitter_link'); ?>"><?php _e('Twitter Link:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('twitter_link'); ?>" name="<?php echo $this->get_field_name('twitter_link'); ?>" type="text" value="<?php echo $twitter_link; ?>" /></label></p>

                <p><label for="<?php echo $this->get_field_id('tumblr_link'); ?>"><?php _e('Tumblr Link:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('tumblr_link'); ?>" name="<?php echo $this->get_field_name('tumblr_link'); ?>" type="text" value="<?php echo $tumblr_link; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id('dribbble_link'); ?>"><?php _e('Dribbble Link:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('dribbble_link'); ?>" name="<?php echo $this->get_field_name('dribbble_link'); ?>" type="text" value="<?php echo $dribbble_link; ?>" /></label></p>

                <p><label for="<?php echo $this->get_field_id('forrst_link'); ?>"><?php _e('Forrst Link:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('forrst_link'); ?>" name="<?php echo $this->get_field_name('forrst_link'); ?>" type="text" value="<?php echo $forrst_link; ?>" /></label></p>

<?php
	}
 }
function ex_func_social($args = array(), $displayComments = TRUE, $interval = '') {

	global $wpdb;

        //echo $args['before_widget'] . $args['before_title'] . $args['title'] . $args['after_title'];
        echo $args['before_widget'] . $args['before_title'] . $args['social_title'] . $args['after_title'];
        ?>
        <ul class="stay_connected_list">
          <?php if($args['facebook_link'] != '') { ?>
              <li><a href="<?php echo $args['facebook_link']; ?>">Facebook</a></li>
          <?php } ?>

          <?php if($args['twitter_link'] != '') { ?>
              <li><a href="<?php echo $args['twitter_link']; ?>">Twitter</a></li>
          <?php } ?>

          <?php if($args['tumblr_link'] != '') { ?>
            <li class="last"><a href="<?php echo $args['tumblr_link']; ?>">Tumblr</a></li>
          <?php } ?>

          <?php if($args['dribbble_link'] != '') { ?>
              <li><a href="<?php echo $args['dribbble_link']; ?>">Dribbble</a></li>
          <?php } ?>

          <?php if($args['forrst_link'] != '') { ?>
              <li><a href="<?php echo $args['forrst_link']; ?>">Forrst</a></li>
          <?php } ?>
        </ul>
        <?php

        echo $args['after_widget'];

}
register_widget('ex_social');

// **** EX SOCIAL END ****


// **** EX BLOG START ****

class ex_blog extends WP_Widget {

	function ex_blog() {
		parent::WP_Widget(false, 'Photographer Blog');
	}

	function widget($args, $instance) {
                $args['blog_title'] = $instance['blog_title'];
		ex_func_blog($args);
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function form($instance) {
                $blog_title = esc_attr($instance['blog_title']);
?>
                <p><label for="<?php echo $this->get_field_id('blog_title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('blog_title'); ?>" name="<?php echo $this->get_field_name('blog_title'); ?>" type="text" value="<?php echo $blog_title; ?>" /></label></p>

<?php
	}
 }
function ex_func_blog($args = array(), $displayComments = TRUE, $interval = '') {

	global $wpdb;

        //echo $args['before_widget'] . $args['before_title'] . $args['title'] . $args['after_title'];
        echo $args['before_widget'] . $args['before_title'] . $args['blog_title'] . $args['after_title'];
        ?>
        <ul>

      <?php
      $args = array(
                   'category_name' => 'blog',
                   'post_type' => 'post',
                   'posts_per_page' => 4
                   );
      query_posts($args);
      while (have_posts()) : the_post(); ?>
          <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
      <?php endwhile; ?>
      <?php wp_reset_query(); ?>

        </ul>
        <?php

        //echo $args['after_widget'];
        echo '<div class="clear"></div></div>';

}
register_widget('ex_blog');
// **** EX BLOG END ****

*/
//featured image
function autoset_featured() {
    global $post;
    $already_has_thumb = has_post_thumbnail($post->ID);
    if (!$already_has_thumb)  {
        $attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
        if ($attached_image) {
            foreach ($attached_image as $attachment_id => $attachment) {
                set_post_thumbnail($post->ID, $attachment_id);
            }
        }
    }
}


/*
 * My Single Template
 =======================================================================================*/
/*
 * Define a constant path to our single template folder
 */
define(SINGLE_PATH, TEMPLATEPATH . '');

/*
 * Filter the single_template with our custom function
 */
add_filter('single_template', 'my_single_template');

/*
 * Single template function which will choose our template
 */
function my_single_template($single) {
    global $wp_query, $post;
    /*
     * Checks for single template by ID
     */
    if(file_exists(SINGLE_PATH . '/single-' . $post->ID . '.php'))
        return SINGLE_PATH . '/single-' . $post->ID . '.php';
    /*
     * Checks for single template by category
     * Check by category slug and ID
     */
    foreach((array)get_the_category() as $cat) :

        if(file_exists(SINGLE_PATH . '/single-cat-' . $cat->slug . '.php'))
            return SINGLE_PATH . '/single-cat-' . $cat->slug . '.php';

        elseif(file_exists(SINGLE_PATH . '/single-cat-' . $cat->term_id . '.php'))
            return SINGLE_PATH . '/single-cat-' . $cat->term_id . '.php';

    endforeach;
    /*
     * Checks for default single post files within the single folder
     */
    if(file_exists(SINGLE_PATH . '/single.php'))
        return SINGLE_PATH . '/single.php';

    elseif(file_exists(SINGLE_PATH . '/default.php'))
        return SINGLE_PATH . '/default.php';
    return $single;

}


add_action('the_post', 'autoset_featured');
add_action('save_post', 'autoset_featured');
add_action('draft_to_publish', 'autoset_featured');
add_action('new_to_publish', 'autoset_featured');
add_action('pending_to_publish', 'autoset_featured');
add_action('future_to_publish', 'autoset_featured');

?>