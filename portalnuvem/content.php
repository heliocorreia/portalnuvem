<section class="content--entry">
    <?php if (has_post_thumbnail()): ?>
    <figure class="content--figure">
        <a href="<?php the_permalink(); ?>" class="content--image-link"><?php the_post_thumbnail('348x213') ?></a>
    </figure>
    <?php endif ?>
    <p class="content--pretitle"><small>Recife - PE</small></p>
    <h1 class="content--title"><a href="<?php the_permalink(); ?>" class="content--title-link"><?php the_title() ?></a></h1>
    <p class="content--subtitle"><a href="<?php the_permalink(); ?>" class="content--subtitle-link"><?php echo get_the_excerpt(); ?></a></p>
</section>
