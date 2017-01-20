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


$data = get_twitter_report();
echo "<pre>";
print_r($data);
$data2_array = array();

foreach ($data as $key => $value) {
    $id = $value['id'];
    $address = str_replace(" ", "+", $value['address']);

    //$geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?key=AIzaSyCAp0rfvNXFlin9qgVY8Pw3rRqOFxXy-fk&address='.$address.'&sensor=false');
    //$output= json_decode($geocode);

    //$latitude = $output->results[0]->geometry->location->lat;
    //$longitude = $output->results[0]->geometry->location->lng;
    //$tb_tweet = "UPDATE bio_twitter_reports SET latitude = '{$latitude}', longitude = '{$longitude}', is_updated ='1' WHERE id = '{$id}' ";
    //mysql_query($tb_tweet) or die(mysql_error());
   /* array_push($data2_array, $data2);*/
}


function get_twitter_report() {
	$data_array = array();
	$results = mysql_query("SELECT id, longitude, latitude, address FROM bio_twitter_reports WHERE address !='' AND latitude='' order by id ");
	while($row = mysql_fetch_assoc($results)){

	  $resultset = $row; // fetch each row...
	  array_push($data_array,$resultset);
	}

	return $data_array;

}

