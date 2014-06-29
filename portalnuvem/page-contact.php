<?php
/*
Template Name: Contact
*/

if (isset($_POST['submit'])) {
    $fields = array('fullname', 'mail', 'message');
    foreach($fields as $field) {
        $_POST[$field] = stripslashes(trim($_POST[$field]));
    }

    if (!isset($hasError)) {
        $emailTo = get_option('admin_email');
        $subject = "[CONTATO] $_POST[fullname]";
        $body = join("\n", array(
            "Nome: $_POST[fullname]",
            "E-mail: $_POST[city] $_POST[state]",
            "Mensagem: $_POST[release]"
        ));
        $headers = 'From: '.$_POST['fullname'].' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $_POST['mail'];
        $emailSent = (bool)wp_mail($emailTo, $subject, $body, $headers);
    }
}

get_header();

?><header class="content-hd">
    <div class="content-hd--container">
        <?php get_template_part('partials/breadcrumb'); ?>
        <h1 class="content-hd--title"><?php the_title() ?></h1>
    </div>
</header>

<?php //* ?><script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&extension=.js"></script><?php //*/ ?>
<?php /* ?><script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo NUVEM_GOOGLE_API_KEY ?>&sensor=false&extension=.js"></script><?php //*/ ?>
<?php //* ?>
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
<?php //*/ ?>

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

            <form class="page-contact--form" action="<?php the_permalink(); ?>" method="post">
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
                <p><input name="submit" class="page-contact--submit" type="submit" value="Enviar" /></p>
            </form>
        </section>
    </div>
</div>

<?php get_footer(); ?>
