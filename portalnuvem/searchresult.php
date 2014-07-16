<section class="searchresult--entry">
    <p class="searchresult--pretitle"><span class="searchresult--date"><?php the_time('d M/Y'); ?></span></p>
    <h1 class="searchresult--title"><a class="searchresult--title-link" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
    <p class="searchresult--subtitle"><a class="searchresult--subtitle-link" href="<?php the_permalink() ?>"><?php echo get_the_excerpt() ?></a></p>
</section>
