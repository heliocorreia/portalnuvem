<?php get_header(); ?>

<header class="content-hd">
    <div class="content--container">
        <?php get_template_part('partials/breadcrumb'); ?>
        <h1 class="content-hd--title"><?php
            if (in_category('noticias')):
                print('Últimas');

            elseif (in_category('colunas')):
                print('Colunas');

            endif;
        ?></h1>
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