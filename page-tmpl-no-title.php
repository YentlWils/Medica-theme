<?php

/*
    Template Name: Page No Tile
*/

get_header();

?>

<?php
if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>

        custom template

        <p>
            <?php the_content(); ?>
        </p>

        <?php

    endwhile;

endif;
?>

<?php get_footer(); ?>