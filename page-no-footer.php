<?php

/*
    Template Name: Content page without footer [Page Template]
    Template Post Type: page
    @package WordPress
    @subpackage Medica_theme
*/

get_header();

?>
<div class="medica-carousel__parallax">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();?>

            <?php get_template_part("content", "standard"); ?>

            <?php

        endwhile;

    endif;

    ?>
</div>

<?php get_footer('minimal'); ?>