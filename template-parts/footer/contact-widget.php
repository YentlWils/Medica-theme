<div class="contact-widget" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/images/assets/contact.png')">
    <!--    Stap 1   -->
    <div class="contact-widget__section contact-widget__section--active" id="contact-widget--sep-1">
        <div class="contact-widget__table">
            <div class="contact-widget__content text-center">
                <div class="contact-widget__title text-uppercase">Doc's bar feestje</div>
                <div class="contact-widget__sub-title text-uppercase">donderdag vanaf 19:00</div>
                <div class="contact-widget__highlight">11-11-2017</div>
                <div class="contact-widget__link">
                    <a href="javascript:showStep(2)">zin om te komen tappen</a>
                </div>
            </div>
        </div>
    </div>

    <!--    Stap 2-->
    <div class="contact-widget__section" id="contact-widget--sep-2">
        <div class="contact-widget__table">
            <div class="contact-widget__content text-center">
                <div class="contact-widget__title text-uppercase"><?php _e( 'Vul hier aan', 'medica-theme' ); ?></div>
                <div class="contact-widget__sub-title text-uppercase"><?php _e( 'Wij brengen je op de hoogte', 'medica-theme' ); ?></div>
                <div class="contact-widget__form">
                    <div class="row contact-widget__form-row">
                        <div class="col-sm-6 col-md-6">
                            <input type="text" class="col-sm-12 col-md-12" name="name" placeholder="<?php _e( 'Naam', 'medica-theme' ); ?>"/>
                            <br class="visible-sm"/>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <input type="text" class="col-sm-12 col-md-12" name="voornaam" placeholder="<?php _e( 'Voornaam', 'medica-theme' ); ?>"/>
                        </div>
                    </div>
                    <div class="row contact-widget__form-row">
                        <div class="col-md-12">
                            <input type="email" class="col-sm-12 col-md-12" name="email" placeholder="<?php _e( 'Email', 'medica-theme' ); ?>"/>
                        </div>
                    </div>
                    <div class="row contact-widget__form-row">
                        <div class="col-sm-6 col-md-6">
                            <div class="contact-widget__link text-left">
                                <a href="javascript:showStep(1)"><?php _e( 'terug', 'medica-theme' ); ?></a>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="contact-widget__submit text-center">
                                <input type="submit" value="<?php _e( 'verstuur', 'medica-theme' ); ?>" class="col-sm-12 col-md-12 text-lowercase"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--    Stap 3   -->
    <div class="contact-widget__section" id="contact-widget--sep-3">
        <div class="contact-widget__table">
            <div class="contact-widget__content text-center">
                <div class="contact-widget__title text-uppercase"><?php _e( 'Bedankt!', 'medica-theme' ); ?></div>
                <div class="contact-widget__sub-title text-uppercase"><?php _e( 'we brengen je op de hoogte', 'medica-theme' ); ?></div>
            </div>
        </div>
    </div>

</div>