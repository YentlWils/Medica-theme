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

            // - custom variables -
            $custom = get_post_custom(get_the_ID());

            $subtitle = $custom["tf_slider_subtitle"][0];

        ?>
        <div class="row">
            <div class="col-md-12">
                <header class="entry-header text-center text-uppercase">
                    <h1 class="entry-title">
                        <?php the_title(); ?>

<!--                        <div class="entry-subtitle text-lowercase">-->
<!--                            --><?php //echo $subtitle; ?>
<!--                        </div>-->
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