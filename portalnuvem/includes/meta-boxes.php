<?php

// META BOX: HOME PAGE HIGHLIGHT1

function use_my_metabox_home_highlight1($post_type) {
    add_meta_box('my_mb_home_highlight1', 'Home Page: highlight1', 'my_metabox_home_highlight1', $post_type, 'normal', 'default');
}
function my_metabox_home_highlight1($post) {
    wp_nonce_field('my_metabox_home_highlight1', 'my_metabox_home_highlight1_nonce');

    echo '<p class="my-nuvem-hint-img"><img src="' . get_stylesheet_directory_uri() . '/media/hint-home-highlight1.jpg" /></p>';

    $stick = ($post->ID === get_option(NUVEM_OPTION_STICK_HOME_HIGHLIGHT1, false));
    echo '<p><input type="checkbox" id="my_stick_home_highlight1" name="my_stick_home_highlight1" size="25" ' .($stick?'checked="checked"':''). ' value="' .$post->ID. '" /> ';
    echo '<label for="my_stick_home_highlight1">Exibir na home</label></p>';

    $fields = array(
        'img_name'       => 'Imagem no nome (1.440px × 532px)',
        'img_photo'      => 'Imagem da chamada (352px × 443px)',
        'bg_color'       => 'Cor de fundo (#000, rgba(0,0,0,0.5) etc.)',
        'pretitle'       => 'Pré-titulo',
        'title'          => 'Título',
    );

    foreach($fields as $key => $label) {
        $value = get_post_meta($post->ID, '_home_highlight1_' . $key, true);
        echo '<p><label for="my_home_highlight1_' . $key . '">' . $label . ':</label> ';
        echo '<input type="text" id="my_home_highlight1_' . $key . '" name="my_home_highlight1_' . $key . '" value="' . esc_attr($value) . '" size="25" /></p>';
    }
}

// POST TYPE: POST

function my_register_post_metabox($post) {
    if ($post_type != 'post') {
        return;
    }

    add_meta_box('my_mb_post', 'Informações Adicionais', 'my_metabox_post', $post->post_type, 'normal', 'high');
    use_my_metabox_home_highlight1($post->post_type);
}
add_action('add_meta_boxes', 'my_register_post_metabox');

function my_metabox_post($post) {
    wp_nonce_field('my_metabox_post', 'my_metabox_post_nonce');

    $locale = get_post_meta($post->ID, '_post_locale', true);
    echo '<p><label for="my_post_locale">Localidade:</label> ';
    echo '<input type="text" id="my_post_locale" name="my_post_locale" value="' . esc_attr($locale) . '" size="25" /></p>';
}

// POST TYPE: ARTICLE

function my_register_article_metabox($post) {
    use_my_metabox_home_highlight1($post->post_type);
}

// POST TYPE: ARTIST

function my_register_artist_metabox($post) {
    add_meta_box('my_mb_artist_xtra', 'Informações Adicionais', 'my_metabox_artist_xtra', $post->post_type, 'normal', 'default');
    use_my_metabox_home_highlight1($post->post_type);
    add_meta_box('my_mb_artist_home', 'Home Page: highlight2', 'my_metabox_artist_home', $post->post_type, 'normal', 'default');
}

function my_metabox_artist_xtra($post) {
    wp_nonce_field('my_metabox_artist_xtra', 'my_metabox_artist_xtra_nonce');

    $state = get_post_meta($post->ID, '_artist_state', true); ?>
    <p>
        <label for="my_artist_state">Estado:</label>
        <select id="my_artist_state" name="my_artist_state">
            <option>--</option>
            <?php foreach(my_nuvem_states() as $val): ?>
            <option<?php if (strtoupper($val) == strtoupper($state)): ?> selected="selected"<?php endif ?>><?php echo $val ?></option>
            <?php endforeach ?>
        </select>
    </p>
    <?php

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

    echo '<p class="my-nuvem-hint-img"><img src="' . get_stylesheet_directory_uri() . '/media/hint-home-highlight2.jpg" /></p>';

    $stick = ($post->ID === get_option(NUVEM_OPTION_STICK_HOME_HIGHLIGHT2, false));
    echo '<p><input type="checkbox" id="my_stick_home_highlight2" name="my_stick_home_highlight2" size="25" ' .($stick?'checked="checked"':''). ' value="' .$post->ID. '" /> ';
    echo '<label for="my_stick_home_highlight2">Exibir na home</label></p>';

    $photo = get_post_meta($post->ID, '_artist_home_photo', true);
    echo '<p><label for="my_artist_home_photo">URL foto do autor (155px × 155px):</label> ';
    echo '<input type="text" id="my_artist_home_photo" name="my_artist_home_photo" value="' . esc_attr($photo) . '" size="25" /></p>';

    $work = get_post_meta($post->ID, '_artist_home_work', true);
    echo '<p><label for="my_artist_home_work">URL foto do trabalho (605px × 695px):</label> ';
    echo '<input type="text" id="my_artist_home_work" name="my_artist_home_work" value="' . esc_attr($work) . '" size="25" /></p>';

    $quote = get_post_meta($post->ID, '_artist_home_quote', true);
    echo '<p><label for="my_artist_home_quote">Frase/Citação:</label> ';
    echo '<input type="text" id="my_artist_home_quote" name="my_artist_home_quote" value="' . esc_attr($quote) . '" size="50" /></p>';
}

// POST TYPE: EVENT

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

// POST TYPE: VIDEO

function my_register_video_metabox($post) {
    add_meta_box('my_mb_video_xtra', 'Dados do Vídeo', 'my_metabox_video_xtra', $post->post_type, 'normal', 'default');
    use_my_metabox_home_highlight1($post->post_type);
}

function my_metabox_video_xtra($post) {
    wp_nonce_field('my_metabox_video', 'my_metabox_video_nonce');

    $video_url = get_post_meta($post->ID, '_video_url', true);
    echo '<p><label for="my_video_url">URL:</label> ';
    echo '<input type="text" id="my_video_url" name="my_video_url" value="' . esc_attr($video_url) . '" size="25" /> ';
    echo ' <small><a href="http://en.support.wordpress.com/shortcodes/#video" target="_blank">Ver fontes suportadas</a></small>';
    echo '</p>';
}

// SAVE METABOX

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

    // META BOX home page: highlight1
    foreach(array('article', 'artist', 'post', 'video') as $val) {
        if (my_metabox_data_nonce($_POST['my_metabox_home_highlight1_nonce'], 'my_metabox_home_highlight1')) {
            // sticky
            if (isset($_POST['my_stick_home_highlight1'])
                && !empty($_POST['my_home_highlight1_img_name'])
                && !empty($_POST['my_home_highlight1_img_photo'])
                && !empty($_POST['my_home_highlight1_bg_color'])
                && !empty($_POST['my_home_highlight1_pretitle'])
                && !empty($_POST['my_home_highlight1_title'])
            ) {
                update_option(NUVEM_OPTION_STICK_HOME_HIGHLIGHT1, intval($_POST['my_stick_home_highlight1']));
            }

            $fields = array(
                'img_name',
                'img_photo',
                'bg_color',
                'pretitle',
                'title'
            );

            foreach($fields as $field) {
                if (isset($_POST['my_home_highlight1_' . $field])) {
                    $data = sanitize_text_field($_POST['my_home_highlight1_' . $field]);
                    update_post_meta($post_id, '_home_highlight1_' . $field, $data);
                }
            }
        }
    }

    // POST TYPE post
    if (my_metabox_data_nonce($_POST['my_metabox_post_nonce'], 'my_metabox_post')) {
        foreach(array('locale') as $field) {
            if (isset($_POST['my_post_' . $field])) {
                $data = sanitize_text_field($_POST['my_post_' . $field]);
                update_post_meta($post_id, '_post_' . $field, $data);
            }
        }
    }

    // POST TYPE event
    if (my_metabox_data_nonce($_POST['my_metabox_event_nonce'], 'my_metabox_event')) {
        foreach(array('locale', 'period', 'site') as $field) {
            if (isset($_POST['my_event_' . $field])) {
                $data = sanitize_text_field($_POST['my_event_' . $field]);
                update_post_meta($post_id, '_event_' . $field, $data);
            }
        }
    }

    // POST TYPE video
    if (my_metabox_data_nonce($_POST['my_metabox_video_nonce'], 'my_metabox_video')) {
        foreach(array('url') as $field) {
            if (isset($_POST['my_video_' . $field])) {
                $data = sanitize_text_field($_POST['my_video_' . $field]);
                update_post_meta($post_id, '_video_' . $field, $data);
            }
        }
    }

    // POST TYPE artist
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
                '_artist_state',
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
