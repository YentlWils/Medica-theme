<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 8/06/17
 * Time: 09:31
 */

//https://developers.facebook.com/tools/explorer/189072178288633?method=GET&path=TheFishHooks%2Fposts&version=v2.9

//https://graph.facebook.com/oauth/access_token?grant_type=fb_exchange_token&client_id=189072178288633&client_secret=ea2a4a64a3411542388289b7bb366b16&fb_exchange_token=EAACr9cwGFZCkBAJcCo5Hv8lUrND28gsPZBujdsbAZB6U1DRvjr44r73VG2VNHpGZCh8g6Km0p1EnBCZCxV2SfwKvYvsZCZA3wkz9lbZAMreVr4aGD7M6ZCDKPeIpE8hp0LND817sLFG3PFgVYOV3YllqgZCm3a1JgwxXnIiwBXpp5p7f2weMU4D99VZA7DAxEFzVtilGX5s20yAtQZDZD&redirect_uri=medica.be

$page_name = 'TheFishHooks'; // Example: http://facebook.com/{PAGE_NAME}
$access_token = "EAACr9cwGFZCkBAIsZAhZAjFcVRKkIPJKS4hZBGpsvNkONovAvajRCR9R4QrDJy1chE3VKZBku4iHTy2NOg5ZB0sHoDA6HJNgYPDZAyKLDMzGzC6vjmKpNm2BvuDGfCYZBJQWcLZC085xG53NeFUC9f3lEU9EKf06LN2d1pZABJ2ozZCWAZDZD";
$limit = 10;
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
            <div class="social-media-widget__date text-lowercase"><?php echo date_i18n("D, j F Y", $date->getTimestamp()) . " " . __("om",'medica-theme') . " " . date_i18n("H:i", $date->getTimestamp()); ?> </div>
            <div class="social-media-widget__text">
                <?php echo $post->message; ?>
            </div>
        </div>
    </div>
    <div class="social-media-widget__overlay social-media-widget__overlay--facebook text-center">
        <div class="social-media-widget__cell">
            <div class="social-media-widget__title text-uppercase">
                <?php _e("Ontdek meer op onze facebook" ,'medica-theme') ;?>
            </div>
            <div class="social-media-widget__link text-lowercase">
                <a href="<?php echo $profileUrl ?>" target="_blank"><?php _e("Ga naar onze facebook" ,'medica-theme') ;?></a>
            </div>
        </div>
    </div>
</div>