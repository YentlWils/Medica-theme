    <!-- Calendar preview -->
    <?php include "footer/calendar-widget.php" ?>

    <!-- Sponsors -->
    <?php include "footer/sponsor-widget.php" ?>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-2 text-center">
                    <img class="footer__shield" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/images/assets/medica-shield.svg"/>
                </div>
                <div class="col-md-2 text-left">
                    <address>
                        <?php echo get_option('medica_address'); ?>
                    </address>
                    <br/>
                    <a href="mailto:<?php echo get_option('medica_email'); ?>"><?php echo get_option('medica_email'); ?></a>
                </div>
                <div class="col-md-4 text-center">
                    <img class="footer__banner" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/images/assets/ad.png"/>
                </div>
                <div class="col-md-2 text-left">
                    <p>Ook adverteren?</p>
                    <a href="#">contacteer ons</a>
                </div>
                <div class="col-md-2 text-right">
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <a class="footer__author-link" href="http://designblast.be" target="_blank">
                        <img class="footer__author" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/images/assets/designblast.png"/>
                    </a>
                </div>
            </div>
        </div>

    </footer>

    <!-- Import the js script files  -->
    <?php wp_footer(); ?>

    </body>
</html>