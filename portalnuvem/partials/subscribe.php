<div class="subscribe">
<form class="subscribe--form" action="<?php echo admin_url('admin-ajax.php') ?>" method="post" enctype="multipart/form-data" data-parsley-validate>
    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce(NUVEM_NONCE_SUBSCRIBE) ?>" />
    <input type="hidden" name="action" value="<?php echo NUVEM_ACTION_SUBSCRIBE ?>" />
    <input type="hidden" name="redirect" value="<?php echo implode('/', array_slice(explode('/', get_the_permalink()), 0, 3)) . $_SERVER['REQUEST_URI'] ?>" />

    <input name="subscribe--agreement[]" id="subscribe--agreement-y" class="subscribe--agreement-radio" type="radio" value="y" />
    <input name="subscribe--agreement[]" id="subscribe--agreement-n" class="subscribe--agreement-radio" type="radio" value="n" checked="checked" />
    <label for="subscribe--agreement-y" class="subscribe--agreement-label-y">Quero me cadastrar</label>
    <label for="subscribe--agreement-n" class="subscribe--agreement-label-n">Não quero me cadastrar</label>

    <h1 class="subscribe--title">Nuvem</h1>
    <p class="subscribe--intro">Quer divulgar o seu trabalho no banco de artistas do Portal Nuvem?</p>
    <fieldset class="subscribe--fieldset">
        <p>
            <label for="subscribe--firstname">Nome</label>
            <input type="text" class="subscribe--firstname" id="subscribe--firstname" name="firstname" value="" required />
        </p>
        <p>
            <label for="subscribe--lastname">Sobrenome</label>
            <input type="text" class="subscribe--lastname" id="subscribe--lastname" name="lastname" value="" required />
        </p>
        <p>
            <label for="subscribe--city">Cidade</label>
            <input type="text" class="subscribe--city" id="subscribe--city" name="city" value="" required />
        </p>
        <p>
            <label for="subscribe--state">Estado</label>
            <select id="subscribe--state" name="state" required>
                <option>--</option>
                <?php foreach(my_nuvem_states() as $val): ?>
                <option><?php echo $val ?></option>
                <?php endforeach ?>
            </select>
        </p>
        <p>
            <label for="subscribe--mail">E-mail de contato</label>
            <input type="email" class="subscribe--mail" id="subscribe--mail" name="mail" value="" required />
        </p>
        <p>
            <label for="subscribe--site">Website</label>
            <input type="url" class="subscribe--site" id="subscribe--site" name="site" value="" />
        </p>
        <p>
            <label for="subscribe--image">Imagem</label>
            <input type="file" class="subscribe--image" id="subscribe--image" name="image" required />
        </p>
        <p>
            <label for="subscribe--release">Release</label>
            <textarea class="subscribe--release" id="subscribe--release" name="release" required></textarea>
        </p>
    </fieldset>
    <p>Ao clicar em Cadastrar, você concorda com os <a href="<?php bloginfo('url'); ?>/wp-content/uploads/2014/06/TERMOS_DE_USO_CADASTRO_DE_ARTISTAS.pdf">termos de uso</a> da Nuvem Produções.</p>
    <p><input name="subscribe" class="input--submit" type="submit" data-toggle-value="Enviando..." value="Cadastrar" /></p>
</form>
</div>
<script type="text/javascript">
jQuery(document).ready(function($) {
    $('.subscribe--form').submit(function(e){
        if (!'FormData' in window) {
            return true;
        }

        e.preventDefault();

        var $form = $(this);

        if (!$form.parsley().isValid()) {
            return true;
        }

        var $submit = $form.find('.input--submit'),
            class_loading = 'js-loading',
            formData = new FormData($form.get(0)),
            value_initial = $submit.attr('value'),
            value_toggle = $submit.data('toggle-value'),
            toggleSubmitValue = function() {
                $submit.toggleAttr('value', value_initial, value_toggle);
            }

        jQuery.ajax({
            type: 'post',
            dataType: 'json',
            url: $form.attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function(jqXHR, settings) {
                $form.addClass(class_loading);
                toggleSubmitValue();
            },
            success: function(data, textStatus, jqXHR) {
                alert(data.messages.join('\n\n'));
                if (textStatus == 'success') {
                    $form.each(function(){
                        this.reset();
                    });
                }
            },
            complete: function(jqXHR, textStatus) {
                toggleSubmitValue();
                $form.removeClass(class_loading);
            }
        });
    });
});
</script>
