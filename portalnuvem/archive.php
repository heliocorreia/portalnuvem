<?php get_header(); ?>

<?php get_template_part('content', 'hd'); ?>

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