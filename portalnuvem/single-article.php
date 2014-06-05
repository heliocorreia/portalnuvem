<?php get_header(); the_post(); ?>

<header class="content-hd">
    <div class="content-hd--container">
        <?php get_template_part('partials/breadcrumb'); ?>
        <h1 class="content-hd--title"><?php the_author(); ?></h1>
    </div>
</header>

<section class="single-article">
    <div class="single-article--container">
        <article class="single-article--content">
            <time class="single-article--datetime"><?php the_time('d M/ Y'); ?></time>
            <h1 class="single-article--title"><?php the_title(); ?></h1>
            <?php the_content(); ?>
        </article>
        <aside class="single-article--aside">
            <?php if ($photo284x284 = get_the_author_meta('photo284x284')): ?>
            <figure class="single-article--aside-photo284x284">
                <img src="<?php echo esc_attr($photo284x284); ?>" width="284" height="284" />
            </figure>
            <?php endif; ?>

            <?php if ($description = get_the_author_meta('description')): ?>
            <p class="single-article--aside-description"><?php echo $description; ?></p>
            <?php endif; ?>

            <?php
            $user_url = get_the_author_meta('user_url');
            $facebook = get_the_author_meta('facebook');
            $twitter = get_the_author_meta('twitter');
            $instagram = get_the_author_meta('instagram');

            if ($user_url || $facebook || $twitter || $instagram):
            ?>
            <ul class="single-article--aside-links">
                <?php if ($user_url): ?><li class="single-article--aside-site"><a href="#">Site</a></li><?php endif ?>
                <?php if ($facebook): ?><li class="single-article--aside-facebook"><a href="#">Facebook</a></li><?php endif ?>
                <?php if ($twitter): ?><li class="single-article--aside-twitter"><a href="#">Twitter</a></li><?php endif ?>
                <?php if ($instagram): ?><li class="single-article--aside-instagram"><a href="#">Instagram</a></li><?php endif ?>
            </ul>
            <?php endif; ?>
        </aside>
    </div>
</section>

<?php get_template_part('partials/seemore'); ?>

<?php get_footer(); ?>