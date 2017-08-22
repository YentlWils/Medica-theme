<?php

/*
    Template Name: Home Page template [Page Template]
    Template Text Type: page
    @package WordPress
    @subpackage Medica_theme
*/

get_header();

?>
<div class="medica-carousel__parallax">

    <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();?>

                <?php get_template_part("content", "home"); ?>

                <?php

            endwhile;

        endif;

    ?>

</div>
<?php get_footer(); ?>