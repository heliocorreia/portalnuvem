<?php wp_footer(); ?>
    </div>
    <div id="ft">
        <div class="container">
            <nav id="nav-footer">
                <?php wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container' => 'div',
                    'menu_class' => 'nav-menu',
                    'depth' => 1,
                )); ?>
            </nav>
            <nav id="nav-social">
                <?php wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container' => 'div',
                    'menu_class' => 'nav-menu',
                    'depth' => 1,
                )); ?>
            </nav>
            <p class="ft-copy">Nuvem Produções <?php echo date('Y')?> - Todos os direitos reservados</p>
            <p class="ft-madein">Feito em Recife - Pernambuco</p>
        </div>
    </div>
</body>
</html>