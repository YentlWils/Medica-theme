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

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />


        <title><?php _e( 'Medica', 'medica-theme' ); ?> | <?php echo get_the_title(); ?></title>

        <link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/images/assets/favicon.ico" rel="shortcut icon" type="image/x-icon">
        <link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/images/assets/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180">

        <!-- Import the css style files -->
        <?php wp_head(); ?>

    </head>

    <?php
        if( is_front_page() ):
            $medica_body_class = array("medica-home-page");
        elseif(is_home()):
            $medica_body_class = array("medica-blog-page");
        else:
            $medica_body_class = array("medica-content-page");
        endif
    ?>

    <body <?php body_class($medica_body_class); ?> >
        <!-- Fixed navbar -->
        <nav id="header" class="navbar navbar-fixed-top">
            <div id="header-container" class="container navbar-container">
                <div class="row">
                    <div id="main-navigation" class="navbar-header col-xs-12">
                        <a id="brand" class="navbar-brand" href="<?php echo get_home_url(); ?>">
                            <?php include "logo.php" ?>
                        </a>
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="#" class="navbar-link">
                                    <span><?php _e( 'English', 'medica-theme' ); ?></span>
                                </a>
                            </li>
                            <li>
                                <a id="nav-menu" href="#menu" class="navbar-link menu__button" data-toggle="collapse" data-target="#main-menu">
                                    <!-- TODO: i18n -->
                                    <span class="text text-lowercase"><?php _e( 'Menu', 'medica-theme' ); ?></span>
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
                            <img class="main-menu__shield" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/images/assets/medica-shield.svg"/>
                    </div>
                </div>
                <div class="main-menu__primary">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-4 col-md-4 col-md-offset-1">
                                <?php
                                if ( has_nav_menu( 'primary-col-1' ) ) {
                                    wp_nav_menu( array('theme_location' => 'primary-col-1') );
                                }
                                ?>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <?php
                                if ( has_nav_menu( 'primary-col-2' ) ) {
                                    wp_nav_menu(array('theme_location' => 'primary-col-2'));
                                }
                                ?>
                            </div>
                            <div class="col-sm-4 col-md-3">
                                <?php
                                if ( has_nav_menu( 'primary-col-3' ) ) {
                                    wp_nav_menu(array('theme_location' => 'primary-col-3'));
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-menu__social social-buttons">
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