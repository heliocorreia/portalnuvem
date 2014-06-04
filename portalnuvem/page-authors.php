<?php
/*
Template Name: Authors
*/

get_header(); ?>

<header class="content-hd">
    <div class="content--container">
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
            <figure class="page-authors--figure">
                <img src="<?php echo $photo; ?>" width="284" height="284" />
            </figure>
            <h1 class="page-authors--name"><?php echo $author->display_name; ?></h1>
            <?php
            $author_posts = new WP_Query(array(
                'author'         => $author->ID,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'post_type'      => 'article',
                'posts_per_page' => 1
            ));

            while($author_posts->have_posts()): $author_posts->the_post(); ?>
                <h2 class="page-authors--title"><a class="page-authors--title-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p class="page-authors--subtitle"><a class="page-authors--subtitle-link" href="<?php the_permalink(); ?>"><?php echo get_the_excerpt(); ?></a></h2>
            <?php endwhile; ?>
        </section>
        <?php endforeach; wp_reset_postdata(); ?>

    </div>
</div>

<?php get_footer(); ?>