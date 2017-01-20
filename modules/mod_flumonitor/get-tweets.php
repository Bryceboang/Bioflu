<?php
class GetTweets {
    static public function get_most_recent()
    {
        //codebird is going to be doing the oauth lifting for us
        require_once('modules/mod_flumonitor/codebird.php');
        //These are your keys/tokens/secrets provided by Twitter
        $CONSUMER_KEY = 'X6ak890FYxlI2D9uGcIssSfZ5';
        $CONSUMER_SECRET = 'yZJAIDkrmFAKoU6Kq4oH5fUkS5ywQv21zy1uNpRx9DGFvUKhJO';
        $ACCESS_TOKEN = '3487980810-UVV7C9rtBAy2O9Q7kbkyWOe0WLgvDMSwAMrfwtl';
        $ACCESS_TOKEN_SECRET = 'svV6F8gyVevgM1mHxdgfJUhHdhqwJdePz0CxgqvavSGEV';
        //Get authenticated
        \Codebird\Codebird::setConsumerKey($CONSUMER_KEY, $CONSUMER_SECRET);
        $cb = \Codebird\Codebird::getInstance();
        $cb->setToken($ACCESS_TOKEN, $ACCESS_TOKEN_SECRET);
        //These are our params passed in for our request to twitter
        //The GET request is made by our codebird instance for us further down
        $params = array(
            'screen_name' => $screen_name,
            'count' => $count,
            'include_rts' => $retweets,
        );

        $keywords = array(
            'Trangkaso AND Bioflu', 
            'Sakitngkatawan AND Bioflu', 
            'BodyAches AND Bioflu',
            'Sipon AND Bioflu',
            'Colds AND Bioflu',
            'Ubo AND Bioflu',
            'Cough AND Bioflu'
        ); 
        foreach ($keywords as $keyword) {
            $params1 = array('q'=> $keyword, 'count' => '1', 'result_type' => 'recent' );    
        

        
// $params1 = array('q'=> '#Trangkaso AND #Bioflu', 'count' => '1', 'result_type' => 'recent' );    
$reply = (array) $cb->search_tweets($params1);

$data = (array) $reply['statuses'];
$tweets = (array) $cb->statuses_userTimeline($params);

return json_encode($data);
}
    }
}