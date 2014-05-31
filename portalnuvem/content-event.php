<section class="event--entry">
    <?php if (has_post_thumbnail()): ?>
    <figure class="event--figure">
        <?php the_post_thumbnail('348x213') ?>
    </figure>
    <?php endif ?>

    <h1 class="event--title"><?php the_title() ?></h1>

    <?php
    $period = get_post_meta($post->ID, '_event_period', true);
    $locale = get_post_meta($post->ID, '_event_locale', true);

    if ($period || $locale): ?>
    <p class="event--posttitle">
        <small class="event--period"><?php echo $period; ?></small>
        <?php if ($period && $locale): ?>/<?php endif ?>
        <small class="event--locale"><?php echo $locale; ?></small>
    </p>
    <?php endif; ?>

    <p class="event--subtitle"><?php echo get_the_excerpt(); ?></p>

    <?php if ($value = get_post_meta($post->ID, '_event_site', true)): ?>
    <p class="event--site"><a href="http://<?php echo $value; ?>"><?php echo $value; ?></a></p>
    <?php endif; ?>
</section>
