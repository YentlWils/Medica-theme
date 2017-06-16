<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 8/06/17
 * Time: 09:31
 */

//https://developers.facebook.com/tools/explorer/189072178288633?method=GET&path=TheFishHooks%2Fposts&version=v2.9

$page_name = 'TheFishHooks'; // Example: http://facebook.com/{PAGE_NAME}
$access_token = "EAACr9cwGFZCkBAGQxujpLxLymM9j1VZCS7Ec1TNQC4AvQh6G3GH38tQBzsnrFfwYEx5Qgu6x4ejZAVFawp8U5PXNznHoMHRrlmzyjIZBTlinDqLaoq4h33rrmQGOHpuGargDa0aEexOw4dbCsgOKFoTZBztyvjhj9mHqLg22jZCDTspZALw1pt8qjT8SkZCgzMsZD";
$limit = 100;
$url = "https://graph.facebook.com/$page_name/posts?limit=$limit&access_token=$access_token";
$profileUrl = "https://www.facebook.com/" . $page_name . "/";

?>

<div class="social-media-widget">
    <i class="fa fa-facebook"></i>
    <div class="row" style="margin: 0;">
        <div class="col-md-12 social-media-widget__item social-media-widget__item--text">
            <?php
                $i = 0;
                $data = api_curl_connect($url)->data;
                $fb_post = null;

                foreach ($data as $post) {
                    if(isset($post->message)){
                        $fb_post = $post;
                        break;
                    }
                }

            // The Regular Expression filter
            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

            // Check if there is a url in the text
            if(preg_match($reg_exUrl, $post->message, $url)) {
                // make the urls hyper links
                $post->message =  preg_replace($reg_exUrl, "<a href=".$url[0].">" .$url[0] ."</a> ", $post->message);
            }

            $date = new DateTime($fb_post->created_time);

            ?>
            <div class="social-media-widget__date"><?php echo strftime("%a, %d %B %Y om %H:%M", $date->getTimestamp()); ?> </div>
            <div class="social-media-widget__text">
                <?php echo $post->message; ?>
            </div>
        </div>
    </div>
    <div class="social-media-widget__overlay social-media-widget__overlay--facebook text-center">
        <div class="social-media-widget__cell">
            <div class="social-media-widget__title text-uppercase">
                Ontdek meer op onze facebook
            </div>
            <div class="social-media-widget__link">
                <a href="<?php echo $profileUrl ?>">Ga naar onze facebook</a>
            </div>
        </div>
    </div>
</div>