<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 15/05/17
 * Time: 20:11
 */

get_header();

echo "aside";

if ( have_posts() ) :
    while ( have_posts() ) : the_post(); echo "This is the format: " . get_post_format(); ?>

        <?php get_template_part("content", get_post_format()); ?>

        <?php

    endwhile;

endif;


get_footer();

?>