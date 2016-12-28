<?php
ini_set('memory_limit', '-1');
require_once('TwitterAPIExchange.php');

date_default_timezone_set("Asia/Manila"); 

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

$result = mysql_query("SELECT * FROM bio_twitter_reports LIMIT 136730, 10000");

mysql_close($dbhandle);


$hostname   = "161.202.29.32";
$username   = "biofludb_user";
$password   = "+E082ChKKzqy";
$database   = "biofludb_prod";

if (!$dbhandle = mysql_connect($hostname, $username, $password)) {
    echo 'Could not connect to mysql';
    exit;
}

if (!mysql_select_db($database, $dbhandle)) {
    echo 'Could not select database';
    exit;
}

while ($row = mysql_fetch_array($result)) {
    $tb_sn = $row['sn'];
    $tb_date = mysql_real_escape_string($row['date']);
    $tb_username = mysql_real_escape_string($row['username']);
    $tb_tweets = mysql_real_escape_string($row['tweets']);
    $tb_symptoms = mysql_real_escape_string($row['symptoms']);
    $tb_longitude = mysql_real_escape_string($row['latitude']);
    $tb_latitude = mysql_real_escape_string($row['longitude']);
    $tb_location = mysql_real_escape_string($row['address']);
    $tbl_date_generated = mysql_real_escape_string($row['date_generated']);


    //$tb_tweet = "INSERT INTO bio_twitter_reports (sn, date, username, tweets, symptoms, latitude, longitude, address, date_generated) VALUES('{$tb_sn}','{$tb_date}','{$tb_username}','{$tb_tweets}','{$tb_symptoms}','{$tb_longitude}','{$tb_latitude}','{$tb_location}','{$tbl_date_generated}');";
             //  mysql_query($tb_tweet) or die(mysql_error());
             //   $dailystats_ID = mysql_insert_id();

    //echo $dailystats_ID;
    echo "<br>";
}

/**/