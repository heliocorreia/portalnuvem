<?php

$post_thumbnails_with_captions = Array('477x558', '400x468');

function my_setup() {
    remove_action('wp_head', 'wp_generator');

    add_theme_support('html5');
    add_theme_support('post-thumbnails');

    set_post_thumbnail_size(348, 213, true);

    add_image_size('348x213', 348, 213, array('center', 'center'));
    add_image_size('400x468', 400, 468, array('center', 'center'));
    add_image_size('477x558', 477, 558, array('center', 'center'));
    add_image_size('800x0', 800, 0, array('center', 'center'));

    add_image_size('home-headlines-350x600', 350, 600, array('center', 'center'));
    add_image_size('home-news-348x213', 348, 213, array('center', 'center'));
    add_image_size('artist-attachment-282x322', 282, 322, array('center', 'center'));
    add_image_size('quemsomos-attachment-298x298', 298, 298, array('center', 'center'));

    register_nav_menu('main', 'Main Menu');
    register_nav_menu('footer', 'Footer Menu');
    register_nav_menu('social', 'Social Menu');

    register_post_type('article',
        array(
            'labels' => array(
                'name' => __('Articles'),
                'singular_name' => __('Article')
            ),
            'public' => true,
            'has_archive' => true,
            'menu_position' => 5,
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'author',
            ),
        )
    );
    register_post_type('event',
        array(
            'labels' => array(
                'name' => __('Events'),
                'singular_name' => __('Event')
            ),
            'public' => true,
            'has_archive' => true,
            'menu_position' => 5,
            'supports' => array(
                'title',
                'excerpt',
                'thumbnail',
            ),
            'register_meta_box_cb' => 'my_register_event_metabox',
        )
    );
    register_post_type('artist',
        array(
            'labels' => array(
                'name' => __('Artists'),
                'singular_name' => __('Artist')
            ),
            'public' => true,
            'has_archive' => true,
            'menu_position' => 5,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
            ),
            'register_meta_box_cb' => 'my_register_artist_metabox',
        )
    );
}
add_action('after_setup_theme', 'my_setup');

// actions

function my_post_thumbnail_html($html, $post_id, $post_thumbnail_id, $size, $attr) {
    global $post_thumbnails_with_captions;
    if (!in_array($size, $post_thumbnails_with_captions)) {
        return $html;
    }

    $attachment =& get_post($post_thumbnail_id);

    $width = ($size = wp_get_attachment_image_src($attachment->ID, $size))
        ? $size[1]
        : 0;

    $html = img_caption_shortcode(array(
        'caption' => trim("$attachment->post_excerpt $attachment->post_content" ),
        'width'   => $width,
    ), $html);

    return $html;
}
add_action('post_thumbnail_html', 'my_post_thumbnail_html', 10, 5);

function my_edit_user_profile($user) { ?>
    <h3><?php _e('Redes Sociais'); ?></h3>
    <table class="form-table">
    <?php foreach(array('facebook', 'twitter', 'instagram') as $social): ?>
    <tr>
        <th>
            <label for="<?php echo $social ?>"><?php echo ucfirst($social) ?></label>
        </th>
        <td>
            <input type="text" name="<?php echo $social ?>" id="<?php echo $social ?>" value="<?php echo esc_attr(get_the_author_meta($social, $user->ID)); ?>" class="regular-text" /><br />
        </td>
    </tr>
    <?php endforeach ?>
    </table>
    <h3><?php _e('Fotografia (largura x altura)'); ?></h3>
    <table class="form-table">
    <tr>
        <th>
            <label for="photo284x284">284x284</label>
        </th>
        <td>
            <?php $photo = ''; if ($photo = get_the_author_meta('photo284x284', $user->ID)): ?>
            <p><img src="<?php echo esc_attr($photo); ?>" width="284" height="284" /></p>
            <?php endif; ?>
            <input type="text" name="photo284x284" id="photo284x284" value="<?php echo esc_attr($photo); ?>" class="regular-text" /><br />
        </td>
    </tr>
    </table>
<?php }
add_action('show_user_profile', 'my_edit_user_profile');
add_action('edit_user_profile', 'my_edit_user_profile');

function my_user_profile_update($user_id) {
    if (!current_user_can('edit_user', $user_id ))
        return false;

    foreach(array('facebook', 'twitter', 'instagram', 'photo284x284') as $field) {
        update_usermeta($user_id, $field, $_POST[$field]);
    }
}
add_action('personal_options_update', 'my_user_profile_update');
add_action('edit_user_profile_update', 'my_user_profile_update');
