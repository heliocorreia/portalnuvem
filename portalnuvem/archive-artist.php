<?php get_header(); ?>

<header class="content-hd">
    <div class="content-hd--container">
        <?php get_template_part('partials/breadcrumb'); ?>
        <h1 class="content-hd--title">Artistas</h1>
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