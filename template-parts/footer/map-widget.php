<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 12/06/17
 * Time: 22:03
 */
?>

<div class="container">
    <script type="application/javascript">
        var medicaMarkers = {};
        var medicaMapIcon = "<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/images/assets/marker.png";
    </script>
    <div class="row">
        <div class="col-md-12 hidden-xs">
            <div id="map" class="medica-map__map"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 no-padding--right">
            <script type="application/javascript">
                medicaMarkers["bar"] = {
                    lat: 50.882009,
                    lng: 4.688499
                };
            </script>
            <div class="medica-map__poi medica-map__poi--active text-center" data-marker="bar">
                <div class="medica-map__title text-uppercase">Doc's bar</div>
                <div class="medica-map__address">Brusselsestraat 24, 3000 Leuven</div>
                <div class="medica-map__link text-lowercase"><a href="https://www.google.com/maps?daddr=50.882009,4.688499" target="_blank"><?php _e( 'plan route', 'medica-theme' ); ?></a></div>
            </div>
        </div>
        <div class="col-md-6 no-padding--left">
            <script type="application/javascript">
                medicaMarkers["fac"] = {
                    lat: 50.8803796,
                    lng: 4.6727432
                };
            </script>
            <div class="medica-map__poi text-center" data-marker="fac">
                <div class="medica-map__title text-uppercase">Faculteit</div>
                <div class="medica-map__address">Herestraat 49, 3000 Leuven</div>
                <div class="medica-map__link text-lowercase"><a href="https://www.google.com/maps?daddr=50.8803796,4.6727432" target="_blank"><?php _e( 'plan route', 'medica-theme' ); ?></a></div>
            </div>
        </div>
    </div>
</div>
