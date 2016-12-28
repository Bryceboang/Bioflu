<?php 
session_start();
require_once dirname(__FILE__) . '/../layout/config.php';
if (isset($_POST['submit'])) {
 	$_SESSION['session_id'] = $_POST['session'];
 	if (isset($_SESSION['session_id']) !='') {
 		header('location:home.php');
 	}else{
 		header('location:index.php');
 	}
 } 
 ?>