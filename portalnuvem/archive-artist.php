<?php get_header(); ?>

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
