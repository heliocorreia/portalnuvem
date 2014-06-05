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
        <div id="ft--xtra">
            <div class="container">
                <dl class="sponsorship">
                    <dt class="incentive">Incentivo:</dt>
                    <dd class="entity funcultura"><a class="entity-entry" href="http://www.pe.gov.br/programas/funcultura/">Funcultura</a></dd>
                    <dd class="entity fundarpe"><a class="entity-entry" href="http://www.pe.gov.br/orgaos/fundarpe-fundacao-do-patrimonio-historico-e-artistico-de-pernambuco/">Fundarpe</a></dd>
                    <dd class="entity secretaria-pe"><a class="entity-entry" href="http://www.pe.gov.br/">Secretaria de Cultura</a></dd>
                    <dt class="realization">Realização:</dt>
                    <dd class="entity nuvem-gm"><span class="entity-entry" >Nuvem <span>Guga Marques</span></span></dd>
                </dl>
            </div>
        </div>
    </footer>
</body>
</html>