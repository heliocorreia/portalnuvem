<?php get_header(); the_post(); ?>

<section class="single">
    <header class="single--hd">
        <nav class="single--breadcrumb">
            BREADCRUMB
        </nav>
        <time class="single--datetime"><?php the_time('d M/Y'); ?></time>
        <h1 class="single--title"><?php the_title(); ?></h1>
    </header>

    <div class="single--bd">
        <article class="single--content">
            <?php the_content(); ?>
        </article>
    </div>

    <aside class="single-aside">
        <header class="single-aside-hd">
            <h1 class="single-aside-hd-title">Veja Também</h1>
        </header>
        <div class="single-aside-bd">
            <section class="single-aside-item">
                <figure class="single-aside-figure">
                    <img class="single-aside-img" src="<?php echo get_stylesheet_directory_uri(); ?>/media/test/single-aside-01.jpg" width="352" height="402" />
                </figure>
                <p class="single-aside-pretitle"><small>Arte Hoje</small></p>
                <h1 class="single-aside-title">Qual é o nosso problema? Márcio Alencar dá a dica</h1>
            </section>
            <section class="single-aside-item">
                <figure class="single-aside-figure">
                    <img class="single-aside-img" src="<?php echo get_stylesheet_directory_uri(); ?>/media/test/single-aside-02.jpg" width="352" height="402" />
                </figure>
                <p class="single-aside-pretitle"><small>Entrevistas</small></p>
                <h1 class="single-aside-title">Shiko comenta seu período fértil na Itália</h1>
            </section>
            <section class="single-aside-item">
                <figure class="single-aside-figure">
                    <img class="single-aside-img" src="<?php echo get_stylesheet_directory_uri(); ?>/media/test/single-aside-03.jpg" width="352" height="402" />
                </figure>
                <p class="single-aside-pretitle"><small>Loja</small></p>
                <h1 class="single-aside-title">Chuva - Um singelo poser de João Lin</h1>
            </section>
        </div>
    </aside>
</section>

<?php get_footer(); ?>