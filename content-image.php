<h3>
    Image post: <?php the_title( sprintf('<h1 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ),'</a></h1>' ); ?>
</h3>
<small>
    posted on : <?php the_time("F j, Y"); ?> in <?php the_category(); ?>
</small>

<p>
    <?php the_content(); ?>
</p>

<hr/>