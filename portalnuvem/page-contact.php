<?php
/*
Template Name: Contact
*/

get_header(); ?>

<header class="content-hd">
    <div class="content-hd--container">
        <?php get_template_part('partials/breadcrumb'); ?>
        <h1 class="content-hd--title"><?php the_title() ?></h1>
    </div>
</header>

<div class="content-bd">
    <div class="content-bd--container">
        <section class="page-contact--content">
            <div class="page-contact--entry">
                <h1 class="page-contact--title">Pessoalmente</h1>
                <p class="page-contact--address">Rua Capitão Lima . nº 277 . 1º andar . sala 01<br />
                    Santo Amaro . Recife . PE<br />
                    CEP 50040-080</p>
            </div>
            <div class="page-contact--entry">
                <h1 class="page-contact--title">Por telefone ou e-mail</h1>
                <p class="page-contact--address">Fone: 81 3052.4530 | 81 3456 7899<br />
                    nuvem@nuvemproducoes.com.br<br />
                    nuvempro@gmail.com</p>
            </div>
        </section>
    </div>
</div>

<?php get_footer(); ?>