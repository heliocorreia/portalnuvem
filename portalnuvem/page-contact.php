<?php
/*
Template Name: Contact
*/

get_header();
?><header class="content-hd">
    <div class="content-hd--container">
        <?php get_template_part('partials/breadcrumb'); ?>
        <h1 class="content-hd--title"><?php the_title() ?></h1>
    </div>
</header>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&extension=.js"></script>
<script type="text/javascript">
google.maps.event.addDomListener(window, 'load', init);
var map;
function init() {
    var mapOptions = {
        center: new google.maps.LatLng(-8.0886932, -34.8855107),
        disableDoubleClickZoom: true,
        draggable : true,
        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
        },
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        overviewMapControl: false,
        panControl: false,
        rotateControl: false,
        scaleControl: true,
        scrollwheel: false,
        streetViewControl: true,
        zoom: 16,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL,
        },
    }

    var mapElement = document.getElementById('map');
    var map = new google.maps.Map(mapElement, mapOptions);
    var locations = [
        ['Nuvem', -8.0886932, -34.8855107]
    ];

    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map,
            title: locations[i][0]
        });
    }
}
</script>
<style>
.gmnoprint img { max-width: none; }
</style>
<div id="map" style="width:100%; height:310px;"></div>

<div class="content-bd">
    <div class="content-bd--container">
        <section class="page-contact--content">
            <div class="page-contact--entry">
                <h1 class="page-contact--title">Pessoalmente</h1>
                <p class="page-contact--address">Av. Herculano Bandeira . nº 513<br />
                    Pina . Recife . PE<br />
                    CEP 51110-131</p>
            </div>
            <div class="page-contact--entry">
                <h1 class="page-contact--title">Por telefone ou e-mail</h1>
                <p class="page-contact--address">Fone: 81 3052.4530 | 81 8175.7208<br />
                    nuvempro@gmail.com<br />
                    portalnuvem@gmail.com</p>
            </div>

            <form class="page-contact--form" action="<?php echo admin_url('admin-ajax.php') ?>" method="post">
                <input type="hidden" name="nonce" value="<?php echo wp_create_nonce(NUVEM_NONCE_CONTACT) ?>" />
                <input type="hidden" name="action" value="<?php echo NUVEM_ACTION_CONTACT ?>" />
                <input type="hidden" name="redirect" value="<?php echo implode('/', array_slice(explode('/', get_the_permalink()), 0, 3)) . $_SERVER['REQUEST_URI'] ?>" />

                <p class="page-contact--intro">Ou use o formulário</p>
                <fieldset class="page-contact--fieldset">
                    <p>
                        <label for="page-contact--fullname">Nome</label>
                        <input type="text" class="page-contact--fullname" id="page-contact--fullname" name="fullname" value="" />
                    </p>
                    <p>
                        <label for="page-contact--mail">E-mail de contato</label>
                        <input type="text" class="page-contact--mail" id="page-contact--mail" name="mail" value="" />
                    </p>
                    <p>
                        <label for="page-contact--message">Mensagem</label>
                        <textarea class="page-contact--message" id="page-contact--message" name="message" rows="6"></textarea>
                    </p>
                </fieldset>
                <p>A gente promete te responder o mais rápido possível, tá?</p>
                <p><input name="submit" class="page-contact--submit" data-toggle-value="Enviando..." type="submit" value="Enviar" /></p>
            </form>
        </section>
    </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($) {
    $('.page-contact--form').submit(function(e){
        if (!'FormData' in window) {
            return true;
        }

        e.preventDefault();
        var $form = $(this),
            $submit = $form.find('.page-contact--submit'),
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

<?php get_footer(); ?>
