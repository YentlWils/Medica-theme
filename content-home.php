<div class="container">
        <div class="row">
            <div class="col-md-12">
                <article class="medica-home">
                    <header class="text-center text-uppercase">
                        <h1 class="medica-home__title">
                            <?php the_title(); ?>
                        </h1>
                    </header>
                    <main>
                        <?php the_content(); ?>
                    </main>
                    <div class="medica-home__socials social-buttons">
                        <?php if ( has_nav_menu( 'social-media' ) ) {

                            wp_nav_menu(
                                array(
                                    'theme_location'  => 'social-media',
                                    'container'       => 'nav',
                                    'container_id'    => 'menu-social-media',
                                    'container_class' => 'menu',
                                    'menu_id'         => 'menu-social-media-items',
                                    'menu_class'      => 'menu-items',
                                    'depth'           => 1
                                )
                            );
                        } ?>
                    </div>
                    <div class="medica-home__feature-img" style="background-image: url('<?php echo the_post_thumbnail_url( 'large' ); ?>')">
                    </div>
                </article>
            </div>
        </div>
</div>
