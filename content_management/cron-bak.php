<?php  require_once dirname(__FILE__) . '/model.php'; 
session_start();
date_default_timezone_set('Asia/Manila');
$result = twitterapi();
$symptoms = listsymtoms();
foreach ($result as $key => $row) {
$htm = '';
$x = 0;
foreach ($symptoms as $key => $row2) { 
if(stripos($row->text, $row2) !== FALSE){
	
	$htm .= $row2.', ';
	$x++;
}
else{
	$htm = $htm;
}
}
$symptoms_data = substr($htm, 0,-2);
	$data = array(
		'sn' =>$row->id_str,
		'date' =>$row->created_at,
		'username' =>$row->user->name,
		'tweets' =>$row->text,
		'symptoms' =>strtolower($symptoms_data),
		'address' =>$row->place->full_name,
		'latitude' =>$row->geo->coordinates[0],
		'longitude' =>$row->geo->coordinates[1],
		'hashtagno' =>$x,
		'date_generated' =>date('Y-m-d')
		);
	if ($x > 1) {
	$sn = checktwitterid($row->id_str);
	if (count($sn) == 0) {
			$tbl_name = '#__twitter_reports';
			$data = json_decode(json_encode($data), FALSE);
			save_data($data,$tbl_name);		
		}	
	}
}
function twitterapi(){
	error_reporting(0);
	require_once dirname(__FILE__) . '/flumonitor/hashtag/twitteroauth.php'; 
	// $consumer = 'pwaTrHaORgMwHH9cWzrFkIj27';
	// $consumersecret = 'FwoWShF6oeNMfpnR33vG0nTlip5hFE1996UCRJzDkNcqqncvmH';
	// $accesstoken = '3306663392-dgj9PwyFQ6GelvPGUl0RUgq4r1a3DwvAX0O4rMW';
	// $accesstokensecret = 'cZDf45whao2QzFRVXq556LUfhnR3OHMMMr98NplFC21VW';
	// // twitter second account chrisphpdeveloper5@yahoo.com
	$consumer = 'pqGHAuREZcJboEnANsY6uh25h';
	$consumersecret = 'KCbhWjgkBBuO1YqzJXLDpcAAOlZHKfW4rhHJX29SWBabNqR1FZ';
	$accesstoken = '3877989434-Ss4ulRH0XT6gAjA9iW9X0krTJ5hb5znQzDmGB75';
	$accesstokensecret = 'gamPJ3iqvPoCvzfhvSDhmcyubhdZm2dyf5TB0WKfp2Gng';
	$googleMapApi = 'AIzaSyANldOrkcTeu_Oz0E_RTB4erZoKB-frZxE';
	$twitterBaseUrl = 'https://api.twitter.com/1.1/search/tweets.json';
	$twitter = new TwitterOAuth($consumer,$consumersecret,$accesstoken,$accesstokensecret);
	$symptoms = symptoms();
	$tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q='.$symptoms.'&count=180&result_type=recent');
	$arr_tweets = (array)$tweets->statuses;
	return $arr_tweets;
}

function symptoms(){
	$result = listsymtoms();
	$x='';
	foreach ($result as $key => $val) {
	  $x .= '"'.$val.'"'."+OR+";
	}
	$y = rtrim($x,"+OR+");
	return $y;
}
function listsymtoms(){
	$result = getsymptomsalias();
	$b = array();	
	foreach ($result as $key => $row) {
		$a = $row->alias;
		 array_push($b, $a);
	}
	return $b;
}
?>