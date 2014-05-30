<?php get_header(); the_post(); ?>

<header class="content-hd">
    <div class="content--container">
        <?php get_template_part('partials/breadcrumb'); ?>
        <time class="content-hd--datetime"><?php the_time('d M/Y'); ?></time>
        <h1 class="content-hd--title"><?php the_title(); ?></h1>
    </div>
</header>

<div class="single-bd">
    <div class="single-bd--container">
        <article class="single-bd--content">
            <?php the_content(); ?>
        </article>
    </div>
</div>

<aside class="single-aside">
    <div class="single-aside--container">
        <header class="single-aside--hd">
            <h1 class="single-aside--hd-title">Veja Também</h1>
        </header>
        <div class="single-aside--bd">
            <section class="single-aside--item">
                <figure class="single-aside--figure">
                    <img class="single-aside--img" src="<?php echo get_stylesheet_directory_uri(); ?>/media/test/single-aside-01.jpg" width="352" height="402" />
                </figure>
                <p class="single-aside--pretitle"><small>Arte Hoje</small></p>
                <h1 class="single-aside--title">Qual é o nosso problema? Márcio Alencar dá a dica</h1>
            </section>
            <section class="single-aside--item">
                <figure class="single-aside--figure">
                    <img class="single-aside--img" src="<?php echo get_stylesheet_directory_uri(); ?>/media/test/single-aside-02.jpg" width="352" height="402" />
                </figure>
                <p class="single-aside--pretitle"><small>Entrevistas</small></p>
                <h1 class="single-aside--title">Shiko comenta seu período fértil na Itália</h1>
            </section>
            <section class="single-aside--item">
                <figure class="single-aside--figure">
                    <img class="single-aside--img" src="<?php echo get_stylesheet_directory_uri(); ?>/media/test/single-aside-03.jpg" width="352" height="402" />
                </figure>
                <p class="single-aside--pretitle"><small>Loja</small></p>
                <h1 class="single-aside--title">Chuva - Um singelo poser de João Lin</h1>
            </section>
        </div>
    </div>
</aside>

<?php get_footer(); ?>