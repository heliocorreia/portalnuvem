<?php get_header(); ?>

<script type='text/javascript' src='//code.jquery.com/jquery-1.11.0.js'></script>

<script src="http://bxslider.com/lib/jquery.bxslider.js"></script>
<script>
$(document).ready(function(){
    var headlines = $('.home-headlines-items').css('visibility', 'hidden');
    headlines.bxSlider({
        slideWidth: '99999',
        minSlides: 5,
        maxSlides: 5,
        moveSlides: 1,
        randomStart: true,
        slideMargin: 0,
        pager: false,
        controls: true,
        auto: true,
        responsive: true,
        onSliderLoad: function() {
            headlines.css('visibility', 'visible');
        }
    });
});
</script>

<div class="home-headlines">
    <ul class="home-headlines-items">
        <?php
        $headlines_posts = new WP_Query(array(
            'orderby'        => 'date',
            'order'          => 'DESC',
            'category_name'  => NUVEM_HOME_HEADLINES_SLUG,
            'posts_per_page' => NUVEM_HOME_HEADLINES_LIMIT,
        ));
        while($headlines_posts->have_posts()):
            $headlines_posts->the_post();
            if (!has_post_thumbnail($post->ID)):
                continue;
            endif;
        ?>
        <li class="home-headlines-item">
            <a href="<?php the_permalink() ?>" class="home-headlines-link"><?php the_title() ?></a>
            <?php the_post_thumbnail('home-headlines-350x600') ?>
        </li>
        <?php endwhile ?>
    </ul>
</div>

<div class="home-highlight-1">
    <figure class="home-highlight-1-figure-1">
        <img class="home-highlight-1-img-1" src="<?php echo get_stylesheet_directory_uri(); ?>/media/test/highlight-01c1.png" width="1440" height="532" />
    </figure>
    <p class="home-highlight-1-pretitle"><small>Entrevista!</small></p>
    <h1 class="home-highlight-1-title"><a class="home-highlight-1-title-link" href="https://www.youtube.com/watch?v=5zk6jP7f43E&feature=youtu.be">O pernambucano David Munster comenta seu trabalho em um vídeo exclusivo para a Nuvem</a></h1>
    <figure class="home-highlight-1-figure-2">
        <a class="home-highlight-1-figure-2-link" href="https://www.youtube.com/watch?v=5zk6jP7f43E&feature=youtu.be"><img class="home-highlight-1-img-2" src="<?php echo get_stylesheet_directory_uri(); ?>/media/test/highlight-01c2.png" width="352" height="443" /></a>
    </figure>
</div>

<section class="home-news">
    <?php
    $news_posts = new WP_Query(array(
        'orderby'        => 'date',
        'order'          => 'DESC',
        'category_name'  => NUVEM_HOME_NEWS_SLUG,
        'posts_per_page' => NUVEM_HOME_NEWS_LIMIT,
    ));
    while($news_posts->have_posts()): $news_posts->the_post(); ?>
    <section class="home-news-item">
        <?php if (has_post_thumbnail()): ?>
        <figure class="home-news-figure">
            <a href="<?php the_permalink() ?>" class="home-news-image-link"><?php the_post_thumbnail('home-news-348x213') ?></a>
        </figure>
        <?php endif; ?>
        <?php if ($value = get_post_meta($post->ID, '_post_locale', true)): ?>
        <p class="home-news-pretitle"><a href="<?php the_permalink() ?>" class="home-news-pretitle-link"><?php echo $value; ?></a></p>
        <?php endif; ?>
        <h1 class="home-news-title"><a href="<?php the_permalink() ?>" class="home-news-title-link"><?php the_title() ?></a></h1>
        <p class="home-news-subtitle"><a href="<?php the_permalink() ?>" class="home-news-link"><?php echo get_the_excerpt() ?></a></p>
    </section>
    <?php endwhile ?>
    <p class="home-news-seemore"><a class="home-news-seemore-link" href="<?php echo './?category_name=' . NUVEM_NEWS_CATEGORY_SLUG ?>">Veja todas as últimas</a></p>
</section>

<?php
$hightlight2 = new WP_Query(array(
    'p'              => get_option(NUVEM_OPTION_STICK_HOME_HIGHLIGHT2),
    'post_type'      => 'artist',
));

if ($hightlight2->have_posts()):
    $hightlight2->the_post();

    $photo = get_post_meta($post->ID, '_artist_home_photo', true);
    $work = get_post_meta($post->ID, '_artist_home_work', true);
    $quote = get_post_meta($post->ID, '_artist_home_quote', true);

    if (!empty($photo) && !empty($work) && !empty($quote)):
?>
<div class="highlight-2">
    <blockquote class="container">
        <figure class="highlight-2-figure">
            <img class="highlight-2-img" src="<?php echo $photo ?>" width="605" height="695" />
        </figure>
        <p class="highlight-2-quote"><a class="highlight-2-quote-link" href="<?php the_permalink() ?>"><?php echo $quote ?></a></p>
        <footer class="highlight-2-author" class="hcard">
            <img class="highlight-2-author-img" src="<?php echo $work ?>" width="155" height="155" />
            <span class="fn n"><?php the_title() ?></span>
        </footer>
    </blockquote>
</div>
<?php endif; endif ?>

<section class="home-partners">
    <h1 class="home-partners-title">Conheça os parceiros da nuvem</h1>
    <ul class="home-partners-items">
        <li class="home-partners-item"><a href="http://umacapsula.com/" class="uma-capsula">Uma Cápsula</a></li>
        <li class="home-partners-item"><a href="http://www.casadaluz.net" class="casa-da-luz">Casa da Luz</a></li>
        <li class="home-partners-item"><a href="http://www.facebook.com/doutrojeito" class="doutro-jeito">D'Outro Jeito</a></li>
        <li class="home-partners-item"><a href="http://www.maquina.art.br/" class="maquina">Maquina</a></li>
        <li class="home-partners-item"><a href="http://mionline.com.br/" class="mi">Mi</a></li>
        <li class="home-partners-item"><a href="http://contra.cc/" class="contra">Contra</a></li>
        <li class="home-partners-item"><a href="http://www.grupoacidum.art.br" class="acidum">Acidum</a></li>
        <li class="home-partners-item"><a href="http://www.imaginaria.cc" class="imaginaria">Imaginária</a></li>
        <li class="home-partners-item"><a href="http://cargocollective.com/raulluna" class="cargo-collective">Cargo Collective</a></li>
        <li class="home-partners-item"><a href="http://www.zupi.com.br" class="schizzi-books">Schizzi Books</a></li>
    </ul>
</section>

<?php get_footer(); ?>