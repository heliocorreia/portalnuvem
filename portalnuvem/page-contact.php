<?php
/*
Template Name: Contact
*/

get_header(); ?>

<header class="content-hd">
    <div class="content-hd--container">
        <?php get_template_part('partials/breadcrumb'); ?>
        <h1 class="content-hd--title"><?php the_title() ?></h1>
    </div>
</header>

<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3950.470146439231!2d-34.8791637!3d-8.0534308!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7ab18941f03dff5%3A0xa2f399940f595dc2!2sRua+Capit%C3%A3o+Lima%2C+277+-+Santo+Amaro!5e0!3m2!1sen!2s!4v1402473738113" width="100%" height="310" frameborder="0" style="border:0"></iframe>

<?php
/*// http://googlemapbuilder.mynameisdonald.com/
?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAX_KE_8Wqovj7552Gmi49aZcvDVWqkS7A&sensor=false&extension=.js"></script>
<script type="text/javascript"> google.maps.event.addDomListener(window, 'load', init);
var map;

function init() {
    var mapOptions = {
        center: new google.maps.LatLng(-8.054518,-34.879053),
        zoom: 17,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL,
        },
        disableDoubleClickZoom: true,
        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
        },
        scaleControl: true,
        scrollwheel: false,
        streetViewControl: true,
        draggable : true,
        overviewMapControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,


    }

    var mapElement = document.getElementById('map');
    var map = new google.maps.Map(mapElement, mapOptions);
    var locations = [
        ['Rua Capitão Lima', -8.053663, -34.8787208]
    ];

    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            icon: '',
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
        });
    }
}
</script>

<style>
#map{
    width:100%;
    height:1310px;
}
</style>
<?php /**/ ?>

<div class="content-bd">
    <div class="content-bd--container">
        <section class="page-contact--content">
            <div class="page-contact--entry">
                <h1 class="page-contact--title">Pessoalmente</h1>
                <p class="page-contact--address">Rua Capitão Lima . nº 277 . 1º andar . sala 01<br />
                    Santo Amaro . Recife . PE<br />
                    CEP 50040-080</p>
            </div>
            <div class="page-contact--entry">
                <h1 class="page-contact--title">Por telefone ou e-mail</h1>
                <p class="page-contact--address">Fone: 81 3052.4530 | 81 3456 7899<br />
                    nuvem@nuvemproducoes.com.br<br />
                    nuvempro@gmail.com</p>
            </div>
        </section>
    </div>
</div>

<?php get_footer(); ?>