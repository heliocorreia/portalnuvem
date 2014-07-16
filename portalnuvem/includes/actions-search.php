<?php

add_filter('posts_where', 'my_search_where');

function my_search_where($where) {
    global $wpdb;

    if (is_search()) {
        $post_types = array(
            NUVEM_POST_TYPE_ARTICLE,
            NUVEM_POST_TYPE_ARTIST,
            NUVEM_POST_TYPE_EVENT,
            NUVEM_POST_TYPE_VIDEO,
        );

        $where .= " AND `$wpdb->posts`.`post_type` IN ('" . implode("', '", $post_types) .  "')";
    }

    return $where;
}
