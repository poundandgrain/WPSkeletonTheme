<?php
$tweetArray = wp_cache_get('tweets');

if (!$tweetArray) {

    $tweetArray = array();

    include_once(TEMPLATEPATH . '/inc/tmhOAuth.php');
    include_once(TEMPLATEPATH . '/inc/tmhUtilities.php');
    include_once(TEMPLATEPATH . '/inc/twitter-functions.php');

    $tmhOAuth = new tmhOAuth(array(
        'consumer_key'        => 'ApaeS8RNAP8GlVo5RzRIqTmjr',
        'consumer_secret'     => 'MnkhVg07gJHIO0ocP9upwE0dnsviQp7oRRQXwgmvO3XirTX0Ep',
        'user_token'          => '32789509-ZY8I3bBQrf4DEqhKuUcvGOVIBiQwkXlUkrdLnfMbR',
        'user_secret'         => 'Le7peQjx0YhkgSgCg6L2S5zrgJhhEO8vB5fUnQHAClVez',
        'curl_ssl_verifypeer' => false
    ));

    $screen_name = 'povfilm';

    $code = $tmhOAuth->request('GET', $tmhOAuth->url('1.1/statuses/user_timeline'), array(
        'screen_name' => $screen_name,
        'count'       => 3, //retrieve maximum to be able to filter out hashtags
    ));

    $response = $tmhOAuth->response;
    $response = json_decode($response['response']);

    if ($response) {

        $j = 0;

        for ($i = 0;$i <= count($response);$i ++) {

            if ($j < 3) {

                $text = $response[$i]->text;

                $is_retweet = $response[$i]->retweeted_status;
                if ($is_retweet) {
                    $text = "RT @" . $response[$i]->retweeted_status->user->screen_name . ": " . $response[$i]->retweeted_status->text;
                }

                $date  = strtotime($response[$i]->created_at);
                $date  = timeSince($date);
                $text  = addUrls($text);
                $image = $response[$i]->user->profile_image_url;

                $tweetArray[$j] = array("date" => $date, "text" => $text);
                $j ++;

            }
        }
    }

    // Cache for 10 minutes
    wp_cache_set( 'tweets', $tweetArray, "", 600 );
}

