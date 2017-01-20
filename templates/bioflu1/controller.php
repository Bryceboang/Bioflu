<?php require_once dirname(__FILE__) . '/model.php'; 
$_GET['query']();

function get_data() {
	$table = $_POST['table'];
	$order_by = $_POST['order_by'];

	$data = get_data_model($table, $order_by);
	echo json_encode($data);
}


function getlist_global() {
	$table = $_POST['table'];
	$order_by = $_POST['order_by'];

	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = getlist_global_model($limit,$offset, $table, $order_by);
	echo json_encode($data);
}

function get_list_articles() {
	$table = $_POST['table'];
	$order_by = $_POST['order_by'];
	$articles = $_POST['articles'];
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = get_list_articles_model($limit,$offset, $table, $order_by, $articles);

	//echo json_encode(array("status" => $maximum, "data" => $data));
	echo json_encode($data);
}


function get_list_articles_filter() {
	$table = $_POST['table'];
	$order_by = $_POST['order_by'];
	$articles = $_POST['articles'];
	$year = $_POST['year'];
	//$month = $_POST['month'];
	// $offset = get_limit();
	$limit = $_POST['limit'];
	//$offset = ($_POST['offset']-1)* $limit;
	$offset = $_POST['offset'];
	if($year == '' || $year == null ){
		//$limit = count(get_list_articles_model($limit,$offset, $table, $order_by, $articles));
		$data = get_list_articles_model($limit,$offset, $table, $order_by, $articles);
	} else {
		//$limit = count(get_list_articles_filter_model($limit,$offset, $table, $order_by, $articles, $year, $month));
		$data = get_list_articles_filter_model($limit,$offset, $table, $order_by, $articles, $year);
	}
	echo json_encode($data);
}

function get_count_articles() {
	$table = $_POST['table'];
	$order_by = $_POST['order_by'];
	$articles = $_POST['articles'];

	$per_page = $_POST['limit'];
	if($articles == 1){
		$limit = get_limit();
	} else {
		$limit = '9999999';
	}
	$offset = '0';
	$data = count(get_list_articles_model($limit,$offset, $table, $order_by, $articles));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function get_count_articles_filter() {
	$table = $_POST['table'];
	$order_by = $_POST['order_by'];
	$articles = $_POST['articles'];
	$year = $_POST['year'];
	//$month = $_POST['month'];

	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset =  get_limit(); 
	$offset = $offset + 1;
	//'0';
	//$offset = get_limit();
	if($year == '' || $year == null ){
		$data = count(get_list_articles_model($limit,$offset, $table, $order_by, $articles));
	} else {
		$data = count(get_list_articles_filter_model($limit,$offset, $table, $order_by, $articles, $year));
	}
	
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function getcount_global() {
	$table = $_POST['table'];
	$order_by = $_POST['order_by'];

	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	$data = count(getlist_global_model($limit,$offset, $table, $order_by));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}


function get_limitation() {
	$limit = get_limit();
	echo $limit;
}


function get_limitation_id() {
	$offset = get_limit();
	$articles = 1;
	$limit = get_limit_id($offset,$articles);
	echo $limit;
}


function add_count() {
	$id = $_POST['id'];
	$data = add_count_model($id);
}


function get_search_data() {
	$flu_one = $_POST['flu_one'];
	$flu_two = $_POST['flu_two'];

	$data = get_serach_data_model( $flu_one, $flu_two);
	echo json_encode($data);
}

?>