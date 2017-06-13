<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 8/06/17
 * Time: 09:31
 */

//https://www.instagram.com/oauth/authorize/?client_id=9bbb18416af04e59afa19babf0f6df50&amp;redirect_uri=http://medica.be&amp;response_type=token&amp;scope=public_content
//53977759

$access_token = '53977759.9bbb184.44b07fe5225f473888651e041dbc3939';
$username = 'yentl_wils';
$user_search = rudr_instagram_api_curl_connect("https://api.instagram.com/v1/users/search?q=" . $username . "&access_token=" . $access_token);
// $user_search is an array of objects of all found users
// we need only the object of the most relevant user - $user_search->data[0]
// $user_search->data[0]->id - User ID
// $user_search->data[0]->first_name - User First name
// $user_search->data[0]->last_name - User Last name
// $user_search->data[0]->profile_picture - User Profile Picture URL
// $user_search->data[0]->username - Username

$user_id = $user_search->data[0]->id; // or use string 'self' to get your own media

$return = rudr_instagram_api_curl_connect("https://api.instagram.com/v1/users/" . $user_id . "/media/recent?access_token=" . $access_token);

$profileUrl = "https://www.instagram.com/" + $username;

$iteration = 1;
foreach ($return->data as $post) {
    ?>
    <img src="<?php echo $post->images->low_resolution->url ?>" class="col-md-6"/>
    <?php
    if ($iteration++ == 2) break;
}

?>

