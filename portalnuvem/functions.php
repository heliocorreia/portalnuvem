<?php

define('NUVEM_NEWS_CATEGORY_SLUG', 'news');
define('NUVEM_ARTICLES_CATEGORY_SLUG', 'articles');

define('NUVEM_HOME_HEADLINES_SLUG', 'home-headlines');
define('NUVEM_HOME_HEADLINES_LIMIT', 5);

define('NUVEM_HOME_NEWS_SLUG', 'home-news');
define('NUVEM_HOME_NEWS_LIMIT', 3);

// options

define('NUVEM_OPTION_STICK_HOME_HIGHLIGHT2', 'nuvem_stick_home_highlight2');

// theme setup

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

function my_image_size_names_choose($sizes) {
    return array_merge($sizes, array(
        '800x0' => __("Artigo")
    ));
}
add_filter('image_size_names_choose', 'my_image_size_names_choose');

// shortcodes
//

// meta boxes

function my_register_post_metabox($post) {
    add_meta_box('my_mb_post', 'Informações Adicionais', 'my_metabox_post', 'post', 'normal', 'high');
}
add_action('add_meta_boxes', 'my_register_post_metabox');

function my_metabox_post($post) {
    wp_nonce_field('my_metabox_post', 'my_metabox_post_nonce');

    $locale = get_post_meta($post->ID, '_post_locale', true);
    echo '<p><label for="my_post_locale">Localidade:</label> ';
    echo '<input type="text" id="my_post_locale" name="my_post_locale" value="' . esc_attr($locale) . '" size="25" /></p>';
}

function my_register_artist_metabox($post) {
    add_meta_box('my_mb_artist_xtra', 'Informações Adicionais', 'my_metabox_artist_xtra', 'artist', 'normal', 'high');
    add_meta_box('my_mb_artist_home', 'Home Page', 'my_metabox_artist_home', 'artist', 'normal', 'high');
}

function my_metabox_artist_xtra($post) {
    wp_nonce_field('my_metabox_artist_xtra', 'my_metabox_artist_xtra_nonce');

    $locale = get_post_meta($post->ID, '_artist_locale', true);
    echo '<p><label for="my_artist_locale">Localidade:</label> ';
    echo '<input type="text" id="my_artist_locale" name="my_artist_locale" value="' . esc_attr($locale) . '" size="25" /></p>';

    $aside = get_post_meta($post->ID, '_artist_aside', true);
    wp_editor($aside, 'my_artist_aside', array(
        'media_buttons' => false,
    ));
}

function my_metabox_artist_home($post) {
    wp_nonce_field('my_metabox_artist_home', 'my_metabox_artist_home_nonce');

    $stick = ($post->ID === get_option(NUVEM_OPTION_STICK_HOME_HIGHLIGHT2, false));
    echo '<p><input type="checkbox" id="my_stick_home_highlight2" name="my_stick_home_highlight2" size="25" ' .($stick?'checked="checked"':''). ' value="' .$post->ID. '" /> ';
    echo '<label for="my_stick_home_highlight2">Stick</label></p>';

    $photo = get_post_meta($post->ID, '_artist_home_photo', true);
    echo '<p><label for="my_artist_home_photo">Photo URL:</label> ';
    echo '<input type="text" id="my_artist_home_photo" name="my_artist_home_photo" value="' . esc_attr($photo) . '" size="25" /></p>';

    $work = get_post_meta($post->ID, '_artist_home_work', true);
    echo '<p><label for="my_artist_home_work">Work URL:</label> ';
    echo '<input type="text" id="my_artist_home_work" name="my_artist_home_work" value="' . esc_attr($work) . '" size="25" /></p>';

    $quote = get_post_meta($post->ID, '_artist_home_quote', true);
    echo '<p><label for="my_artist_home_quote">Quote:</label> ';
    echo '<input type="text" id="my_artist_home_quote" name="my_artist_home_quote" value="' . esc_attr($quote) . '" size="50" /></p>';
}

function my_register_event_metabox($post) {
    add_meta_box('my_mb_event', 'Informações Adicionais', 'my_metabox_event', 'event', 'normal', 'default');
}

function my_metabox_event($post) {
    wp_nonce_field('my_metabox_event', 'my_metabox_event_nonce');

    $locale = get_post_meta($post->ID, '_event_locale', true);
    echo '<p><label for="my_event_locale">Localidade:</label> ';
    echo '<input type="text" id="my_event_locale" name="my_event_locale" value="' . esc_attr($locale) . '" size="25" /></p>';

    $period = get_post_meta($post->ID, '_event_period', true);
    echo '<p><label for="my_event_period">Data/Período:</label> ';
    echo '<input type="text" id="my_event_period" name="my_event_period" value="' . esc_attr($period) . '" size="25" /></p>';

    $site = get_post_meta($post->ID, '_event_site', true);
    echo '<p><label for="my_event_site">Endereço/Site:</label> ';
    echo 'http://<input type="text" id="my_event_site" name="my_event_site" value="' . esc_attr($site) . '" size="25" /></p>';
}

function my_metabox_data_precheck() {
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

    return true;
}

function my_metabox_data_nonce($nonce_value, $nonce_action) {
    if (!isset($nonce_value)) {
        return;
    }

    if (!wp_verify_nonce($nonce_value, $nonce_action)) {
        return;
    }

    return true;
}

function my_save_metabox_data($post_id) {
    if (!my_metabox_data_precheck()) {
        return;
    }

    // post
    if (my_metabox_data_nonce($_POST['my_metabox_post_nonce'], 'my_metabox_post')) {
        foreach(array('locale') as $field) {
            if (isset($_POST['my_post_' . $field])) {
                $data = sanitize_text_field($_POST['my_post_' . $field]);
                update_post_meta($post_id, '_post_' . $field, $data);
            }
        }
    }

    // event
    if (my_metabox_data_nonce($_POST['my_metabox_event_nonce'], 'my_metabox_event')) {
        foreach(array('locale', 'period', 'site') as $field) {
            if (isset($_POST['my_event_' . $field])) {
                $data = sanitize_text_field($_POST['my_event_' . $field]);
                update_post_meta($post_id, '_event_' . $field, $data);
            }
        }
    }

    // artist
    $nonces = array(
        'my_metabox_artist_xtra',
        'my_metabox_artist_home',
    );
    foreach($nonces as $value) {
        if (my_metabox_data_nonce($_POST[$value . '_nonce'], $value)) {
            // option
            if (isset($_POST['my_stick_home_highlight2'])
                && !empty($_POST['my_artist_home_photo'])
                && !empty($_POST['my_artist_home_work'])
                && !empty($_POST['my_artist_home_quote'])
            ) {
                update_option(NUVEM_OPTION_STICK_HOME_HIGHLIGHT2, intval($_POST['my_stick_home_highlight2']));
            }

            // fields
            $fields = array(
                '_artist_locale',
                '_artist_home_photo',
                '_artist_home_work',
                '_artist_home_quote',
            );
            foreach($fields as $field) {
                if (isset($_POST['my' . $field])) {
                    $data = sanitize_text_field($_POST['my' . $field]);
                    update_post_meta($post_id, $field, $data);
                }
            }

            if (isset($_POST['my_artist_aside'])) {
                update_post_meta($post_id, '_artist_aside', $_POST['my_artist_aside']);
            }
        }
    }
}
add_action('save_post', 'my_save_metabox_data');
