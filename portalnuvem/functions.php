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
