<!doctype html>
<!--[if IE 9]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php wp_title(' | ', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <meta name="description" content="<?php bloginfo('description'); ?>" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/media/compiled/css/screen.css?1" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Vollkorn:400italic,400' rel='stylesheet' type='text/css'>
    <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/media/favicon.png" />
    <meta name="viewport" content="width=device-width" />
    <meta property="fb:app_id" content="<?php echo NUVEM_FACEBOOK_APPID ?>"/>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header id="hd">
        <div class="container">
            <h1 id="hd--logo">
                <a href="<?php bloginfo('url'); ?>">Nuvem</a>
            </h1>
            <nav id="hd--nav-social">
                <?php wp_nav_menu(array(
                    'theme_location' => 'social',
                    'container' => 'div',
                    'menu_class' => 'nav-menu',
                    'depth' => 1,
                )); ?>
            </nav>
            <label for="nav-main--cb" class="nav-main--lb">Menu</label>
            <input id="nav-main--cb" name="nav[]" type="radio" />
            <nav id="hd--nav-main">
                <?php wp_nav_menu(array(
                    'theme_location' => 'main',
                    'container' => 'div',
                    'menu_class' => 'nav-menu',
                    'depth' => 1,
                )); ?>
            </nav>
            <?php get_template_part('partials/searchform'); ?>
        </div>
    </header>
    <section id="bd">
