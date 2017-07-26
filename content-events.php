<div class="container">
    <div class="row">
        <div class="col-md-12">
            <dilv class="medica-breadcrumb">
                <?php custom_breadcrumbs(); ?>
            </dilv>
        </div>
    </div>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php

            $custom = get_post_custom(get_the_ID());
            $startDate = $custom["tf_events_startdate"][0];

            // - local time format -
            $time_format = get_option('time_format');
            $startTime = date($time_format, $startDate);

        ?>
        <div class="row">
            <div class="col-md-12">
                <header class="entry-header text-center text-uppercase">
                    <h1 class="entry-title">
                        <?php the_title(); ?>

                        <div class="entry-subtitle text-lowercase">
                            <?php echo date_i18n("l j F Y", $startDate); ?>
                        </div>

                        <div class="entry-subtitle text-lowercase">
                            <?php echo $startTime . " | " . $custom["tf_events_location"][0]; ?>
                        </div>
                    </h1>
                </header>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <main>
                    <?php the_content(); ?>
                </main>
            </div>
        </div>
    </article>
</div>