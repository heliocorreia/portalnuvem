<?php get_header(); the_post(); ?>

<header class="content-hd">
    <div class="content--container">
        <?php get_template_part('partials/breadcrumb'); ?>
        <h1 class="content-hd--title"><?php the_author(); ?></h1>
    </div>
</header>

<section class="single-article">
    <div class="single-article--container">
        <article class="single-article--content">
            <time class="single-article--datetime"><?php the_time('d M/ Y'); ?></time>
            <h1 class="single-article--title"><?php the_title(); ?></h1>
            <?php the_content(); ?>
        </article>
        <aside class="single-article--aside">
            <h1>Textos Anteriores</h1>
            <ul>
                <li><a href="#">Adasd asdas das ds</a></li>
                <li><a href="#">Adasd asdas das ds</a></li>
            </ul>
            <p><a href="#">Veja mais</a></p>
        </aside>
    </div>
</section>

<?php get_template_part('partials/seemore'); ?>

<?php get_footer(); ?>