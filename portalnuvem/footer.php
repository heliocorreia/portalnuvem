<?php wp_footer(); ?>
    </section>
    <footer id="ft">
        <div class="container">
            <nav id="ft--nav-footer">
                <?php wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container' => 'div',
                    'menu_class' => 'nav-menu',
                    'depth' => 1,
                )); ?>
            </nav>
            <nav id="ft--nav-social">
                <?php wp_nav_menu(array(
                    'theme_location' => 'social',
                    'container' => 'div',
                    'menu_class' => 'nav-menu',
                    'depth' => 1,
                )); ?>
            </nav>
            <p id="ft--copy">Nuvem Produções <?php echo date('Y')?> - Todos os direitos reservados</p>
            <p id="ft--made-in">Feito em Recife - Pernambuco</p>
        </div>
    </footer>
</body>
</html>