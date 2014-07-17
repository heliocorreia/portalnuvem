<?php get_header(); ?>

<div class="content-bd">
    <div class="content-bd--container">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()): the_post(); ?>
                <?php get_template_part('searchresult', $post->post_type); ?>
            <?php endwhile ?>
            <?php my_pagination() ?>
        <?php else: ?>
            <div class="searchresult--entry">
                <p class="searchresult--subtitle">Nada encontrado.</p>
            </div>
        <?php endif ?>
    </div>
</div>

<?php
get_footer();
