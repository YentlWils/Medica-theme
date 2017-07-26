<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 8/06/17
 * Time: 09:31
 */


$attr = array(
    'limit' => '4'
);

$regularSponsors = getRegularSponsors($attr);

if ($regularSponsors):

?>

<div class="container-no">
    <div class="row">
        <div class="col-md-12">
            <?php

            $index = 1;
            foreach ($regularSponsors as $post):
                setup_postdata($post);

                // - custom variables -
                $custom = get_post_custom(get_the_ID());
                $url = $custom["tf_sponsors_url"][0];

                if($index >= 3){
                    $paddingClass = "hidden-xs";
                }

                $index++;

                ?>
                    <div class="col-xs-6 col-sm-3 col-md-3 sponsor-widget text-center <?php echo $paddingClass ?>">
                        <a href="<?php echo $url; ?>" class="sponsor-widget__link" target="_blank">
                            <img class="sponsor-widget__img" src="<?php echo the_post_thumbnail_url( 'large' ) ?>" alt="<?php the_title(); ?>" />
                        </a>
                    </div>
            <?php
            endforeach;
            ?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<?php
endif;

unset($regularSponsors);