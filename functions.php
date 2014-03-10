<?php
/**
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 */

add_filter( 'show_admin_bar', '__return_false' );
add_action( 'widgets_init', 'digitalsignageual_widgets_init' );
add_action( 'after_setup_theme', 'digitalsignageual_setup');
add_filter( 'the_content', 'digitalsignageual_unautop', 30 );
add_action( 'admin_menu', 'digitalsignageual_remove_meta_boxes' );
add_action( 'admin_init', 'digitalsignageual_remove_all_media_buttons');
add_filter( 'get_image_tag_class', 'digitalsignageual_image_tag_class', 0, 4);
add_filter( 'get_image_tag', 'digitalsignageual_image_tag', 0, 4);
add_action( 'admin_menu', 'digitalsignageual_add_boxes');
add_action( 'pre_post_update', 'digitalsignageual_save_data');
add_filter( 'widget_text','digitalsignageual_execute_php',100);

function digitalsignageual_setup() {
    // Add post thumbnail supports. http://codex.wordpress.org/Post_Thumbnails
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(400, 400, true);
}
// Clean the output of attributes of images in editor. Courtesy of SitePoint. http://www.sitepoint.com/wordpress-change-img-tag-html/
function digitalsignageual_image_tag_class($class, $id, $align, $size) {
    $align = 'align' . esc_attr($align);
    return $align;
}

// img unautop, Courtesy of Interconnectit http://interconnectit.com/2175/how-to-remove-p-tags-from-images-in-wordpress/
function digitalsignageual_unautop($pee) {
    $pee = preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '<figure>$1</figure>', $pee);
    return $pee;
}

function digitalsignageual_image_tag($html, $id, $alt, $title) {
    return preg_replace(array(
            '/\s+width="\d+"/i',
            '/\s+height="\d+"/i',
            '/alt=""/i'
    ),
            array(
                    '',
                    '',
                    '',
                    'alt="' . $title . '"'
            ),
            $html);
}

// create metabox
$prefix = '_digitalsign_';

$meta_box_post = array(
        'id' => 'panel_details',
        'title' => 'Digital Signage Panel Options',
        'page' => 'post',
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
                array(
                        'name' => 'Subtitle',
                        'id' => $prefix . 'subtitle',
                        'type' => 'text',
                        'std'  => '',
                        'size' => '50'
                ),
                array(
                        'name' =>'Link',
                        'id' => $prefix . 'link',
                        'type' => 'text',
                        'size' => '50'
                ),
                array(
                        'name' => 'Background colour',
                        'id' => $prefix . 'background',
                        'type' => 'select',
                        'options' => array('none', 'black', 'blue', 'gray', 'green', 'orange', 'pink', 'purple', 'teal', 'red')
                )
        )
);

$categories = get_categories();
$cathash = array();
foreach ($categories as $cat) {
    $cathash[$cat->cat_ID] = $cat->name . ' (' . $cat->category_count . ' post' . ($cat->category_count > 1? 's' : '') . ')';
}

$meta_box_page = array(
        'id' => 'panel_details',
        'title' => 'Digital Signage Display Setup',
        'page' => 'page',
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
                array(
                        'name' => 'Category of Posts to display',
                        'id' => $prefix . 'category',
                        'type' => 'select',
                        'options' => $cathash
                ),
                array(
                        'name' => 'College Branding',
                        'id' => $prefix . 'collegename',
                        'type' => 'select',
                        'options' => array('lcf', 'lcc', 'csm', 'csm', 'chelsea', 'camberwell', 'wimbledon', 'none')
                ),
                array(
                        'name' => 'Side-bar / Timetable',
                        'id' => $prefix . 'displaySidebar',
                        'type' => 'select',
                        'options' => array('on', 'off')
                ),
                array(
                        'name' => 'Seconds between transitions',
                        'id' => $prefix . 'seconds',
                        'type' => 'text',
                        'std'  => '12',
                        'desc' => '',
                        'size' => '4'
                ),
                array(
                        'name' => 'Transition',
                        'id' => $prefix . 'transition',
                        'type' => 'select',
                        'options' => array('fade'=>'fade', 'horizontal-slide'=>'horizontal-slide', 'vertical-slide'=>'vertical-slide')
                )
        )
);

function digitalsignageual_add_boxes() {
    global $meta_box_post, $meta_box_page;
    //posts - panel options
    add_meta_box($meta_box_post['id'], $meta_box_post['title'], 'digitalsign_show_box', $meta_box_post['page'], $meta_box_post['context'], $meta_box_post['priority']);
    //pages - category and slider options
    add_meta_box($meta_box_page['id'], $meta_box_page['title'], 'digitalsign_show_box', $meta_box_page['page'], $meta_box_page['context'], $meta_box_page['priority']);
}

// Callback function to show fields in meta box
function digitalsign_show_box() {
    global $meta_box_post, $meta_box_page, $post, $prefix;

    $meta_box = $post->post_type == 'post'? $meta_box_post : $meta_box_page;

    // Use nonce for verification
    echo '<input type="hidden" name="digitalsignageual_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    echo '<table class="form-table">';

    foreach ($meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);

        echo '<tr>',
        '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
        '<td>';
        switch ($field['type']) {
            case 'text':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="', $field['size'], '" />', '<br />', $field['desc'];
                break;
            case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>', '<br />', $field['desc'];
                break;
            case 'select':
                echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                if ($field['id'] == $prefix .'category') {
                    foreach ($field['options'] as $catid => $catoption) {
                        echo '<option value="', $catid, '"',  $meta == $catid ? ' selected="selected"' : '', '>', $catoption, '</option>';
                    }
                } else {
                    foreach ($field['options'] as $option) {
                        echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                    }
                }
                echo '</select>';
                break;
            case 'radio':
                foreach ($field['options'] as $option) {
                    echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                }
                break;
            case 'checkbox':
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                break;
        }
        echo     '<td>',
        '</tr>';
    }
    echo '</table>';
}

// Save data from meta box
function digitalsignageual_save_data($post_id) {
    global $meta_box_post, $meta_box_page;

    // verify nonce
    if (!wp_verify_nonce($_POST['digitalsignageual_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }

        digitalsignageual_update_save_data($meta_box_page, $post_id);
        return $post_id;

    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    digitalsignageual_update_save_data($meta_box_post, $post_id);
}

function digitalsignageual_update_save_data($box, $post_id) {
    foreach ($box['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}

/* Hide some extra meta boxes from the Post admin page */
function digitalsignageual_remove_meta_boxes() {
    remove_meta_box('postcustom', 'post', 'core');
    remove_meta_box('commentsdiv', 'post', 'core');
    remove_meta_box('slugdiv', 'post', 'core');
    remove_meta_box('revisionsdiv', 'post', 'core');
    remove_meta_box('commentstatusdiv', 'post', 'core');
    remove_meta_box('postcustom', 'post', 'core');
    remove_meta_box('postexcerpt', 'post', 'core');
    remove_meta_box('trackbacksdiv', 'post', 'core');
    remove_meta_box('postexcerpt', 'post', 'core');
    remove_meta_box('formatdiv', 'post', 'core');
    remove_meta_box('pageparentdiv', 'post', 'core');
    remove_meta_box('authordiv', 'post', 'core');
}

function digitalsignageual_remove_all_media_buttons() {
    remove_all_actions('media_buttons');
}

function digitalsignageual_widgets_init() {
    // Area 1, located at the top of the sidebar.
    register_sidebar( array(
            'name' => __( 'Primary Widget Area', 'digitalsignageual' ),
            'id' => 'primary-widget-area',
            'description' => __( 'Add widgets here to appear in your sidebar.', 'digitalsignageual' ),
            'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
    ) );

    register_sidebar(array('name'=> __( 'Footer Widget Area', 'digitalsignageual' ),
            'id' => 'footer-widget-area',
            'before_widget' => '<article id="%1$s clock" class="two columns widget %2$s"><div class="footer-section">',
            'after_widget' => '</div></article>',
            'before_title' => '<h6>',
            'after_title' => '</h6>'
    ));
}
/* Allow PHP in Widgets
 Thanks @triqui
http://www.emanueleferonato.com/2011/04/11/executing-php-inside-a-wordpress-widget-without-any-plugin/
----*/
function digitalsignageual_execute_php($html){
    if(strpos($html,"<"."?php")!==false){
        ob_start();
        eval("?".">".$html);
        $html=ob_get_contents();
        ob_end_clean();
    }
    return $html;
}
?>
