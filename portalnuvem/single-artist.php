<?php get_header(); the_post(); ?>

<header class="content-hd">
    <div class="content--container">
        <?php get_template_part('partials/breadcrumb'); ?>
        <?php if ($value = get_post_meta($post->ID, '_artist_locale', true)): ?>
        <p class="content-hd--pretitle"><small><?php echo $value; ?></small></hp>
        <?php endif; ?>
        <h1 class="content-hd--title"><?php the_title(); ?></h1>
    </div>
</header>

<section class="single-artist">
    <div class="single-artist--container">
        <article class="single-artist--content">
            <?php the_content(); ?>
        </article>
        <aside class="single-artist--aside">
            <?php if (has_post_thumbnail()): ?>
            <figure class="single-artist--post-thumbnail">
                <?php the_post_thumbnail('477x558') ?>
            </figure>
            <?php endif ?>
            <?php
            if ($value = get_post_meta($post->ID, '_artist_aside', true)):
                echo $value;
            endif;
            ?>
        </aside>

        <?php
        $attachments = get_posts(array(
            'post_type' => 'attachment',
            'numberposts' => -1,
            'post_status' => null,
            'post_parent' => $post->ID
        ));
        if ($attachments):
        ?>
        <section class="single-artist--attachments">
            <?php foreach ($attachments as $attachment): ?>
                <p class="single-artist--attachment"><?php echo wp_get_attachment_image($attachment->ID, 'artist-attachment-282x322'); ?></p>
            <?php endforeach; ?>
        </section>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>