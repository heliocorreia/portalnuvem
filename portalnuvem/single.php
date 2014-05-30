<?php get_header(); the_post(); ?>

<header class="content-hd">
    <div class="content--container">
        <?php get_template_part('partials/breadcrumb'); ?>
        <time class="content-hd--datetime"><?php the_time('d M/Y'); ?></time>
        <h1 class="content-hd--title"><?php the_title(); ?></h1>
    </div>
</header>

<div class="single-bd">
    <div class="single-bd--container">
        <article class="single-bd--content">
            <?php the_content(); ?>
        </article>
    </div>
</div>

<?php get_template_part('partials/single', 'aside'); ?>

<?php get_footer(); ?>