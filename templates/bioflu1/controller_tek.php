<?php require_once dirname(__FILE__) . '/model_tek.php'; 
$_GET['query']();

function get_homeVideo(){
	$data = getHomeVideo();
	echo json_encode($data);
}

function get_Article(){
	$alias = $_POST['alias'];
	$data = getArticle($alias);
	echo json_encode($data);
}

function get_widget(){
	$data = getWidget();
	echo json_encode($data);
}

function get_RelatedArticles(){
	$tags = $_POST['tags'];
	$limit = $_POST['limit'];
	$data = getrelatedArticles($tags,$limit);
	echo json_encode($data);
}

function submit_comment() {

	if(isset($_POST['comment_id'])){
		$comment_id = $_POST['comment_id'];
	}
	else{
		$comment_id = '0';
	}
	if(isset($_POST['is_parent'])){
		$is_parent = $_POST['is_parent'];
	}
	else{
		$is_parent = '1';
	}

	$data = array(
		'article_id' => $_POST['article_id'],
		'comment_id' => $_POST['comment_id'],
		'comment' => $_POST['comment'],
		'fb_name' => $_POST['fb_name'],
		'fb_id' => $_POST['fb_id'],
		'fb_photo' => $_POST['fb_photo'],
		'is_parent' => $is_parent,
		'is_active' => '0'		
		);
	$tbl_name = '#__article_comments';
	$data = json_decode(json_encode($data), FALSE);
	$id = save_data($data,$tbl_name);

	echo $id;
}

function get_comment() {	
	$is_parent = $_POST['is_parent'];
	$comment_id = $_POST['comment_id'];
	$id = $_POST['article_id'];
	$sort = $_POST['sort'];
	$data = getcomment($is_parent,$comment_id,$id,$sort);
	echo json_encode($data);
}

function save_like(){
	$data = array(
		'fb_id' => $_POST['fb_id'],
		'comment_id' => $_POST['com_id']
		);
	$tbl_name = '#__like_comments';
	$data = json_decode(json_encode($data), FALSE);
	save_data($data,$tbl_name);
}
function update_like(){
	$data = array(
		'id' => $_POST['id'],
		'like_count' => $_POST['count']
		);
	$tbl_name = '#__article_comments';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');

}

function delete_like(){
	$fb_id = $_POST['fb_id'];
	$com_id = $_POST['com_id'];
	$data = deletelike($fb_id,$com_id);
	echo json_encode($data);
}

function checkLike(){
	$id = $_POST['fb'];
	$com_id = $_POST['com'];
	$data = checkLikeStatus($id,$com_id);
	echo json_encode($data);
}

function getSearch(){
	$search = $_POST['search_term'];
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = get_search_result($search,$limit,$offset);
	echo json_encode($data);
}

function getSearch_count() {
	$per_page = $_POST['limit'];
	$search = $_POST['search_term'];
	$limit = '9999999';
	$offset = '0';
	$data = count(get_search_result($search,$limit,$offset));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function get_limitArchive(){
	$limit = get_articleLimit();
	echo json_encode($limit);
}

function get_articleList(){
	$cat = $_POST['cat'];
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = get_article_List($cat,$limit,$offset);
	echo json_encode($data);
}
function count_curated(){
	$limit = '';
	$offset = '';
	$cat = '2';
	$data = count(get_article_List($cat,$limit,$offset));
	echo $data;
}
function get_home_symptoms(){
	$limit = 4;
	$data = getFluSymptoms($limit);
	echo json_encode($data);
}
function get_productInfo(){
	$data = getProducts_info();
	echo json_encode($data);
}
?>