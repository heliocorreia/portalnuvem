<label for="nav-search--cb" class="nav-search--lb"></label>
<label for="nav-default--cb" class="nav-search-default--lb"></label>
<form class="search--form" action="<?php bloginfo('url'); ?>">
    <fieldset class="search--fieldset">
        <input class="search--query" type="text" name="s" value="<?php esc_attr_e(stripslashes($_GET['s'])) ?>" />
        <input class="search--submit" type="submit" value="Buscar" />
    </fieldset>
</form>
