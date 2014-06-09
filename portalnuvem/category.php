<?php get_header(); ?>

<header class="content-hd">
    <div class="content-hd--container">
        <?php get_template_part('partials/breadcrumb'); ?>
        <h1 class="content-hd--title"><?php
            if (in_category(NUVEM_NEWS_CATEGORY_SLUG)):
                print('Últimas');

            elseif (in_category(NUVEM_ARTICLES_CATEGORY_SLUG)):
                print('Colunas');

            endif;
        ?></h1>
    </div>
</header>

<div class="content-bd">
    <div class="content-bd--container">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()): the_post(); ?>
                <?php get_template_part('content', get_post_format()); ?>
            <?php endwhile ?>
        <?php endif ?>
    </div>
</div>

<?php get_footer(); ?>