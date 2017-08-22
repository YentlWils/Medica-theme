<div class="contact-widget" style="background-image: url('<?php echo get_option('form_gen_img'); ?>');">
    <!--    Stap 1   -->
    <div class="contact-widget__section  contact-widget__section--active" id="contact-widget--sep-1">
        <div class="contact-widget__table">
            <div class="contact-widget__content text-center">
                <div class="contact-widget__title text-uppercase"><?php echo get_option('form_front_title'); ?></div>
                <?php if (strlen(get_option('form_front_subtitle')) > 0 ){ ?>
                    <div class="contact-widget__sub-title text-uppercase"><?php echo get_option('form_front_subtitle'); ?></div>
                <?php } ?>
                <?php if (strlen(get_option('form_front_highlight')) > 0 ){ ?>
                    <div class="contact-widget__highlight"><?php echo get_option('form_front_highlight'); ?></div>
                <?php } ?>
                <?php if(get_option('form_gen_active') === "true"){ ?>
                    <div class="contact-widget__link">
                        <a href="javascript:showStep(2)"><?php _e("zin om te komen tappen/draaien?", 'medica-theme')?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php if(get_option('form_gen_active') === "true"){ ?>
        <!--    Stap 2-->
        <div class="contact-widget__section" id="contact-widget--sep-2">
            <div class="contact-widget__table">
                <div class="contact-widget__content text-center">
                    <div class="contact-widget__title text-uppercase"><?php _e( 'Vul hier aan', 'medica-theme' ); ?></div>
                    <div class="contact-widget__sub-title text-uppercase"><?php _e( 'Wij brengen je op de hoogte', 'medica-theme' ); ?></div>
                    <form class="contact-widget__form" id="contact-form__widget" action="<?php echo admin_url("admin-ajax.php") ?>">
                        <input type="hidden" name="subject" value="<?php echo get_option('form_email_subject'); ?>"/>
                        <input type="hidden" name="action" value="contact_send" />
                        <div class="row contact-widget__form-row">
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="col-xs-12 col-sm-12 col-md-12 col-centered" name="name" placeholder="<?php _e( 'Naam', 'medica-theme' ); ?>" required=""
                                       data-parsley-required-message="<?php _e('Dit veld is verplicht', 'medica-theme') ?>"/>
                            </div>
    <!--                        <br class="visible-xs"/>-->
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="col-xs-12 col-sm-12 col-md-12" name="firstname" placeholder="<?php _e( 'Voornaam', 'medica-theme' ); ?>" required=""
                                       data-parsley-required-message="<?php _e('Dit veld is verplicht', 'medica-theme') ?>"/>
                            </div>
                        </div>

                        <div class="row contact-widget__form-row">
                            <div class="col-md-12">
                                <input type="email" class="col-xs-12 col-sm-12 col-md-12" name="email" placeholder="<?php _e( 'Email', 'medica-theme' ); ?>" required=""
                                       data-parsley-required-message="<?php _e('Dit veld is verplicht', 'medica-theme') ?>"
                                       data-parsley-type-message="<?php _e('Dit is geen correct email formaat', 'medica-theme') ?>"/>
                            </div>
                        </div>
                        <div class="row contact-widget__form-row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="contact-widget__link text-left">
                                    <a href="javascript:showStep(1)"><?php _e( 'terug', 'medica-theme' ); ?></a>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="contact-widget__submit text-center">
                                    <input type="submit" value="<?php _e( 'verstuur', 'medica-theme' ); ?>" class="col-xs-12 col-sm-12 col-md-12 text-lowercase"/>
                                </div>
                            </div>
                        </div>
                    </form>
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

        <!--    Stap 4   -->
        <div class="contact-widget__section" id="contact-widget--sep-4">
            <div class="contact-widget__table">
                <div class="contact-widget__content text-center">
                    <div class="contact-widget__title text-uppercase"><?php _e( 'Oeps! Er is iet mis gelopen...', 'medica-theme' ); ?></div>
                    <div class="contact-widget__sub-title text-uppercase"><?php _e( 'Probeer het even opniew', 'medica-theme' ); ?></div>
                    <br/>
                    <div class="row contact-widget__form-row">
                        <div class="col-sm-12 col-md-12">
                            <div class="contact-widget__link">
                                <input type="submit" value="<?php _e( 'terug', 'medica-theme' ); ?>" onclick="showStep(2)" class="col-sm-6 col-md-6 col-centered text-lowercase"/>
                                <div style="clear: both"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>