<!doctype html>
<!--[if IE 9]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php wp_title(' | ', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <meta name="description" content="<?php bloginfo('description'); ?>" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/media/compiled/css/screen.css" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header id="hd">
        <div class="container">
            <h1>
                <a href="<?php bloginfo('url'); ?>">Nuvem</a>
            </h1>
            <nav id="nav-social">
                <?php wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container' => 'div',
                    'menu_class' => 'nav-menu',
                    'depth' => 1,
                )); ?>
            </nav>
            <nav id="nav-main">
                <?php wp_nav_menu(array(
                    'theme_location' => 'main',
                    'container' => 'div',
                    'menu_class' => 'nav-menu',
                    'depth' => 1,
                )); ?>
            </nav>
        </div>
    </header>
    <div id="bd">
