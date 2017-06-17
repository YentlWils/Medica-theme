<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 8/06/17
 * Time: 07:29
 */
    $carousel_modifier = "";

    if( !is_front_page() ):
        $carousel_modifier = "medica-carousel--condensed";
    endif
?>

<div class="medica-carousel <?php echo $carousel_modifier ?>">
    <div class="medica-carousel__holder owl-carousel">
        <div class="medica-carousel__item medica-carousel__item--filter" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/images/assets/temp/ski.png')">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-6 col-centered text-center medica-carousel__slider-content">
                        <div class="medica-carousel__title text-uppercase">Onze skireis in zwitserland</div>
                        <div class="medica-carousel__sub-title text-lowercase">
                            <span>21-11-1990  tot  16-03-2014</span></div>
                        <div class="medica-carousel__link text-lowercase"><a href="#"><?php _e( 'ontdek meer', 'medica-theme' ); ?></a></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="medica-carousel__item medica-carousel__item--filter" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/images/assets/temp/feest.png')">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-6 col-centered text-center medica-carousel__slider-content">
                        <div class="medica-carousel__title text-uppercase">Cantus avond in hartje leuven</div>
                        <div class="medica-carousel__sub-title text-lowercase">
                            <span>Donderdag</span></div>
                        <div class="medica-carousel__link text-lowercase"><a href="#"><?php _e( 'ontdek meer', 'medica-theme' ); ?></a></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="medica-carousel__item medica-carousel__item--filter" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/images/assets/temp/cantus.png')">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-6 col-centered text-center medica-carousel__slider-content">
                        <div class="medica-carousel__title text-uppercase">weer een stevig Feestje in de doc’s bar</div>
                        <div class="medica-carousel__sub-title text-lowercase">
                            <span>16-03-2014</span></div>
                        <div class="medica-carousel__link text-lowercase"><a href="#"><?php _e( 'ontdek meer', 'medica-theme' ); ?></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
