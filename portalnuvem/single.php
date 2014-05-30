<?php get_header(); the_post(); ?>

<header class="content-hd">
    <div class="content--container">
        <?php get_template_part('partials/breadcrumb'); ?>
        <time class="content-hd--pretitle"><?php the_time('d M/Y'); ?></time>
        <h1 class="content-hd--title"><?php the_title(); ?></h1>
    </div>
</header>

<div class="single-post">
    <div class="single-post--container">
        <article class="single-post--content">
            <?php the_content(); ?>
        </article>
        <aside class="single-post--aside">
            <?php if (has_post_thumbnail()): ?>
            <figure class="single-post--post-thumbnail">
                <?php the_post_thumbnail('477x558') ?>
            </figure>
            <?php endif; ?>
        </aside>
    </div>
</div>

<?php get_template_part('partials/seemore'); ?>

<?php get_footer(); ?>