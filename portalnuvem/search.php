<?php get_header(); ?>

<header class="content-hd">
    <div class="content-hd--container">
        <form class="search--form" action="<?php bloginfo('url'); ?>">
            <input class="search--query" type="text" name="s" value="<?php esc_attr_e(stripslashes($_GET['s'])) ?>" />
            <input class="search--submit" type="submit" value="Buscar" />
        </form>
    </div>
</header>

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
