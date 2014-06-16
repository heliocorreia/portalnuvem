<?php get_header(); the_post(); ?>

<header class="content-hd">
    <div class="content-hd--container">
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
                <?php the_post_thumbnail('400x468') ?>
            </figure>
            <?php endif; ?>
        </aside>

        <div class="single-post--social">
            <?php get_template_part('partials/facebook'); ?>
            <div class="fb-comments" data-href="<?php the_permalink() ?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
        </div>
    </div>
</div>

<?php get_template_part('partials/seemore'); ?>

<?php get_footer(); ?>