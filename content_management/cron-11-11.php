<?php
ini_set('memory_limit', '-1');
require_once('TwitterAPIExchange.php');

$hostname   = "localhost";
$username   = "bioflu_qa";
$password   = "xAsXu)0*,,D;";
$database   = "bioflu_db";


if (!$dbhandle = mysql_connect($hostname, $username, $password)) {
    echo 'Could not connect to mysql';
    exit;
}

if (!mysql_select_db($database, $dbhandle)) {
    echo 'Could not select database';
    exit;
}

    $keywords = array(
        '"flu" OR "trangkaso" AND "lagnat" OR "nilalagnat" OR "lalagnatin" OR "fever"', 
        '"flu" OR "trangkaso" AND "headache" OR "head ache" OR "sakit ng ulo" OR "masakit ang ulo"', 
        '"flu" OR "trangkaso" AND "runny nose" OR "sipon" OR "sinisipon" OR "sisipunin"', 
        '"flu" OR "trangkaso" AND "body ache" OR "bodyache" OR "sakit ng katawan" OR "masakit ang katawan" OR "body pain" OR "bodypain"', 
        '"flu" OR "trangkaso" AND "cough" OR "ubo" OR "inuubo" OR "uubuhin"', '"flu" OR "trangkaso" AND "virus"', 
        '"lagnat" OR "nilalagnat" OR "lalagnatin" OR "fever" AND "headache" OR "head ache" OR "sakit ng ulo" OR "masakit ang ulo"', 
        '"lagnat" OR "nilalagnat" OR "lalagnatin" OR "fever" AND "runny nose" OR "sipon" OR "sinisipon" OR "sisipunin"', 
        '"lagnat" OR "nilalagnat" OR "lalagnatin" OR "fever" AND "body ache" OR "bodyache" OR "sakit ng katawan" OR "masakit ang katawan" OR "body pain" OR "bodypain"', 
        '"lagnat" OR "nilalagnat" OR "lalagnatin" OR "fever" AND "cough" OR "ubo" OR "inuubo" OR "uubuhin"', 
        '"lagnat" OR "nilalagnat" OR "lalagnatin" OR "fever" AND "virus"', 
        '"headache" OR "head ache" OR "sakit ng ulo" OR "masakit ang ulo" AND "runny nose" OR "sipon" OR "sinisipon" OR "sisipunin"', 
        '"headache" OR "head ache" OR "sakit ng ulo" OR "masakit ang ulo" AND "body ache" OR "bodyache" OR "sakit ng katawan" OR "masakit ang katawan" OR "body pain" OR "bodypain"', 
        '"headache" OR "head ache" OR "sakit ng ulo" OR "masakit ang ulo" AND "cough" OR "ubo" OR "inuubo" OR "uubuhin"', 
        '"headache" OR "head ache" OR "sakit ng ulo" OR "masakit ang ulo" AND "virus"', 
        '"runny nose" OR "sipon" OR "sinisipon" OR "sisipunin" AND "body ache" OR "bodyache" OR "sakit ng katawan" OR "masakit ang katawan" OR "body pain" OR "bodypain"', 
        '"runny nose" OR "sipon" OR "sinisipon" OR "sisipunin" AND "cough" OR "ubo" OR "inuubo" OR "uubuhin"', 
        '"runny nose" OR "sipon" OR "sinisipon" OR "sisipunin" AND "virus"', 
        '"body ache" OR "bodyache" OR "sakit ng katawan" OR "masakit ang katawan" OR "body pain" OR "bodypain" AND "cough" OR "ubo" OR "inuubo" OR "uubuhin"', 
        '"body ache" OR "bodyache" OR "sakit ng katawan" OR "masakit ang katawan" OR "body pain" OR "bodypain" AND "virus"', 
        '"cough" OR "ubo" OR "inuubo" OR "uubuhin" AND "virus"'
    ); 




// get post
/*$datefrom   = $_GET['datefrom'];
$dateto     = $_GET['dateto'];*/
$datefrom   = date("Y-m-d", strtotime("-1 day"));
$dateto     = date("Y-m-d");
$max_id     = $_GET['max_id'];

//echo "<pre>";
//print_r($keywords);





    
foreach ($keywords as $keyword) {
        $tweets = ts_query_tweets_1($keyword, $datefrom, $dateto, $max_id);
        
        if($tweets->errors[0]->code == 88){
            echo '----> Start ERROR ts_query_tweets_1 <---- </br>'
                . 'keyword:'.$keyword.'</br> max id:'. $max_id .'</br> ----> End ERROR ts_query_tweets_2 <----';
            $tweets = ts_query_tweets_2($keyword, $datefrom, $dateto, $max_id);
            if($tweets->errors[0]->code == 88){
                echo '----> Start ERROR ts_query_tweets_2 <---- </br>'
                . 'keyword:'.$keyword.'</br> max id:'. $max_id .'</br> ----> End ERROR ts_query_tweets_2 <----';
                $tweets = ts_query_tweets_3($keyword, $datefrom, $dateto, $max_id);
            }
        }
        // get error code
        if($tweets->errors[0]->code ){
            echo $tweets->errors[0]->code;
        }
        // query device
        ts_push_tweets($tweets->statuses, $keyword, $datefrom, $dateto);
} // end query keywords    

function  ts_query_tweets_1($keyword, $datefrom, $dateto, $max_id = null){
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
    return $tweets = json_decode($response);
} // query_tweet

function  ts_query_tweets_2($keyword, $datefrom, $dateto, $max_id = null){
    $settings = array(
        'oauth_access_token' => "4067200398-z6sP8SOmT5eAYqbUQbNW5yYTuAeGQIKZmBe9nv9",
        'oauth_access_token_secret' => "7ut3KbKc5z1O5FYEnNF2FWHGLp584wNktSjAk7hJ1haRo",
        'consumer_key' => "wy5pf4trQwO6Zwurz05LZ8F4J",
        'consumer_secret' => "hBLhEnaSpkIMMguQpuASi8mZNHaq8CrH3hKM4wyu1PTK8sNt5d"
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
    return $tweets = json_decode($response);
} // query_tweet

function  ts_query_tweets_3($keyword, $datefrom, $dateto, $max_id = null){
    $settings = array(
        'oauth_access_token' => "4067572573-fZIaZciTam8Pno7lvgxXfkrHe1PoarAmL58tqHU",
        'oauth_access_token_secret' => "W8YYhLLF0jXR2qgICWMEIIKxxgBsM012yoiDdFjtlHLAo",
        'consumer_key' => "83osipXoj3RpiPQEo4kvcaycS",
        'consumer_secret' => "NDAb6lRtfHDEaHrI9qOuSkSmavo8jmnIZEziPmz3IE39XY4wQ4"
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
    return $tweets = json_decode($response);
} // query_tweet

function ts_push_tweets($tweets, $keyword, $datefrom, $dateto){
    $get_tweets = array();
    $ts_push_tweets = array();
    
    if($tweets){
        foreach ($tweets as $tweet) {
            $ts_push_tweets['sn'] = $tweet->id;
            $ts_push_tweets['date'] = $tweet->created_at;
            $ts_push_tweets['username'] = $tweet->user->name;
            $ts_push_tweets['screenname'] = $tweet->user->screen_name;
            $ts_push_tweets['tweets'] = $tweet->text;
            $ts_push_tweets['symptoms'] = $keyword; 
            $ts_push_tweets['longitude'] = $tweet->place->bounding_box->coordinates[0][2][0];
            $ts_push_tweets['latitude'] = $tweet->place->bounding_box->coordinates[0][2][1]; 
            $ts_push_tweets['date_generated'] = date('Y-m-d');
            if($tweet->place->full_name != ''):
                $ts_push_tweets['location'] = $tweet->place->full_name;
            else:
                $ts_push_tweets['location'] = $tweet->user->location;
            endif;
            array_push($get_tweets, $ts_push_tweets);
        } // end query tweets
    }
    
    if(count($tweets) >= 99){
        $qtweets = ts_query_tweets_1($keyword, $datefrom, $dateto, $tweets[99]->id);
        if($tweets->errors[0]->code == 88){
            $tweets = ts_query_tweets_2($keyword, $datefrom, $dateto, $max_id);
            if($tweets->errors[0]->code == 88){
                $tweets = ts_query_tweets_3($keyword, $datefrom, $dateto, $max_id);
            }
        }
        ts_push_tweets($qtweets->statuses, $keyword, $datefrom, $dateto);
    }   
    
    ts_save_tweets($get_tweets);
} // ts_push_tweets

function ts_save_tweets($arr_tweets = array()){   
    if($arr_tweets){
        foreach ($arr_tweets as $tweet) {
        $tb_sn          = $tweet['sn'];
        $tb_date        = mysql_real_escape_string($tweet['date']);
        $tb_username    = mysql_real_escape_string($tweet['username']);
        $tb_screenname  = '@'.$tweet['screenname'];
        $tb_tweets      = mysql_real_escape_string($tweet['tweets']);
        $tb_symptoms    = mysql_real_escape_string($tweet['symptoms']);
        $tb_longitude   = mysql_real_escape_string($tweet['longitude']);
        $tb_latitude    = mysql_real_escape_string($tweet['latitude']);
        $tb_location    = mysql_real_escape_string($tweet['location']);
        $tbl_date_generated    = mysql_real_escape_string($tweet['date_generated']);

            
            $tb_tweet = "INSERT INTO bio_twitter_reports (sn, date, username, tweets, symptoms, latitude, longitude, address, date_generated) VALUES('{$tb_sn}','{$tb_date}','{$tb_username}','{$tb_tweets}','{$tb_symptoms}','{$tb_longitude}','{$tb_latitude}','{$tb_location}','{$tbl_date_generated}');";
                $tb_tweet .= '<br/>';
                
                echo $tb_tweet;
        } // end query device
    }        
} // ts_push_tweets

/*
function ts_save_tweets($arr_tweets = array()){   
    if($arr_tweets){
        foreach ($arr_tweets as $tweet) {
        $tb_sn          = $tweet['sn'];
        $tb_date        = mysql_real_escape_string($tweet['date']);
        $tb_username    = mysql_real_escape_string($tweet['username']);
        $tb_screenname  = '@'.$tweet['screenname'];
        $tb_tweets      = mysql_real_escape_string($tweet['tweets']);
        $tb_symptoms    = mysql_real_escape_string($tweet['symptoms']);
        $tb_longitude   = mysql_real_escape_string($tweet['longitude']);
        $tb_latitude    = mysql_real_escape_string($tweet['latitude']);
        $tb_location    = mysql_real_escape_string($tweet['location']);
        $tbl_date_generated    = mysql_real_escape_string($tweet['date_generated']);

            
            // check if device already inserted
            $ifexist = mysql_query("SELECT * FROM bio_twitter_reports WHERE sn = '{$tb_sn}' AND date = '{$tb_date}'") or die(mysql_error());

            $countifexist = mysql_num_rows($ifexist);
            if($countifexist == 0){
                
                // insert in tweet
                $tb_tweet = "INSERT INTO bio_twitter_reports (sn, date, username, tweets, symptoms, latitude, longitude, address, date_generated) VALUES('{$tb_sn}','{$tb_date}','{$tb_username}','{$tb_tweets}','{$tb_symptoms}','{$tb_longitude}','{$tb_latitude}','{$tb_location}','{$tbl_date_generated}');";
                mysql_query($tb_tweet) or die(mysql_error());
                $dailystats_ID = mysql_insert_id();
            } // end of $countifexist
        } // end query device
    }        
} // ts_push_tweets
*/