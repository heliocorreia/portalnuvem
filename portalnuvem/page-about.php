<?php
/*
Template Name: About Us
*/

get_header();
the_post(); 
?>

<header class="content-hd">
    <div class="content-hd--container">
        <?php get_template_part('partials/breadcrumb'); ?>
        <h1 class="content-hd--title"><?php the_title() ?></h1>
    </div>
</header>

<section class="page-about">
    <div class="page-about--container">
        <article class="page-about--content">
            <?php the_content(); ?>
        </article>
        <?php
        $attachments = get_posts(array(
            'numberposts' => -1,
            'order'       => 'ASC',
            'orderby'     => 'title',
            'post_parent' => $post->ID,
            'post_status' => null,
            'post_type'   => 'attachment',
        ));
        if ($attachments):
        ?>
        <aside class="page-about--aside">
            <?php foreach ($attachments as $attachment): ?>
                <div class="page-about--attachment">
                    <figure class="page-about--attachment-figure">
                        <?php echo wp_get_attachment_image($attachment->ID, 'quemsomos-attachment-298x298'); ?>
                    </figure>
                    <p class="page-about--attachment-title"><?php echo $attachment->post_title; ?></p>
                    <p class="page-about--attachment-excerpt"><?php echo $attachment->post_excerpt; ?></p>
                </div>
            <?php endforeach; ?>
        </aside>
        <?php endif ?>
    </div>
</div>

<section class="page-about--subscribe">
    <?php get_template_part('partials/subscribe'); ?>
</section>

<?php get_footer(); ?>