<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 12/06/17
 * Time: 22:03
 */

$workgroups = getWorkgroups(array(
    'limit' => '6'
));

if ($workgroups):
?>

<div class="container-no">
    <div class="row">
        <div class="col-md-12">
            <div class="medica-workgroup__holder owl-carousel">

            <?php

            foreach ($workgroups as $post):
                setup_postdata($post);

                ?>
                <div class="medica-workgroup">
                    <div class="medica-workgroup__text text-center">
                        <?php the_content(); ?>
                    </div>
                    <div class="medica-workgroup__title text-uppercase text-center">
                        <?php the_title(); ?>
                    </div>
                </div>

            <?php

            endforeach;

            ?>
            </div>
        </div>
    </div>
</div>

<?php

endif;

unset($workgroups);