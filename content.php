<div class="container">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="row">
            <div class="col-md-12">
                <header class="entry-header text-center text-uppercase">
                    <h1 class="entry-title">
                        <?php the_title(); ?>
                    </h1>
                </header>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <main>
                    <?php the_content(); ?>
                </main>
            </div>
        </div>
    </article>
</div>
