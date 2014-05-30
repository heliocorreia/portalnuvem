<?php

// theme setup

function my_setup() {
    remove_action('wp_head', 'wp_generator');

    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(348, 213, true);
    add_image_size('348x213', 348, 213, array('center', 'center'));

    register_nav_menu('main', 'Main Menu');
    register_nav_menu('footer', 'Footer Menu');
    register_nav_menu('social', 'Social Menu');

    register_post_type('article',
        array(
            'labels' => array(
                'name' => __('Article'),
                'singular_name' => __('Articles')
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
}
add_action('after_setup_theme', 'my_setup');

// actions
//

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
