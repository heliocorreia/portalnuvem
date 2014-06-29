<div class="subscribe">
<form class="subscribe--form" action="<?php echo admin_url('admin-ajax.php') ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce(NUVEM_NONCE_SUBSCRIBE) ?>" />
    <input type="hidden" name="action" value="<?php echo NUVEM_ACTION_SUBSCRIBE ?>" />
    <input type="hidden" name="redirect" value="<?php echo implode('/', array_slice(explode('/', get_the_permalink()), 0, 3)) . $_SERVER['REQUEST_URI'] ?>" />

    <input id="subscribe--agreement" class="subscribe--agreement-checkbox" type="checkbox" checked="checked" />
    <label for="subscribe--agreement" class="subscribe--agreement-label">Quero me cadastrar</label>
    <h1 class="subscribe--title">Nuvem</h1>
    <p class="subscribe--intro">Quer divulgar o seu trabalho no banco de artistas do Portal Nuvem?</p>
    <fieldset class="subscribe--fieldset">
        <p>
            <label for="subscribe--firstname">Nome</label>
            <input type="text" class="subscribe--firstname" id="subscribe--firstname" name="firstname" value="" />
        </p>
        <p>
            <label for="subscribe--lastname">Sobrenome</label>
            <input type="text" class="subscribe--lastname" id="subscribe--lastname" name="lastname" value="" />
        </p>
        <p>
            <label for="subscribe--city">Cidade</label>
            <input type="text" class="subscribe--city" id="subscribe--city" name="city" value="" />
        </p>
        <p>
            <label for="subscribe--state">Estado</label>
            <select id="subscribe--state" name="state">
                <option>--</option>
                <?php foreach(my_nuvem_states() as $val): ?>
                <option><?php echo $val ?></option>
                <?php endforeach ?>
            </select>
        </p>
        <p>
            <label for="subscribe--mail">E-mail de contato</label>
            <input type="text" class="subscribe--mail" id="subscribe--mail" name="mail" value="" />
        </p>
        <p>
            <label for="subscribe--site">Website</label>
            <input type="text" class="subscribe--site" id="subscribe--site" name="site" value="" />
        </p>
        <p>
            <label for="subscribe--image">Imagem</label>
            <input type="file" class="subscribe--image" id="subscribe--image" name="image" />
        </p>
        <p>
            <label for="subscribe--release">Release</label>
            <textarea class="subscribe--release" id="subscribe--release" name="release"></textarea>
        </p>
    </fieldset>
    <p>Ao clicar em Cadastrar, você concorda com os <a href="<?php bloginfo('url'); ?>/wp-content/uploads/2014/06/TERMOS_DE_USO_CADASTRO_DE_ARTISTAS.pdf">termos de uso</a> da Nuvem Produções.</p>
    <p><input name="subscribe" class="input--submit" type="submit" value="Cadastrar" /></p>
</form>
</div>
<script type="text/javascript">
jQuery(document).ready(function($) {
    $('.subscribe--form').submit(function(e){
        if (!'FormData' in window) {
            return;
        }

        e.preventDefault();
        var $form = $(this),
            formData = new FormData($form.get(0));

        jQuery.ajax({
            type: 'post',
            dataType: 'json',
            url: $form.attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            success: function(data, textStatus, jqXHR) {
                alert(data.messages.join('\n\n'));
                if (textStatus == 'success') {
                    $form.each(function(){
                        this.reset();
                    });
                }
            }
        });
    });
});
</script>
