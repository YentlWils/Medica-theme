<?php
/**
 * Created by IntelliJ IDEA.
 * User: yentl
 * Date: 8/06/17
 * Time: 09:31
 */

//https://www.instagram.com/oauth/authorize/?client_id=9bbb18416af04e59afa19babf0f6df50&amp;redirect_uri=http://medica.be&amp;response_type=token&amp;scope=public_content
//id = 218484184876036


?>
<?php
function make_links($text, $class='', $target='_blank'){
    return preg_replace('!((http\:\/\/|ftp\:\/\/|https\:\/\/)|www\.)([-a-zA-Zа-яА-Я0-9\~\!\@\#\$\%\^\&\*\(\)_\-\=\+\\\/\?\.\:\;\'\,]*)?!ism', '<a class="'.$class.'" href="//$3" target="'.$target.'">$1$3</a>', $text);
}
define("APP_ID", '189072178288633');
define("APP_SECRET",'ea2a4a64a3411542388289b7bb366b16');
define("PAGE_ID",'Medicavzw');
$config = array(
    'appId' => APP_ID,
    'secret' => APP_SECRET,
);
$api = new Facebook($config);
$posts = $api->api("/".PAGE_ID."/posts?limit=50");

//echo "<pre>"; print_r($posts); echo "</pre>";
$i=0;
foreach ($posts['data'] as $post){
    $time_ar = explode("T",$post['updated_time']);
    echo "<h3>{$time_ar[0]}</h3>";
    if(isset($post['message']) && $post['message']) echo "<p>".make_links($post['message'])."</p>";
    if(isset($post['story']) && $post['story']) echo "<p>".make_links($post['story'])."</p>";

    if($i !== count($posts['data'])-1){
        echo '<hr>';
    }
    $i++;
}
?>
