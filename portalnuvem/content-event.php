<section class="event--entry">
    <?php
    $event_site = get_post_meta($post->ID, '_event_site', true);
    if (has_post_thumbnail()): ?>
    <figure class="event--figure">
        <?php
        if ($event_site):
            ?><a class="event--img-link" href="http://<?php echo $event_site; ?>"><?php
        endif;

        the_post_thumbnail('348x213');

        if ($event_site):
            ?></a><?php
        endif;
        ?>
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

    <?php if ($event_site): ?>
    <p class="event--site"><a class="event--site-link" href="http://<?php echo $event_site; ?>"><?php echo $event_site; ?></a></p>
    <?php endif; ?>
</section>
