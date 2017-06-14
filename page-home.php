<?php

/*
    Template Name: Home Page template
*/

get_header();

?>


<!---->
<!--<div class="well">-->
<!--    --><?php
//
//        $lastBlog = new WP_Query(array(
//            "type" => "post",
//            "posts_per_page" => 3
//        ));
//
//        if ( $lastBlog->have_posts() ) :
//            while ( $lastBlog->have_posts() ) : $lastBlog->the_post(); echo "This is the format: " . get_post_format(); ?>
<!---->
<!--                --><?php //get_template_part("content", get_post_format()); ?>
<!---->
<!--                --><?php
//
//            endwhile;
//
//        endif;
//
//        wp_reset_postdata();
//
//    ?>
<!--</div>-->

<?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();?>

            <?php get_template_part("content", "home"); ?>

            <?php

        endwhile;

    endif;

?>
<!--<div class="well">-->
<!--    --><?php
        // Print the other 2 post, not the last
//        $lastBlog = new WP_Query(array(
//                "type" => "post",
//                "posts_per_page" => 2,
//                "offset" => 1
//        ));
//
//        if ( $lastBlog->have_posts() ) :
//            while ( $lastBlog->have_posts() ) : $lastBlog->the_post(); echo "This is the format: " . get_post_format(); ?>
<!---->
<!--                --><?php //get_template_part("content", get_post_format()); ?>
<!---->
<!--                --><?php
//
//            endwhile;
//
//        endif;
//
//        wp_reset_postdata();
//    ?>
<!---->
<!--</div>-->
<?php //get_sidebar(); ?>

<?php get_footer(); ?>