<?php

/*
    Template Name: Content page without header
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