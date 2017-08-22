<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 12/06/17
 * Time: 22:03
 */


$attr = array(
    'limit' => '4'
);

$poi = getPoi($attr);

if ($poi):
?>

<div class="container-no">
    <script type="application/javascript">
        var medicaMarkers = {};
        var medicaMapIcon = "<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/images/assets/marker.png";
        var medicaMapIconInactive = "<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/images/assets/marker-inactive.png";
    </script>
    <div class="row">
        <div class="col-md-12 hidden-xs">
            <div id="map" class="medica-map__map"></div>
        </div>
    </div>
    <div class="row">
    <?php

    $index = 1;
    $widthCol = 12 / count($poi);

    foreach ($poi as $post):
        setup_postdata($post);

        // - custom variables -
        $custom = get_post_custom(get_the_ID());

        $address = $custom["tf_poi_address"][0];

        $lat = $custom["tf_poi_lat"][0];
        $lng = $custom["tf_poi_lng"][0];

        $activeClass = $index == 1 ?"medica-map__poi--active" : "";

        if($index == count($poi)){
            $paddingClass = "no-padding--left";
        }else if ($index == 1){
            $paddingClass = "no-padding--right";
        }else{
            $paddingClass = "no-padding--left no-padding--right";
        }

        $index++;

        ?>

        <div class="col-md-<?php echo $widthCol; ?> <?php echo $paddingClass ?>">
            <script type="application/javascript">
                medicaMarkers["<?php echo $post->post_name ?>"] = {
                    lat: <?php echo $lat; ?>,
                    lng: <?php echo $lng; ?>
                };
            </script>
            <div class="medica-map__poi <?php echo $activeClass; ?> text-center" data-marker="<?php echo $post->post_name ?>">
                <div class="medica-map__title text-uppercase"><?php the_title(); ?></div>
                <div class="medica-map__address"><?php echo $address; ?></div>
                <div class="medica-map__link text-lowercase"><a href="https://www.google.com/maps?daddr=<?php echo $lat . "," . $lng ; ?>" target="_blank"><?php _e( 'plan route', 'medica-theme' ); ?></a></div>
            </div>
        </div>
        <?php
            endforeach;
        ?>
    </div>
</div>
<?php
endif;

unset($poi);