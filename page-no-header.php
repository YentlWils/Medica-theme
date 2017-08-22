<?php

/*
    Template Name: Content page without header [Page Template]
    Template Post Type: page
    @package WordPress
    @subpackage Medica_theme
*/

get_header('minimal');

?>

<?php
if ( have_posts() ) :
    while ( have_posts() ) : the_post();?>

        <?php get_template_part("content", "standard"); ?>

        <?php

    endwhile;

endif;

?>


<?php get_footer(); ?>