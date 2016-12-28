<?php
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
    
    $filename   = "exportfile/tweetsearch_".$datefrom."_".$dateto.".xls";

    // set fputcsv
    $rows = array (
        array("Date: $datefrom - $dateto"),
        array('SN', 'Date/Time', 'User Name', 'Screen Name', 'Tweets', 'Symptoms', 'Latitude', 'Longitude')
    );

    // query device
    foreach ($tweets->statuses as $tweet) {
        $xls = array();
        
        $xls[]  = 'A_'.$tweet->id;
        $xls[]  = $tweet->created_at;
        $xls[]  = $tweet->user->name;
        $xls[]  = '@'.$tweet->user->screen_name;
        $xls[]  = $tweet->text;
        $xls[]  = $tweet->$keyword;
        if($tweet->place->bounding_box->coordinates):
            $xls[]  = $tweet->place->bounding_box->coordinates[0][2][0];
            $xls[]  = $tweet->place->bounding_box->coordinates[0][2][1];
        else:
            $xls[]  = '';
            $xls[]  = '';
        endif;
        $rows[] = $xls;
    } // end query device

$fp = fopen($filename, 'w');

//echo '<pre>';
//print_r($rows);
//echo '</pre>';

foreach ($rows as $row) {
    fputcsv($fp, $row, "\t", '"');
}

fclose($fp);

header("Location: $filename");