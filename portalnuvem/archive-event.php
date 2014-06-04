<?php get_header(); ?>

<header class="content-hd">
    <div class="content-hd--container">
        <?php get_template_part('partials/breadcrumb'); ?>
        <h1 class="content-hd--title">Próximos Eventos</h1>
    </div>
</header>

<div class="content-bd">
    <div class="content-bd--container">
        <?php
        query_posts(array(
            'posts_per_page' => -1,
            'post_type' => 'event'
        ));
        if (have_posts()): ?>
            <?php while (have_posts()): the_post(); ?>
                <?php get_template_part('content', 'event'); ?>
            <?php endwhile ?>
        <?php endif ?>
    </div>
</div>

<?php get_template_part('partials/seemore'); ?>

<?php get_footer(); ?>