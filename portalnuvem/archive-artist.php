<?php
get_header();

$query_posts_args = array(
    'posts_per_page' => -1,
    'post_type' => NUVEM_POST_TYPE_ARTIST,
    'order' => 'ASC',
    'orderby' => 'title',
);

if (isset($_GET['filter_by'])) {
    $filter_by = $_GET['filter_by'];

    if (in_array($filter_by, my_nuvem_states())) {
        $query_posts_args['meta_query'][] = array(
            'key' => '_artist_state',
            'value' => $filter_by,
            'compare' => '=',
        );
    }

    add_filter('posts_where', '_archive_artist_posts_where', 10, 2 );
    function _archive_artist_posts_where( $where, &$wp_query ) {
        global $wpdb;
        $filter_by = $_GET['filter_by'];

        if (preg_match('/^[a-z]$/', $filter_by) === 1) {
            $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'' . esc_sql(like_escape($filter_by)) . '%\'';
        }

        return $where;
    }
}
?>

<header class="content-hd">
    <div class="content-hd--container">
        <?php get_template_part('partials/breadcrumb'); ?>
        <h1 class="content-hd--title">Artistas</h1>
    </div>
    <?php
    $video = new WP_Query(array(
        'orderby'        => 'date',
        'order'          => 'DESC',
        'category_name'  => NUVEM_ARTISTS_CATEGORY_SLUG,
        'post_type'      => NUVEM_POST_TYPE_VIDEO,
        'posts_per_page' => 1,
    ));
    if ($video->have_posts()): $video->the_post(); ?>
    <div class="content-hd--embed">
    <?php
        $video_url = get_post_meta($post->ID, '_video_url', true);
        $oembed = wp_oembed_get($video_url);
        if ($oembed != $video_url) echo $oembed;
    ?>
    </div>
    <?php endif; ?>
    <div class="content-hd--container">
        <?php get_template_part('partials/subscribe'); ?>
    </div>
</header>

<div class="content-bd">
    <div class="content-bd--container">
        <?php
        $url_prefix = './?post_type=' . NUVEM_POST_TYPE_ARTIST;
        $url_filter = $url_prefix . '&filter_by=';
        ?>
        <nav class="artist--filter-states">
            <ul class="artist--filter-state-list">
                <?php foreach(my_nuvem_states() as $val): ?>
                <li class="artist--filter-state-item"><a class="artist--filter-state-link" href="<?php echo $url_filter . $val ?>"><?php echo $val ?></a></li>
                <?php endforeach ?>
            </ul>
        </nav>
        <nav class="artist--filter-letters">
            <ul>
                <li class="artist--filter-letter"><a class="artist--filter-letter-link" href="<?php echo $url_prefix ?>">Todos</a></li>
                <?php
                global $wpdb;
                foreach(str_split('abcdefghijklmnopqrstuvwxyz', 1) as $val):
                ?>
                <li class="artist--filter-letter<?php if ($_GET['filter_by'] === $val): ?> artist--filter-current<?php endif; ?>"><a class="artist--filter-letter-link" href="<?php echo $url_filter . $val; ?>"><?php echo $val; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <?php
        query_posts($query_posts_args);
        if (have_posts()): ?>
            <?php while (have_posts()): the_post(); ?>
                <?php get_template_part('content', 'artist'); ?>
            <?php endwhile ?>
        <?php endif ?>
    </div>
</div>

<?php get_footer(); ?>
