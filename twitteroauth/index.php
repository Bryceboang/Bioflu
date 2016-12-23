<?php
session_start();
require 'autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;
define('CONSUMER_KEY', 'o8ZBskCyrGNPpZsANQ0mt0Dd7'); // add your app consumer key between single quotes
define('CONSUMER_SECRET', 'eEFXIPMpPT7j7KWgTgHL8PtNMvIeqExAK2CKI5XPhDhXBlOSQB'); // add your app consumer secret key between single quotes
define('OAUTH_CALLBACK', 'http://bioflu2.ecomqa.com/twitteroauth/callback.php'); // your app callback URL
if (!isset($_SESSION['access_token'])) {
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
	$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
	echo json_encode(array("status" => "error", "url" => $url));

} else {
	$access_token = $_SESSION['access_token'];
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	$user = $connection->get("account/verify_credentials");

	echo json_encode(array("status" => "success", "user_id" => $user->id, "username" => $user->screen_name, "location" => $user->location, "profile_image_url" => $user->profile_image_url));
}