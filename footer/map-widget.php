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
    </script>
    <div class="row">
        <div class="col-md-12">
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
                <div class="medica-map__link"><a href="#">plan route</a></div>
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
                <div class="medica-map__link"><a href="#">plan route</a></div>
            </div>
        </div>
    </div>
</div>
