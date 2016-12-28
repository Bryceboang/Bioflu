<?php
$hostname   = "localhost";
$username   = "whychoos_tweetse";
$password   = "OTs9PK&36Ukz";
$database   = "whychoos_twittersearch";

if (!$dbhandle = mysql_connect($hostname, $username, $password)) {
    echo 'Could not connect to mysql';
    exit;
}

if (!mysql_select_db($database, $dbhandle)) {
    echo 'Could not select database';
    exit;
}

    // get post
    $datefrom   = $_GET['datefrom'];
    $dateto     = $_GET['dateto'];
    $keyword    = $_GET['keyword'];
    $max_id     = $_GET['max_id'];
     
    
    require_once('TwitterAPIExchange.php');

    $settings = array(
        'oauth_access_token' => "2392662397-jpZE3iboQUlPt7s8Id9zFlJ3xPdQuIjsLSoynOc",
        'oauth_access_token_secret' => "L7jqlnwgRGcdEyIiAYzI0AcXVggfqtpYRwnstcK4MpOYF",
        'consumer_key' => "ApjsEsQpoM6WTLmStnfhLQLeH",
        'consumer_secret' => "TO0QrarmY61VGVQ7jl7qesJ9iYecwaLrBjr9r7AE9w8oqFx8Rx"
    );
    
    $url = "https://api.twitter.com/1.1/search/tweets.json";
    $requestMethod = "GET";
    $getfield = "?q={$keyword}&since={$datefrom}&until={$dateto}&count=1000&result_type=recent";
    if($max_id){
        $getfield .= "&max_id={$max_id}";
    }
    
    $twitter = new TwitterAPIExchange($settings);
    $response = $twitter->setGetfield($getfield)
                ->buildOauth($url, $requestMethod)
                ->performRequest();

    $tweets = json_decode($response);
    
    // query device
    foreach ($tweets->statuses as $tweet) {
        $screen_name = '@'.$tweet->user->screen_name;
//        $tweet_text = trim(mysql_real_escape_string($tweet->text));
        $tweet_text = mysql_real_escape_string($tweet->text);
        $tweet_name = mysql_real_escape_string($tweet->user->name);
        if($tweet->place->bounding_box->coordinates):
            $coordinates1  = $tweet->place->bounding_box->coordinates[0][2][0];
            $coordinates2  = $tweet->place->bounding_box->coordinates[0][2][1];
        else:
            $coordinates1  = '';
            $coordinates2  = '';
        endif;
        $created = mysql_real_escape_string($tweet->created_at);
        
        /** check if device already inserted **/
        $ifexist = mysql_query("SELECT * FROM tweet WHERE sn = '{$tweet->id}'") or die(mysql_error());

        $countifexist = mysql_num_rows($ifexist);
        if($countifexist == 0){
            /** 
            * insert in tweet 
            * 
            **/
            $tb_tweet = "INSERT INTO tweet (sn, date, username, screenname, tweets, symptoms, latitude, longitude, location) VALUES('{$tweet->id}','{$created}','{$tweet_name}','{$screen_name}','{$tweet_text}','sipon, ubo','{$coordinates1}','{$coordinates2}','{$tweet->place->full_name}');";
            mysql_query($tb_tweet) or die(mysql_error());
            $dailystats_ID = mysql_insert_id();
        } // end of $countifexist
    } // end query device
    

echo $dailystats_ID;
//echo '<pre>';
//print_r($rows);
//echo '</pre>';