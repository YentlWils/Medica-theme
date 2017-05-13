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

    <?php wp_nav_menu( array('theme_location' => 'primary') ); ?>

    <!-- Custom header image -->
    <img scr="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt=""/>

