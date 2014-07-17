<?php

function my_nuvem_states() {
    return array('AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO');
}

function my_register_metabox_callback_name($post_type) {
    return 'my_register_' . $post_type . '_metabox';
}

function my_pagination($pages='', $range=2) {
    $showitems = ($range * 2) + 1;

    global $paged;
    if (empty($paged)) {
        $paged = 1;
    }

    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
        $list = array();

        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) $list[] = '<a class="pagination-link pagination-first" href="'.get_pagenum_link(1).'">&laquo; Primeira</a>';
        if ($paged > 1 && $showitems < $pages) $list[] = '<a class="pagination-link pagination-prev" href="'.get_pagenum_link($paged - 1).'">&lsaquo; Anterior</a>';

        for ($i=1; $i <= $pages; $i++) {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
                $list[] = ($paged == $i)
                    ? '<span class="pagination-current">'.$i.'</span>'
                    : '<a class="pagination-link" href="' . get_pagenum_link($i) . '">' . $i . '</a>';
            }
        }

        if ($paged < $pages && $showitems < $pages) $list[] = '<a class="pagination-link pagination-next" href="' . get_pagenum_link($paged + 1) . '">Próxima &rsaquo;</a>';
        if ($paged < $pages - 1 &&  $paged + $range - 1 < $pages && $showitems < $pages) $list[] = '<a class="pagination-link pagination-last" href="' . get_pagenum_link($pages) . '">Última &raquo;</a>';

        if (count($list) > 0) {
            echo '<div class="pagination">';
            echo '<ul class="pagination-items"><li class="pagination-item">' . implode('</li><li class="pagination-item">', $list) . '</li></ul>';
            echo '</div>';
        }
    }
}

require TEMPLATEPATH . '/includes/constants.php';
require TEMPLATEPATH . '/includes/actions.php';
require TEMPLATEPATH . '/includes/actions-search.php';
require TEMPLATEPATH . '/includes/filters.php';
require TEMPLATEPATH . '/includes/meta-boxes.php';
