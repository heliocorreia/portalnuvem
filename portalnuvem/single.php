<?php get_header(); the_post(); ?>

<header class="content-hd">
    <div class="content--container">
        <?php get_template_part('partials/breadcrumb'); ?>
        <time class="content-hd--datetime"><?php the_time('d M/Y'); ?></time>
        <h1 class="content-hd--title"><?php the_title(); ?></h1>
    </div>
</header>

<div class="single">
    <div class="single--container">
        <article class="single--content">
            <?php the_content(); ?>
        </article>
    </div>
</div>

<?php get_template_part('partials/seemore'); ?>

<?php get_footer(); ?>