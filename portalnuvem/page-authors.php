<?php
/*
Template Name: Authors
*/

get_header(); ?>

<header class="content-hd">
    <div class="content-hd--container">
        <?php get_template_part('partials/breadcrumb'); ?>
        <h1 class="content-hd--title">Colunistas</h1>
    </div>
</header>

<div class="content-bd">
    <div class="content-bd--container">
        <?php
        $authors = get_users();
        foreach($authors as $author):
        if (!($photo = get_user_meta($author->ID, 'photo284x284', true))):
            continue;
        endif;
        ?>
        <section class="page-authors--entry">
            <?php $author_posts = new WP_Query(array(
                'author'         => $author->ID,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'post_type'      => NUVEM_POST_TYPE_ARTICLE,
                'posts_per_page' => 1
            )); ?>
            <?php while($author_posts->have_posts()): $author_posts->the_post(); ?>
                <figure class="page-authors--figure">
                    <a class="page-authors--figure-link" href="<?php the_permalink(); ?>"><img src="<?php echo $photo; ?>" width="284" height="284" /></a>
                </figure>
                <h1 class="page-authors--name"><?php echo $author->display_name; ?></h1>
                <h2 class="page-authors--title"><a class="page-authors--title-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p class="page-authors--subtitle"><a class="page-authors--subtitle-link" href="<?php the_permalink(); ?>"><?php echo get_the_excerpt(); ?></a></h2>
            <?php endwhile; ?>
        </section>
        <?php endforeach; wp_reset_postdata(); ?>

    </div>
</div>

<?php get_footer(); ?>