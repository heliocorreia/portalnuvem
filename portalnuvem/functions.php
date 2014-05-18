<?php

// theme setup

function my_setup() {
    remove_action('wp_head', 'wp_generator');

    register_nav_menu('main', 'Main Menu');
    register_nav_menu('footer', 'Footer Menu');
    register_nav_menu('social', 'Social Menu');
}
add_action('after_setup_theme', 'my_setup');

// actions
//

// filters
//

// shortcodes
//
