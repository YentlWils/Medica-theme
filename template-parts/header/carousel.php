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
    endif;

    $slider = getSlides(array(
        'limit' => '6'
    ));

    if ($slider):
?>

<div class="medica-carousel <?php echo $carousel_modifier ?>">
    <div class="medica-carousel__holder owl-carousel">
        <?php

            foreach ($slider as $post):
                setup_postdata($post);

                // - custom variables -
                $custom = get_post_custom(get_the_ID());

                $subtitle = $custom["tf_slider_subtitle"][0];
        ?>
                <div class="medica-carousel__item medica-carousel__item--filter" style="background-image: url('<?php echo the_post_thumbnail_url( 'full' ) ?>')">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-8 col-lg-6 col-centered text-center medica-carousel__slider-content">
                                <div class="medica-carousel__title text-uppercase"><?php the_title(); ?></div>
                                <div class="medica-carousel__sub-title text-lowercase">
                                    <span><?php echo $subtitle ?></span></div>
                                <div class="medica-carousel__link text-lowercase"><a href="<?php echo get_post_permalink(get_the_ID()) ?>"><?php _e( 'ontdek meer', 'medica-theme' ); ?></a></div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
              endforeach;
        ?>
    </div>
</div>
<?php
    endif;