<?php get_header(); ?>
    <div class="medica-carousel__parallax">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();?>

                <?php get_template_part("content", "slider"); ?>

                <?php

            endwhile;

        endif;
        ?>
    </div>
<?php //get_sidebar(); ?>

<?php get_footer(); ?>