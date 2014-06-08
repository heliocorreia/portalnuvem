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
        controls: false,
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
        <?php $headlines_posts = new WP_Query(array(
            'orderby'        => 'date',
            'order'          => 'DESC',
            'category_name'  => NUVEM_HOME_HEADLINES_SLUG,
            'posts_per_page' => NUVEM_HOME_HEADLINES_LIMIT,
        )); ?>
        <?php while($headlines_posts->have_posts()):
            $headlines_posts->the_post();
            if (!has_post_thumbnail($post->ID)):
                continue;
            endif;
        ?>
        <li class="home-headlines-item">
            <?php the_post_thumbnail('home-headlines-350x600') ?>
            <a href="<?php the_permalink() ?>" class="home-headlines-link"><?php the_title() ?></a>
        </li>
        <?php endwhile ?>
    </ul>
</div>

<div class="home-highlight-1">
    <figure class="home-highlight-1-figure-1">
        <img class="home-highlight-1-img-1" src="<?php echo get_stylesheet_directory_uri(); ?>/media/test/highlight-01c1.png" width="1440" height="532" />
    </figure>
    <p class="home-highlight-1-pretitle"><small>Entrevista</small></p>
    <h1 class="home-highlight-1-title"><a class="home-highlight-1-link" href="https://www.youtube.com/watch?v=5zk6jP7f43E&feature=youtu.be">O pernambucano David Munster comenta seu trabalho em um vídeo exclusivo para a Nuvem</a></h1>
    <figure class="home-highlight-1-figure-2">
        <img class="home-highlight-1-img-2" src="<?php echo get_stylesheet_directory_uri(); ?>/media/test/highlight-01c2.png" width="352" height="443" />
    </figure>
</div>

<section class="home-news">
    <section class="home-news-item">
        <figure class="home-news-figure">
            <img src="http://portalnuvem.art.br/wp/wp-content/uploads/2014/06/derlon-vilaocupada-348x213.png" width="348" height="213" />
        </figure>
        <p class="home-news-pretitle"><small>Recife - PE</small></p>
        <h1 class="home-news-title">Derlon no exterior</h1>
        <p class="home-news-subtitle"><a href="http://portalnuvem.art.br/wp/?p=147" class="home-news-link">Nosso parceiro de Nuvem, Derlon, foi convidado para mais um trabalho no exterior. Dessa vez, o artista viaja para França.</a></p>
    </section>
    <section class="home-news-item">
        <figure class="home-news-figure">
            <img src="http://portalnuvem.art.br/wp/wp-content/uploads/2014/06/acidum-project-348x213.png" width="348" height="213" />
        </figure>
        <p class="home-news-pretitle"><small>Rio de Janeiro - RJ</small></p>
        <h1 class="home-news-title">Acidum Project</h1>
        <p class="home-news-subtitle"><a href="http://portalnuvem.art.br/wp/?p=143" class="home-news-link">O Acidum Project de Robézio Marqs e Tereza Dequinta fez as malas e já está no Rio de Janeiro.</a></p>
    </section>
    <section class="home-news-item">
        <figure class="home-news-figure">
            <img src="http://portalnuvem.art.br/wp/wp-content/uploads/2014/06/edital-itau-348x213.png" width="348" height="213" />
        </figure>
        <p class="home-news-pretitle"><small>Edital</small></p>
        <h1 class="home-news-title">Itaú Cultural 2014</h1>
        <p class="home-news-subtitle"><a href="http://portalnuvem.art.br/wp/?p=134" class="home-news-link">Entre os dias 2 de junho e 18 de julho, o Itaú Cultural recebe projetos de design gráfico que tenham a cidade como tema, suporte ou discurso.</a></p>
    </section>
    <p class="home-news-seemore"><a class="home-news-seemore-link" href="<?php echo './?cat=1' ?>">Veja todas as últimas</a></p>
</section>

<div class="highlight-2">
    <blockquote class="container">
        <figure class="highlight-2-figure">
            <img class="highlight-2-img" src="<?php echo get_stylesheet_directory_uri(); ?>/media/test/highlight-02a1.png" width="605" height="695" />
        </figure>
        <p class="highlight-2-quote"><a class="highlight-2-quote-link" href="http://portalnuvem.art.br/wp/?artist=jotazeroff">Repudio esse sistema capitalista que aliena e desumaniza as pessoas tirando o real valor da vida transformando-a num produto, seja o capitalismo ou qualquer outro sistema.</a></p>
        <footer class="highlight-2-author" class="hcard">
            <img class="highlight-2-author-img" src="<?php echo get_stylesheet_directory_uri(); ?>/media/test/highlight-02a2.png" width="155" height="155" />
            <span class="fn n">Jota Zeroff</span>
        </footer>
    </blockquote>
</div>

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