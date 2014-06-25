<?php

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


function my_image_size_names_choose($sizes) {
    return array_merge($sizes, array(
        '800x0' => __("Artigo")
    ));
}
add_filter('image_size_names_choose', 'my_image_size_names_choose');
