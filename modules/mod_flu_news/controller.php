<?php require_once dirname(__FILE__) . '/model.php'; 
$_GET['query']();

function get_Banner() {
	// $uri = $_POST['uri'];
	$data = getBanner();
	echo json_encode($data);
}

?>