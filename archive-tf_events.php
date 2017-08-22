<?php get_header(); ?>
    <div class="medica-carousel__parallax">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <dilv class="medica-breadcrumb">
                        <?php custom_breadcrumbs(); ?>
                    </dilv>
                </div>
            </div>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="row">
                    <div class="col-md-12">
                        <header class="entry-header text-center text-uppercase">
                            <h1 class="entry-title">
                                <?php _e("Kalender", "medica-theme"); ?>
                            </h1>
                        </header>
                    </div>
                </div>
                <?php
                    $month = empty(get_query_var("event_month")) ? date("m") : get_query_var("event_month");
                    $year = empty(get_query_var("event_year")) ? date("Y") : get_query_var("event_year");
                ?>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="calendar-filters">
                            <label><?php _e('Kies een maand', "medica-theme") ?></label>
                            <div class="medica-select">
                                <select name="event_month">
                                    <option value="01" <?php echo $month == "01" ? "selected" : null; ?>><?php _e("January", "medica-theme"); ?></option>
                                    <option value="02" <?php echo $month == "02" ? "selected" : null; ?>><?php _e("February", "medica-theme"); ?></option>
                                    <option value="03" <?php echo $month == "03" ? "selected" : null; ?>><?php _e("March", "medica-theme"); ?></option>
                                    <option value="04" <?php echo $month == "04" ? "selected" : null; ?>><?php _e("April", "medica-theme"); ?></option>
                                    <option value="05" <?php echo $month == "05" ? "selected" : null; ?>><?php _e("May", "medica-theme"); ?></option>
                                    <option value="06" <?php echo $month == "06" ? "selected" : null; ?>><?php _e("June", "medica-theme"); ?></option>
                                    <option value="07" <?php echo $month == "07" ? "selected" : null; ?>><?php _e("July", "medica-theme"); ?></option>
                                    <option value="08" <?php echo $month == "08" ? "selected" : null; ?>><?php _e("August", "medica-theme"); ?></option>
                                    <option value="09" <?php echo $month == "09" ? "selected" : null; ?>><?php _e("September", "medica-theme"); ?></option>
                                    <option value="10" <?php echo $month == "10" ? "selected" : null; ?>><?php _e("October", "medica-theme"); ?></option>
                                    <option value="11" <?php echo $month == "11" ? "selected" : null; ?>><?php _e("November", "medica-theme"); ?></option>
                                    <option value="12" <?php echo $month == "12" ? "selected" : null; ?>><?php _e("December", "medica-theme"); ?></option>
                                </select>
                            </div>
                            <div class="medica-select">
                                <select name="event_year">
                                    <?php
                                    $currentYear = intval(date("Y")); // get the year part of the current date
                                    $lastYear = $currentYear - 1;
                                    $maxYear = $currentYear + 1;

                                    for ($i = $lastYear; $i <= $maxYear; $i++) {
                                        ?>
                                        <option value="<?php echo $i; ?>" <?php echo $i == $year ? "selected" : null; ?>><?php echo $i; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <main>
                            <div class="calendar-overview">
                                <?php
                                if ( have_posts() ) :
                                    ?>
                                    <div class="row">
                                        <?php
                                        while ( have_posts() ) : the_post();?>

                                            <?php
                                            // - custom variables -
                                            $custom = get_post_custom(get_the_ID());
                                            $startDate = $custom["tf_events_startdate"][0];

                                            // - local time format -
                                            $time_format = get_option('time_format');
                                            $startTime = date($time_format, $startDate);

                                            ?>
                                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="calendar-overview__item">
                                                        <div class="calendar-overview__date text-lowercase">
                                                            <?php echo date_i18n("l j F Y", $startDate); ?>
                                                        </div>
                                                        <div class="calendar-overview__title text-uppercase">
                                                            <?php the_title(); ?>
                                                        </div>
                                                        <div class="calendar-overview__location">
                                                            <?php echo $startTime; ?><span><?php echo $custom["tf_events_location"][0]; ?></span>
                                                        </div>

                                                        <div class="calendar-overview__link text-lowercase">
                                                            <a href="<?php echo get_post_permalink(get_the_ID()) ?>"><?php _e( 'ontdek meer', 'medica-theme' ); ?></a>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php

                                        endwhile;
                                    ?>
                                    </div>
                                    <?php

                                else:
                                    ?>
                                        <p>
                                            <?php _e('Er werden geen geplande evenementen gevonden voor deze maand', 'medica-theme'); ?>
                                        </p>
                                    <?php
                                endif;
                                ?>
                            </div>
                        </main>
                    </div>
                </div>
            </article>
        </div>
    </div>
    <script type="text/javascript">
            var $ = jQuery;

            var url = '<?php
                global $wp;

                // get current url with query string.
                echo home_url( $wp->request );

                ?>';

            url = url.replace(/(\d{2})\/(\d{4})/g, "");

            $('.calendar-filters').on('change', 'select[name="event_month"], select[name="event_year"]', function(){

                var month = $('select[name="event_month"]').val();
                var year = $('select[name="event_year"]').val();

                // reload page
                window.location =  url + "/" + month + "/" + year + "/" ;
            });
    </script>
<?php get_footer(); ?>