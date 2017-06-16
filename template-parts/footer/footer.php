<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-2 text-center">
                <img class="footer__shield" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/images/assets/medica-shield.svg"/>
            </div>
            <div class="col-sm-8 col-md-2 text-left">
                <br class="visible-xs"/>
                <address>
                    <?php echo get_option('medica_address'); ?>
                </address>
                <br/>
                <a href="mailto:<?php echo get_option('medica_email'); ?>"><?php echo get_option('medica_email'); ?></a>
            </div>
            <div class="col-sm-9 col-md-4 text-center hidden-xs">
                <br class="visible-sm"/>
                <img class="footer__banner" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/images/assets/ad.png"/>
            </div>
            <div class="col-sm-3 col-md-2 text-left hidden-xs">
                <br class="visible-sm"/>
                <p>Ook adverteren?</p>
                <a href="#">contacteer ons</a>
            </div>
            <div class="col-sm-12 col-md-2 text-right hidden-xs">
                <br class="hidden-sm"/>
                <br class="hidden-sm"/>
                <br class="hidden-sm"/>
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