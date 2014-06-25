<?php
get_header();

if (isset($_GET['filter_by'])) {
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
        <div class="content-hd--embed">
            <iframe width="100%" height="693" src="//www.youtube-nocookie.com/embed/5zk6jP7f43E?rel=0&controls=2&showinfo=0" frameborder="0" allowfullscreen></iframe>
        </div>
        <?php get_template_part('partials/subscribe'); ?>
    </div>
</header>

<div class="content-bd">
    <div class="content-bd--container">
        <?php
        $url_prefix = './?post_type=artist';
        ?>
        <nav class="artist--index">
            <ul>
                <li class="artist--index-item"><a class="artist--index-link" href="<?php echo $url_prefix ?>">Todos</a></li>
                <?php
                global $wpdb;
                foreach(str_split('abcdefghijklmnopqrstuvwxyz', 1) as $val):
                ?>
                <li class="artist--index-item<?php if ($_GET['filter_by'] === $val): ?> artist--index-current<?php endif; ?>"><a class="artist--index-link" href="<?php echo $url_prefix . '&filter_by=' . $val; ?>"><?php echo $val; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <?php
        query_posts(array(
            'posts_per_page' => -1,
            'post_type' => 'artist'
        ));
        if (have_posts()): ?>
            <?php while (have_posts()): the_post(); ?>
                <?php get_template_part('content', 'artist'); ?>
            <?php endwhile ?>
        <?php endif ?>
    </div>
</div>

<?php get_footer(); ?>
