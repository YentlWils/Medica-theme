<?php

$attr = array(
    'limit' => '2'
);

$links = getLinks($attr);

if ($links):

?>
<div class="container-no">
    <div class="row">
        <?php

        $index = 1;
        foreach ($links as $post):
            setup_postdata($post);

            // - custom variables -
            $custom = get_post_custom(get_the_ID());
            $url = $custom["tf_links_url"][0];

            if($index % 2 == 0){
                $paddingClass = "no-padding--left";
            }else {
                $paddingClass = "no-padding--right";
            }

            $index++;

            ?>



        <div class="col-md-6 <?php echo $paddingClass ?>">
            <a href="<?php echo $url ?>" target="_blank" class="shortcut-widget__link">
                <div class="shortcut-widget text-center text-uppercase">
                    <div class="shortcut-widget__image" style="background-image: url('<?php echo the_post_thumbnail_url( 'full' ); ?>')"></div>
                    <div class="shortcut-widget__table">
                        <div class="shortcut-widget__cell">
                            <?php the_title(); ?>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <?php
            endforeach;
        ?>
    </div>
</div>
<?php
endif;

unset($links);