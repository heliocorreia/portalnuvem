<?php

function my_nuvem_states() {
    return array('AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO');
}

function my_register_metabox_callback_name($post_type) {
    return 'my_register_' . $post_type . '_metabox';
}

require TEMPLATEPATH . '/includes/constants.php';
require TEMPLATEPATH . '/includes/actions.php';
require TEMPLATEPATH . '/includes/actions-search.php';
require TEMPLATEPATH . '/includes/filters.php';
require TEMPLATEPATH . '/includes/meta-boxes.php';
