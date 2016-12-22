<?php require_once dirname(__FILE__) . '/model.php'; 
$_GET['query']();

function get_data() {
	$table = $_POST['table'];
	$order_by = $_POST['order_by'];

	$data = get_data_model($table, $order_by);
	echo json_encode($data);
}

?>