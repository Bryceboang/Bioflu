<?php
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


$id = $_POST['article_id'];


$result = mysql_query("SELECT * FROM bio_content WHERE id = '{$id}'") or die(mysql_error());

while ($row = mysql_fetch_assoc($result))
{
	$title = $row['title'];
}
echo $title;

?>