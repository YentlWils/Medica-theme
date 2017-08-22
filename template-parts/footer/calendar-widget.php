<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 8/06/17
 * Time: 09:31
 */

$attr = array(
    'limit' => '4'
);

$events = getEvents($attr);

if ($events):

?>

<div class="container-no">
    <div class="row">
        <div class="col-md-12">
            <div class="calendar-widget__row">
                <div class="calendar-widget__solid-color">
                    <?php

                        $index = 1;
                        foreach ($events as $post):
                            setup_postdata($post);

                            // - custom variables -
                            $custom = get_post_custom(get_the_ID());
                            $startDate = $custom["tf_events_startdate"][0];

                            // - local time format -
                            $time_format = get_option('time_format');
                            $startTime = date($time_format, $startDate);

                            $hiddenClass = "";

                            if($index > 1){
                                $hiddenClass = "hidden-xs";
                                if($index > 2){
                                    $hiddenClass .= " hidden-sm";
                                }
                            }

                            $index++;

                            ?>

                            <div class="col-sm-6 col-md-3 calendar-widget <?php echo $hiddenClass ?>" data-bg-img="<?php echo the_post_thumbnail_url( 'full' ) ?>">
                                <div class="calendar-widget__table">
                                    <div class="calendar-widget__header">
                                        <div class="calendar-widget__day">
                                            <span class="day"><?php echo date_i18n("d", $startDate); ?></span>
                                            <span class="month text-center text-lowercase"><?php echo date_i18n("M", $startDate); ?></span>
                                        </div>
                                    </div>
                                    <div class="calendar-widget__body">
                                        <div class="calendar-widget__title text-uppercase">
                                            <?php the_title(); ?>
                                        </div>
                                        <div class="calendar-widget__location">
                                            <?php echo $startTime; ?><span><?php echo $custom["tf_events_location"][0]; ?></span>
                                        </div>
                                        <div class="calendar-widget__date text-lowercase">
                                            <?php echo date_i18n("l j F Y", $startDate); ?>
                                        </div>
                                        <div class="calendar-widget__link text-lowercase">
                                            <a href="<?php echo get_post_permalink(get_the_ID()) ?>"><?php _e( 'ontdek meer', 'medica-theme' ); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php

                        endforeach;
                    ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

endif;

unset($events);