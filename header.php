<!docttype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Medica Theme</title>

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
                    <div class="navbar-header col-xs-12">
                        <a id="brand" class="navbar-brand" href="#">
                            <?php the_custom_logo(); ?>
                        </a>
                        <ul id="main-navigation" class="nav navbar-nav navbar-right">
                            <li>
                                <a href="#" class="navbar-link">
                                    <span>English</span>
                                </a>
                            </li>
                            <li>
                                <a id="nav-menu" href="#menu" class="navbar-link menu__button">
                                    <span class="text">menu</span>
                                    <span class="line line--one"></span>
                                    <span class="line line--two"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
<!--                <div id="navbar" class="collapsed navbar-collapse hidden">-->
<!--                    <ul class="nav navbar-nav">-->
<!--                        <li class="active"><a href="#">Home</a></li>-->
<!--                        <li><a href="#about">About</a></li>-->
<!--                        <li><a href="#contact">Contact</a></li>-->
<!--                    </ul>-->
<!--                </div>-->
                <!-- /.nav-collapse -->

            </div><!-- /.container -->
        </nav><!-- /.navbar -->

<!--    --><?php //wp_nav_menu( array('theme_location' => 'primary') ); ?>

    <!-- Custom header image -->
<!--    <img scr="--><?php //header_image(); ?><!--" height="--><?php //echo get_custom_header()->height; ?><!--" width="--><?php //echo get_custom_header()->width; ?><!--" alt=""/>-->

