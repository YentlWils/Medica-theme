    <!-- Calendar preview -->
    <?php include "footer/calendar-widget.php" ?>

    <!-- Social media section -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 no-padding--right">
                <?php include "footer/contact-widget.php" ?>
            </div>
            <div class="col-md-6 no-padding--left">
                <?php include "footer/facebook-widget.php" ?>
                <?php include "footer/instagram-widget.php" ?>
            </div>
        </div>
    </div>

    <!-- Quote -->
    <?php include "footer/quote-widget.php" ?>

    <!-- Google maps -->
    <?php include "footer/map-widget.php" ?>

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

    <?php wp_footer(); ?>

    <!-- Import the js script files  -->
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-1X7ksUemJ0ajJHPWcI-xmmzHSt91b0M&callback=initMap">
    </script>

    </body>
</html>