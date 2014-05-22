<?php get_header(); the_post(); ?>

<section class="single">
    <header class="single--hd">
        <nav class="single--breadcrumb">
            BREADCRUMB
        </nav>
        <time class="single--datetime"><?php the_time('d M/Y'); ?></time>
        <h1 class="single--title"><?php the_title(); ?></h1>
    </header>

    <div class="single--article">
        <article class="single--content">
            <?php the_content(); ?>
        </article>
    </div>
</section>

<?php get_footer(); ?>