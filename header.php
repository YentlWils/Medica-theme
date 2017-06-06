<!docttype html>
<html>
    <head>
        <meta charset="utf-8">
        <!-- Chrome & Firefox OS -->
        <meta name="theme-color" content="#94335c">
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#94335c">
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-status-bar-style" content="#94335c">

        <!-- TODO: i18n -->
        <title>Medica | <?php echo get_the_title(); ?></title>

        <link href="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/assets/favicon.ico" rel="shortcut icon" type="image/x-icon">
        <link href="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/assets/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180">

        <!-- Import the css style files -->
        <?php wp_head(); ?>

    </head>

    <?php
        if( is_front_page() ):
            $medica_home = array("medica-home");
        elseif(is_home()):
            $medica_home = array("medica-blog-page");
        else:
            $medica_home = array("medica-content-page");
        endif
    ?>

    <body <?php body_class($medica_home); ?> >
        <!-- Fixed navbar -->
        <nav id="header" class="navbar navbar-fixed-top">
            <div id="header-container" class="container navbar-container">
                <div class="row">
                    <div id="main-navigation" class="navbar-header col-xs-12">
                        <a id="brand" class="navbar-brand" href="<?php echo get_home_url(); ?>">
                            <?php include "logo/logo.php" ?>
                        </a>
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="#" class="navbar-link">
                                    <!-- TODO: i18n -->
                                    <span>English</span>
                                </a>
                            </li>
                            <li>
                                <a id="nav-menu" href="#menu" class="navbar-link menu__button" data-toggle="collapse" data-target="#main-menu">
                                    <!-- TODO: i18n -->
                                    <span class="text">menu</span>
                                    <span class="line line--one"></span>
                                    <span class="line line--two"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="main-menu collapse" id="main-menu">
                <div class="container">
                    <div class="row text-center">
                            <img class="main-menu__shield" src="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/assets/medica-shield.svg"/>
                    </div>
                </div>
                <div class="main-menu__primary">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-md-offset-1">
                                <?php wp_nav_menu( array('theme_location' => 'primary-col-1') ); ?>
                            </div>
                            <div class="col-md-4">
                                <?php wp_nav_menu( array('theme_location' => 'primary-col-2') ); ?>
                            </div>
                            <div class="col-md-3">
                                <?php wp_nav_menu( array('theme_location' => 'primary-col-3') ); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-menu__social">
                    <div class="container">
                        <div class="row text-center">
                            <?php if ( has_nav_menu( 'social-media' ) ) {

                                wp_nav_menu(
                                    array(
                                        'theme_location'  => 'social-media',
                                        'container'       => 'nav',
                                        'container_id'    => 'menu-social-media',
                                        'container_class' => 'menu',
                                        'menu_id'         => 'menu-social-media-items',
                                        'menu_class'      => 'menu-items',
                                        'depth'           => 1
                                    )
                                );
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </nav><!-- /.navbar -->


    <!-- Custom header image -->
<!--    <img scr="--><?php //header_image(); ?><!--" height="--><?php //echo get_custom_header()->height; ?><!--" width="--><?php //echo get_custom_header()->width; ?><!--" alt=""/>-->
        <div class="medica-carousel">
            <div class="medica-carousel__holder owl-carousel">
                <div class="medica-carousel__item medica-carousel__item--filter" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/dist/images/assets/temp/ski.png')">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-8 col-lg-6 col-centered text-center">
                                <div class="medica-carousel__title text-uppercase">Onze skireis in zwitserland</div>
                                <div class="medica-carousel__sub-title text-lowercase">
                                    <span>21-11-1990  tot  16-03-2014</span></div>
                                <div class="medica-carousel__link text-lowercase"><a href="#">ontdek meer</a></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="medica-carousel__item medica-carousel__item--filter" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/dist/images/assets/temp/feest.png')">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-8 col-lg-6 col-centered text-center">
                                <div class="medica-carousel__title text-uppercase">Cantus avond in hartje leuven</div>
                                <div class="medica-carousel__sub-title text-lowercase">
                                    <span>Donderdag</span></div>
                                <div class="medica-carousel__link text-lowercase"><a href="#">ontdek meer</a></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="medica-carousel__item medica-carousel__item--filter" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/dist/images/assets/temp/cantus.png')">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-8 col-lg-6 col-centered text-center">
                                <div class="medica-carousel__title text-uppercase">weer een stevig Feestje in de doc’s bar</div>
                                <div class="medica-carousel__sub-title text-lowercase">
                                    <span>16-03-2014</span></div>
                                <div class="medica-carousel__link text-lowercase"><a href="#">ontdek meer</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

