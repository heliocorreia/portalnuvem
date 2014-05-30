<?php get_header(); ?>

<header class="content-hd">
    <div class="content--container">
        <?php get_template_part('partials/breadcrumb'); ?>
        <time class="content-hd--datetime"><?php the_time('d M/Y'); ?></time>
        <h1 class="content-hd--title"><?php the_title(); ?></h1>
    </div>
</header>

<div class="archive-bd">
    <div class="archive-bd--container">
        <article class="archive-bd--content">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()): the_post(); ?>
                    <?php get_template_part('content', get_post_format()); ?>
                <?php endwhile ?>
            <?php endif ?>
        </article>
    </div>
</div>

<?php get_footer(); ?>