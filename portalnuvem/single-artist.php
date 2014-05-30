<?php get_header(); the_post(); ?>

<header class="content-hd">
    <div class="content--container">
        <?php get_template_part('partials/breadcrumb'); ?>
        <p class="content-hd--pretitle"><small>Pernambuco - PE</small></hp>
        <h1 class="content-hd--title"><?php the_title(); ?></h1>
    </div>
</header>

<section class="single-artist">
    <div class="single-artist--container">
        <article class="single-artist--content">
            <?php the_content(); ?>
        </article>
        <aside class="single-artist--aside">
            <?php if (has_post_thumbnail()): ?>
            <figure class="single-artist--post-thumbnail">
                <?php the_post_thumbnail('477x558') ?>
            </figure>
            <?php endif ?>
            <h1>Veja também</h1>
            <ul>
                <li><a href="#">Site pessoal do artista</a></li>
                <li><a href="#">Obras originais à venda na Nuvem Store</a></li>
            </ul>
        </aside>
    </div>
</section>

<?php get_footer(); ?>