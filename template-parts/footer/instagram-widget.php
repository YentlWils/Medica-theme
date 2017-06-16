<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 8/06/17
 * Time: 09:31
 */

//https://www.instagram.com/oauth/authorize/?client_id=9bbb18416af04e59afa19babf0f6df50&amp;redirect_uri=http://medica.be&amp;response_type=token&amp;scope=public_content
//53977759

/** TODO make token and username configurable*/

$access_token = '53977759.9bbb184.44b07fe5225f473888651e041dbc3939';
$username = 'yentl_wils';
$user_search = api_curl_connect("https://api.instagram.com/v1/users/search?q=" . $username . "&access_token=" . $access_token);
$user_id = $user_search->data[0]->id; // or use string 'self' to get your own media
$return = api_curl_connect("https://api.instagram.com/v1/users/" . $user_id . "/media/recent?access_token=" . $access_token);

$profileUrl = "https://www.instagram.com/" . $username;

$iteration = 1;
?>

<div class="social-media-widget">
    <i class="fa fa-instagram"></i>
    <div class="row" style="margin: 0;">
        <?php
            foreach ($return->data as $post) {
            ?>
                <div class="col-sm-6 col-md-6 social-media-widget__item social-media-widget__item--image" style="background-image: url(<?php echo $post->images->low_resolution->url ?>)">

                </div>
            <?php
                if ($iteration++ == 2) break;
            }

        ?>
    </div>
    <div class="social-media-widget__overlay social-media-widget__overlay--instagram text-center">
        <div class="social-media-widget__cell">
            <div class="social-media-widget__title text-uppercase">
                Ontdek meer op onze instagram
            </div>
            <div class="social-media-widget__link">
                <a href="<?php echo $profileUrl ?>">Ga naar onze instagram</a>
            </div>
        </div>
    </div>
</div>

