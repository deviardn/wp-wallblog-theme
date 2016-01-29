<?php

$themename = "WallSimpleSetting";
$shortname = "wallsimplesetting";
$settings_list = array(
    'custom_logo_url',
    'custom_background_color',
    'featured_text',
    'header_background_image',
    'header_background_repeat',
    'header_background_vertical',
    'header_background_horizontal'
);


/*function add_homestead_scripts() {
//  wp_enqueue_script('homestead-settings1', WP_CONTENT_URL.'/themes/homestead/jquery.js');
  
  wp_enqueue_script('homestead-settings2', WP_CONTENT_URL.'/themes/homestead/jquery-1.4.2.min.js');
  wp_enqueue_script('homestead-settings3', WP_CONTENT_URL.'/themes/homestead/jpicker-1.1.3.min.js');
  
  //wp_enqueue_script('homestead-settings1', WP_CONTENT_URL.'/themes/homestead/css/colorpicker.css');
}*/


function mytheme_add_admin() {

    global $themename, $shortname, $settings_list;

    if ( $_GET['page'] == basename(__FILE__) ) {

        if ( 'save' == $_REQUEST['action'] ) {

            foreach($settings_list as $value) {
                //echo '<script type="text/javascript">alert("' . $value . '");</script>';
                //if($_REQUEST[$value] != "")
                //update_option($shortname . '_' . $value,$_REQUEST[$value]);
                update_option($shortname . '_' . $value,mysql_real_escape_string($_REQUEST[$value]));
            }

            header("Location: themes.php?page=settings.php&saved=true");
            die;

        }
    }
    add_theme_page($themename." Settings", $themename." Settings", 'edit_themes', basename(__FILE__), 'mytheme_admin');


}

function mytheme_admin() {

    global $themename, $shortname, $settings_list;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';

    ?>
    <style type="text/css">

        table { border: none; }
        td { padding: 5px; }
        .ss_text { width: 350px; }

    </style>



    <div class="wrap">
    <h2><?php echo $themename; ?> Theme Options</h2>

    <form method="post">

        <table>
            <tr>
                <td>Custom logo URL:</td>
                <td><input type="text" name="custom_logo_url" class="ss_text" value="<?php echo stripslashes(stripslashes(get_option($shortname.'_custom_logo_url',''))); ?>" /><br /><small><a href="<?php bloginfo('url'); ?>/wp-admin/media-new.php" target="_blank">Upload your logo</a> (360px wide x 102px high)</small></td>
            </tr>
            <tr>
                <td>Custom background color:</td>
                <td><input type="text" name="custom_background_color" class="ss_text" value="<?php echo stripslashes(stripslashes(get_option($shortname.'_custom_background_color',''))); ?>" /> <small>e.g.: #27292a</small></td>
            </tr>
            <tr>
                <td>Featured text:</td>
                <td><input type="text" name="featured_text" class="ss_text" value="<?php echo stripslashes(stripslashes(get_option($shortname.'_featured_text',''))); ?>" /></td>
            </tr>
        </table>

        <h3>Background Image</h3>
        <table>
            <tr>
                <td colspan="3">Image URL: <input type="text" class="backimage_text" name="header_background_image" value="<?php echo stripslashes(stripslashes(get_option($shortname.'_header_background_image',''))); ?>" /> <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small><a href="<?php bloginfo('url'); ?>/wp-admin/media-new.php" target="_blank">Upload your background</a></small></td>
            </tr>
            <tr>
                <td>Repeat: <select name="header_background_repeat"><option value="no-repeat" <?php if(get_option($shortname.'_header_background_repeat','') == "no-repeat") echo "SELECTED"; ?>>No Repeat</option>
                        <option value="repeat-x" <?php if(get_option($shortname.'_header_background_repeat','') == "repeat-x") echo "SELECTED"; ?>>Repeat Horizontally</option>
                        <option value="repeat-y" <?php if(get_option($shortname.'_header_background_repeat','') == "repeat-y") echo "SELECTED"; ?>>Repeat Vertically</option>
                        <option value="repeat" <?php if(get_option($shortname.'_header_background_repeat','') == "repeat") echo "SELECTED"; ?>>Repeat Vertically/Horizontally</option>
                    </select>
                </td>
                <td>Vertical: <select name="header_background_vertical"><option value="center" <?php if(get_option($shortname.'_header_background_vertical','') == "center") echo "SELECTED"; ?>>center</option>
                        <option value="top" <?php if(get_option($shortname.'_header_background_vertical','') == "top") echo "SELECTED"; ?>>top</option>
                        <option value="bottom" <?php if(get_option($shortname.'_header_background_vertical','') == "bottom") echo "SELECTED"; ?>>bottom</option>
                    </select>
                </td>
                <td>Horizontal: <select name="header_background_horizontal"><option value="center" <?php if(get_option($shortname.'_header_background_horizontal','') == "center") echo "SELECTED"; ?>>center</option>
                        <option value="left" <?php if(get_option($shortname.'_header_background_horizontal','') == "left") echo "SELECTED"; ?>>left</option>
                        <option value="right" <?php if(get_option($shortname.'_header_background_horizontal','') == "right") echo "SELECTED"; ?>>right</option>
                    </select>
                </td>
            </tr>
        </table>

        <p class="submit">
            <input name="save" type="submit" value="Save changes" />
            <input type="hidden" name="action" value="save" />
        </p>
    </form>
<?php
}
add_action('admin_menu', 'mytheme_add_admin');
?>