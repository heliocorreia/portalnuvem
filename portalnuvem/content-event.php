<section class="event--entry">
    <?php if (has_post_thumbnail()): ?>
    <figure class="event--figure">
        <?php the_post_thumbnail('348x213') ?>
    </figure>
    <?php endif ?>
    <h1 class="event--title"><?php the_title() ?></h1>
    <p class="event--posttitle"><small>DD MMM / Cidade - UF</small></p>
    <p class="event--subtitle"><?php echo get_the_excerpt(); ?></p>
</section>
