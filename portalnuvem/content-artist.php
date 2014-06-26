<section class="artist--entry">
    <figure class="artist--entry-figure">
        <a class="artist--entry-figure-link" href="<?php the_permalink() ?>"><?php the_post_thumbnail('348x213') ?></a>
    </figure>
    <h1 class="artist--entry-title"><a class="artist--entry-link" href="<?php the_permalink() ?>"><?php
        the_title();
        if ($state = get_post_meta($post->ID, '_artist_state', true)) {
            echo " ($state)";
        }
    ?></a></h1>
</section>
