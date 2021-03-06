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

    wp_deregister_script(NUVEM_JQUERY_HANDLER);
    wp_register_script(NUVEM_JQUERY_HANDLER, NUVEM_JQUERY_CDN, array(), null, false);

    wp_deregister_script(NUVEM_PARSLEY_HANDLER);
    wp_register_script(NUVEM_PARSLEY_HANDLER, NUVEM_PARSLEY_CDN, array(NUVEM_JQUERY_HANDLER), null, true);

    wp_enqueue_script(NUVEM_JQUERY_HANDLER);
    wp_enqueue_script(NUVEM_PARSLEY_HANDLER);

    register_nav_menu('main', 'Main Menu');
    register_nav_menu('footer', 'Footer Menu');
    register_nav_menu('social', 'Social Menu');
}
add_action('after_setup_theme', 'my_setup');

function my_init() {
    register_post_type(NUVEM_POST_TYPE_ARTICLE,
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
            'register_meta_box_cb' => my_register_metabox_callback_name(NUVEM_POST_TYPE_ARTICLE),
        )
    );
    register_post_type(NUVEM_POST_TYPE_EVENT,
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
            'register_meta_box_cb' => my_register_metabox_callback_name(NUVEM_POST_TYPE_EVENT),
        )
    );
    register_post_type(NUVEM_POST_TYPE_ARTIST,
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
            'register_meta_box_cb' => my_register_metabox_callback_name(NUVEM_POST_TYPE_ARTIST),
        )
    );
    register_post_type(NUVEM_POST_TYPE_VIDEO,
        array(
            'labels' => array(
                'name' => __('Videos'),
                'singular_name' => __('Video')
            ),
            'public' => true,
            'taxonomies' => array('category'),
            'has_archive' => true,
            'menu_position' => 5,
            'supports' => array(
                'title',
                'excerpt',
            ),
            'register_meta_box_cb' => my_register_metabox_callback_name(NUVEM_POST_TYPE_VIDEO),
        )
    );
}
add_action('init','my_init');

// actions

add_filter('oembed_result', 'my_oembed_result_youtube', 10, 3);
function my_oembed_result_youtube($html, $url, $args) {
    if (preg_match('#www\.youtube\.com#', $url)) {
        return str_replace('?feature=oembed', '?' . http_build_query(array(
            'feature' => 'oembed',
            // https://developers.google.com/youtube/player_parameters
            'controls' => 2,
            'rel' => 0,
            'showinfo' => 0,
            // 'theme' => 'light',
            'modestbranding' => 1,
            'iv_load_policy' => 3,
        ), '&amp;'), $html);
    }

    return $html;
}

function my_wp_head() {
    $jquery_url = get_stylesheet_directory_uri() . NUVEM_JQUERY_FALLBACK;
    echo <<<JS
<script type="text/javascript">
    window.jQuery || document.write('<script src="$jquery_url">\\x3C/script>');

    $.fn.toggleAttr = function(attr, attr1, attr2) {
        return this.each(function() {
            var self = $(this);
            if (self.attr(attr) == attr1)
                self.attr(attr, attr2);
            else
                self.attr(attr, attr1);
        });
    };
</script>

JS;
}
add_action('wp_head', 'my_wp_head');

function my_wp_footer() {
    $parsley_url = get_stylesheet_directory_uri() . NUVEM_PARSLEY_FALLBACK;
    echo <<<JS
    <script type="text/javascript">
        window.ParsleyValidator || document.write('<script src="$parsley_url">\\x3C/script>');

        // ParsleyConfig definition if not already set
        window.ParsleyConfig = window.ParsleyConfig || {};
        window.ParsleyConfig.i18n = window.ParsleyConfig.i18n || {};

        // Define then the messages
        window.ParsleyConfig.i18n['pt-br'] = $.extend(window.ParsleyConfig.i18n['pt-br'] || {}, {
          defaultMessage: "Este valor parece ser inválido.",
          type: {
            email:        "Esse campo deve ser um email válido.",
            url:          "Esse campo deve ser uma url válida.",
            number:       "Esse campo deve ser um número válido.",
            integer:      "Esse campo deve ser um inteiro válido.",
            digits:       "Esse campo deve conter apenas dígitos.",
            alphanum:     "Esse campo deve ser alfa numérico."
          },
          notblank:       "Esse campo não pode ficar vazio.",
          required:       "Esse campo é obrigatório.",
          pattern:        "Esse campo parece estar inválido.",
          min:            "Esse campo deve ser maior ou igual a %s.",
          max:            "Esse campo deve ser menor ou igual a %s.",
          range:          "Esse campo deve estar entre %s e %s.",
          minlength:      "Esse campo é pequeno demais. Ele deveria ter %s characteres ou mais.",
          maxlength:      "Esse campo grande demais. Ele deveri ter %s characteres ou menos.",
          length:         "O tamanho desse campo é inválido. Ele deveria ter entre %s e %s characteres.",
          mincheck:       "Você deve escolher pelo menos %s opções.",
          maxcheck:       "Você deve escolher %s opções ou mais",
          check:          "Você deve escolher entre %s e %s opções.",
          equalto:        "Este valor deveria ser igual."
        });

        // If file is loaded after Parsley main file, auto-load locale
        if ('undefined' !== typeof window.ParsleyValidator)
          window.ParsleyValidator.addCatalog('pt-br', window.ParsleyConfig.i18n['pt-br'], true);
    </script>
JS;
}
add_action('wp_footer', 'my_wp_footer', 20);

function my_admin_head() {
    echo <<<CSS
<style type="text/css" media="all">
    .wp-admin .postbox .inside {
      *zoom: 1;
    }
    .wp-admin .postbox .inside:after {
      content: "";
      display: table;
      clear: both;
    }
    .wp-admin .postbox .inside .my-nuvem-hint-img {
      float: right;
    }
    .wp-admin .postbox .inside label {
      display: block;
    }
    .wp-admin .postbox .inside input[type="checkbox"] + label {
      display: inline;
    }
</style>
CSS;
}
add_action('admin_head', 'my_admin_head');

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
        'caption' => trim("$attachment->post_excerpt $attachment->post_content"),
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

// AJAX

function wp_ajax_contact_action() {
    if (!wp_verify_nonce($_POST['nonce'], NUVEM_NONCE_CONTACT)) {
        exit;
    }

    $response = array(
        'errors' => false,
        'messages' => array(),
    );

    $fields = array('fullname', 'mail', 'message');
    foreach($fields as $field) {
        $_POST[$field] = stripslashes(trim($_POST[$field]));
    }

    if (!$response['errors']) {
        $new_name = $_POST['fullname'];

        // confirmation mail
        $emailTo = get_option('admin_email');
        $subject = "[CONTATO] $_POST[fullname]";
        $body = join("\n", array(
            "Nome: $_POST[fullname]",
            "E-mail: $_POST[mail]",
            "Mensagem: $_POST[message]"
        ));
        $headers = 'From: '.$_POST['fullname'].' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $_POST['mail'];
        $emailSent = (bool)wp_mail($emailTo, $subject, $body, $headers);

        // message
        $response['messages'][] = 'Mensagem enviada.';
        $response['messages'][] = 'Obrigado!';
    }

    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    elseif (isset($_REQUEST['redirect'])) {
        header('Location: ' . $_REQUEST['redirect']);
    }
    elseif (isset($_SERVER['HTTP_REFERER'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    exit;
}
add_action('wp_ajax_' . NUVEM_ACTION_CONTACT, 'wp_ajax_contact_action');
add_action('wp_ajax_nopriv_' . NUVEM_ACTION_CONTACT, 'wp_ajax_contact_action');

function wp_ajax_subscribe_action() {
    if (!wp_verify_nonce($_POST['nonce'], NUVEM_NONCE_SUBSCRIBE)) {
        exit;
    }

    $response = array(
        'errors' => false,
        'messages' => array(),
    );

    $fields = array('firstname', 'lastname', 'city', 'state', 'mail', 'site', 'release');
    foreach($fields as $field) {
        $_POST[$field] = stripslashes(trim($_POST[$field]));
    }

    if (!$response['errors']) {
        $new_name = wp_strip_all_tags(trim($_POST['firstname']) . ' ' . trim($_POST['lastname']));
        $new_release = wp_strip_all_tags($_POST['release']);

        // define default author
        $new_post_author_id = current(get_users(array(
            'role' => 'Administrator',
            'fields' => array('ID'),
        )))->ID;

        // new post type
        $new_post_id = wp_insert_post(array(
            'post_content' => $new_release,
            'post_title' => $new_name,
            'post_status' => 'pending',
            'post_type' => NUVEM_POST_TYPE_ARTIST,
            'post_author' => $new_post_author_id,
        ));

        // update post meta
        update_post_meta($new_post_id, '_artist_locale', sanitize_text_field($_POST['city']));
        update_post_meta($new_post_id, '_artist_state', sanitize_text_field($_POST['state']));

        // new post attachment
        $attachments = array();
        foreach($_FILES as $file) {
            $new_file = wp_handle_upload($file, array('test_form' => false));
            if ($new_file) {
                $attach_id = wp_insert_attachment(
                    array(
                        'post_author' => $new_post_author_id,
                        'post_content' => '',
                        'post_mime_type' => $new_file['type'],
                        'post_title' => $file['name'],
                    ),
                    $new_file['file'],
                    $new_post_id
                );

                $attach_data = wp_generate_attachment_metadata($attach_id, $new_file['file']);
                wp_update_attachment_metadata($attach_id, $attach_data);
                set_post_thumbnail($new_post_id, $attach_id);

                $attachments[] = $new_file['file'];
            }
        }

        // confirmation mail
        $emailTo = get_option('admin_email');
        $subject = "[Cadastro Pendente] $new_name";
        $body = join("\n", array(
            "Nome: $new_name",
            "Origem: $_POST[city] $_POST[state]",
            "Contato: $_POST[mail] $_POST[site]",
            "Release: $new_release"
        ));
        $headers = 'From: '.$new_name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $_POST['mail'];
        $emailSent = (bool)wp_mail($emailTo, $subject, $body, $headers, $attachments);

        // message
        $response['messages'][] = 'Cadastro foi enviado.';
        $response['messages'][] = 'Obrigado!';
    }

    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    elseif (isset($_REQUEST['redirect'])) {
        header('Location: ' . $_REQUEST['redirect']);
    }
    elseif (isset($_SERVER['HTTP_REFERER'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    exit;
}
add_action('wp_ajax_' . NUVEM_ACTION_SUBSCRIBE, 'wp_ajax_subscribe_action');
add_action('wp_ajax_nopriv_' . NUVEM_ACTION_SUBSCRIBE, 'wp_ajax_subscribe_action');
