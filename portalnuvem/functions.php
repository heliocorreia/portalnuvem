<?php

// theme setup

$post_thumbnails_with_captions = [
    '477x558'
];

function my_setup() {
    remove_action('wp_head', 'wp_generator');

    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(348, 213, true);
    add_image_size('348x213', 348, 213, array('center', 'center'));
    add_image_size('477x558', 477, 558, array('center', 'center'));

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

// filters

function my_wp_nav_menu_objects($items) {
	$parents = array();
	foreach ($items as $item) {
		if ($item->menu_item_parent && $item->menu_item_parent > 0) {
			$parents[] = $item->menu_item_parent;
		}
	}
	foreach ($items as $item) {
		$item->classes[] = 'slug-' . sanitize_title($item->title);
		if (in_array($item->ID, $parents)) {
			$item->classes[] = 'menu-has-submenu';
		}
	}
	return $items;
}
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects');

// shortcodes
//

// meta boxes

function my_register_artist_metabox($post) {
    add_meta_box('my_mb_artist', 'Informações Adicionais', 'my_metabox_artist', 'artist', 'normal', 'high');
}

function my_metabox_artist($post) {
    wp_nonce_field('my_metabox_artist', 'my_metabox_artist_nonce');

    $locale = get_post_meta($post->ID, '_artist_locale', true);
    echo '<p><label for="my_artist_locale">Localidade:</label> ';
    echo '<input type="text" id="my_artist_locale" name="my_artist_locale" value="' . esc_attr($locale) . '" size="25" /></p>';

    $aside = get_post_meta($post->ID, '_artist_aside', true);
    wp_editor($aside, 'my_artist_aside', array(
        'media_buttons' => false,
    ));
}

function my_metabox_data_precheck($nonce_action, $nonce_value) {
    // if this is an autosave, our form has not been submitted, so we don't want to do anything.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // check the user's permissions.
    if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    if (!isset($nonce_value)) {
        return;
    }

    if (!wp_verify_nonce($nonce_value, $nonce_action)) {
        return;
    }

    return true;
}

function my_save_metabox_data($post_id) {
    if (!my_metabox_data_precheck($_POST['my_metabox_artist_nonce'], 'my_metabox_artist')) {
        return;
    }

    // artist locale
    if (isset($_POST['my_artist_locale'])) {
        $data = sanitize_text_field($_POST['my_artist_locale']);
        update_post_meta($post_id, '_artist_locale', $data);
    }

    // artist aside
    if (isset($_POST['my_artist_aside'])) {
        update_post_meta($post_id, '_artist_aside', $_POST['my_artist_aside']);
    }
}
add_action('save_post', 'my_save_metabox_data');
