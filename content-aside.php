<h3>
    ASIDE POST: <?php the_title( sprintf('<h1 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ),'</a></h1>' ); ?>
</h3>
<div class="thumbnail-image"><?php the_post_thumbnail('thumbnail'); ?></div>

<p>
    <?php the_content(); ?>
</p>

<hr/>