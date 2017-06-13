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

<div class="instagram-widget">
    <i class="fa fa-instagram"></i>
    <div class="row" style="margin: 0;">
        <?php
            foreach ($return->data as $post) {
            ?>
                <div class="col-md-6 instagram-widget__image" style="background-image: url(<?php echo $post->images->low_resolution->url ?>)">

                </div>
            <?php
                if ($iteration++ == 2) break;
            }

        ?>
    </div>
    <div class="instagram-widget__link text-center">
        <div class="instagram-widget__title text-uppercase">
            Ontdek meer op onze instagram
        </div>
        <div class="instagram-widget__text">
            <a href="<?php echo $profileUrl ?>">Ga naar onze instagram</a>
        </div>
    </div>
</div>

