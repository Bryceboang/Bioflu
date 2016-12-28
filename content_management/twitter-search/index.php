<!DOCTYPE html>
<!--
http://whychoosemrm.com/twitter-search/
-->
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter Search - BPI MTBH</title>
    <link rel="stylesheet" href="/content_management/twitter-search/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="/content_management/twitter-search/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/content_management/twitter-search/assets/css/main.css">
    <script src="/content_management/twitter-search/assets/js/jquery-1.10.2.js"></script>
    <script src="/content_management/twitter-search/assets/js/jquery-ui.js"></script>
    <script src="/content_management/twitter-search/assets/js/jquery.dataTables.min.js"></script>
    <script>
        $(function() {
                $( "#from" ).datepicker({
                    dateFormat: "yy-mm-dd",
                    defaultDate: "",
                    changeMonth: true,
                    numberOfMonths: 1,
                    onClose: function( selectedDate ) {
                      $( "#to" ).datepicker( "option", "minDate", selectedDate );
                    }
                });
                $( "#to" ).datepicker({
                    dateFormat: "yy-mm-dd",
                    defaultDate: "",
                    changeMonth: true,
                    numberOfMonths: 1,
                    onClose: function( selectedDate ) {
                      $( "#from" ).datepicker( "option", "maxDate", selectedDate );
                    }
                });
        });
    </script>
</head>
<body>
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
    //$url =  "https://stream.twitter.com/1.1/statuses/filter.json";
    $requestMethod = "GET";
    $getfield = "?q={$keyword}&since={$datefrom}&until={$dateto}&count=100&result_type=recent"; 
    



    if($max_id != ''){
        $getfield .= "&max_id={$max_id}";
    }
    
    $twitter = new TwitterAPIExchange($settings);
    $response = $twitter->setGetfield($getfield)
                ->buildOauth($url, $requestMethod)
                ->performRequest();

    $tweets = json_decode($response);
    
    
    /*
    // auto set for date
    if($datefrom == '' && $dateto == ''){ 
        $datefrom   = date('Y-m-d');
        $dateto     = date('Y-m-d');
    } elseif($datefrom != '' && $dateto == ''){
        $dateto = date('Y-m-d 23:59:59', strtotime($datefrom));
    } elseif($datefrom == '' && $dateto != ''){
        $datefrom = date('Y-m-d 00:00:00', strtotime($dateto));
    }

    // set date to display
    if( $datefrom == $dateto){
        $display_date = date_create($datefrom);
        $display_date = date_format($display_date, 'd M, Y');
    }else{
        $display_date_from  = date_create($datefrom);
        $display_date_to    = date_create($dateto);
        $display_date       = date_format($display_date_from, 'd M, Y') . ' - ' . date_format($display_date_to, 'd M, Y');
    }*/
    ?>
    <div class="filter pull-right">
        <form class="form-inline" method="GET">
            <div class="form-group">
                <span>
                    <label for="from">Max ID</label>
                    <input type="text" name="max_id" value="<?php echo $max_id; ?>">
                </span>
                <span>
                    <label for="from">From</label>
                    <input type="text" id="from" name="datefrom" value="<?php echo $datefrom; ?>">
                </span>
                <span>
                    <label for="to">To</label>
                    <input type="text" id="to" name="dateto" value="<?php echo $dateto; ?>">
                </span>
                <span>
                    <label for="to">Keyword</label>
                    <input type="text" name="keyword" value="<?php echo $keyword; ?>">
                </span>  
            </div>
            <button type="submit" class="btn btn-default filterbtn">Submit</button>
        </form>
    </div>
    <div class="clearfix"></div>
    <h1 class="text-center">Twitter Search</h1>
    <div id="content-<?php echo $query[0]['device']; ?>" class="content-wrap">
        
        <?php
        echo count($tweets->statuses);
         if($tweets->statuses):
            foreach($tweets->statuses as $tweet): ?>
                <?php $display_date = date_create($tweet->created_at);?>
                    
                <pre><?php print_r($tweet); ?></pre>
            <?php endforeach;
        else: ?>
            <p class="text-center text-danger">No tweet found!</p>
        <?php endif; ?>
        
        <br/>
        <p class="text-center">
            <?php if($max_id != ''){ ?>
                <a class="btn btn-default" href="http://whychoosemrm.com/twitter-search/exporttweetsearch.php?dateto=<?php echo $_GET['dateto']; ?>&datefrom=<?php echo $_GET['datefrom']; ?>&max_id=<?php echo $_GET['max_id']; ?>&keyword=<?php echo $_GET['keyword']; ?>">Export Tweet</a>
                <a class="btn btn-default" href="http://whychoosemrm.com/twitter-search/savetweetsearch.php?dateto=<?php echo $_GET['dateto']; ?>&datefrom=<?php echo $_GET['datefrom']; ?>&max_id=<?php echo $_GET['max_id']; ?>&keyword=<?php echo $_GET['keyword']; ?>">Save Tweet</a>
            <?php } else { ?>
                <a class="btn btn-default" href="http://whychoosemrm.com/twitter-search/exporttweetsearch.php?dateto=<?php echo $_GET['dateto']; ?>&datefrom=<?php echo $_GET['datefrom']; ?>&keyword=<?php echo $_GET['keyword']; ?>">Export Tweet</a>
                <a class="btn btn-default" href="http://whychoosemrm.com/twitter-search/savetweetsearch.php?dateto=<?php echo $_GET['dateto']; ?>&datefrom=<?php echo $_GET['datefrom']; ?>&max_id=<?php echo $_GET['max_id']; ?>&keyword=<?php echo $_GET['keyword']; ?>">Save Tweet</a>
            <?php }?>
        </p>
    </div> 
</body>
</html>