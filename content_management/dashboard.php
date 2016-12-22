<?php //session_start(); 
require_once dirname(__FILE__) . '/model.php'; 

//ob_start();
$_GET['function']();
date_default_timezone_set('Asia/Manila');

function get_articles() {
	$search = $_POST['search'];
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = article_list($limit,$offset,$search);
	echo json_encode($data);
}

function get_articles_aboutus() {
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = article_aboutus($limit,$offset);
	echo json_encode($data);
}


function get_articles_aboutus_count() {
	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	$data = count(article_aboutus($limit,$offset));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function get_imagegallery() {
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = image_gallery($limit,$offset);
	echo json_encode($data);
}

function get_videogallery() {
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = video_gallery($limit,$offset);
	echo json_encode($data);
}

function get_videogallery_count() {
	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	$data = count(video_gallery($limit,$offset));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function edit_imagegallery() {
	$id = $_POST['id'];
	$data = get_image_gallery($id);
	echo json_encode($data);
}



function get_imagegallery_count() {
	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	$data = count(image_gallery($limit,$offset));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function get_articles_contactus() {
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = article_contactus($limit,$offset);
	echo json_encode($data);
}


function get_articles_contactus_count() {
	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	$data = count(article_contactus($limit,$offset));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function edit_article() {
	$id = $_POST['id'];
	$data = get_article($id);
	echo json_encode($data);
}

function edit_ads() {
	$id = $_POST['id'];
	$data = get_ads_m($id);
	echo json_encode($data);
}

function edit_product() {
	$data = get_products();
	echo json_encode($data);
}

function get_articles_count() {
	$search = $_POST['search'];
	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	$data = count(article_list($limit,$offset,$search));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function get_ads_count() {
	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	$data = count(ads_list($limit,$offset));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function save_articles(){

if ($_POST['finish'] == '0000-00-00 00:00:00' || $_POST['finish'] == '') {
		$down = '0000-00-00 00:00:00';
	}else{
		$down = date('Y-m-d h:i:s', strtotime($_POST['finish']));
	}

	if ($_POST['start'] == '0000-00-00 00:00:00' || $_POST['start'] == '') {
		$start = date('Y-m-d h:i:s');
	}else{
		$start = date('Y-m-d h:i:s', strtotime($_POST['start']));
	}

	$string = strtolower(str_replace(' ', '-', $_POST['title']));
    $alias = preg_replace('/[^A-Za-z0-9\-]/', '', $string);

	$data = array(
		'tags' => $_POST['tags'],
		'article_title' => $_POST['title'],
		'intro_text' => $_POST['content'],
		//'introtext' => '<div class ="col-md-8 articles"><div class ="col-md-12"><h2><label>'.strtoupper($_POST['title']).'</label></h2></div><div class="col-md-12 sharer-container pad-0"></div><div class ="col-md-12">'.$_POST['content'].'</div><div class="col-md-12 sharer-container pad-0"></div></div>',
		'image' => str_replace('../', '', $_POST['thumbnailimage']),
		'state' => $_POST['state'],
		'cat_type' => $_POST['catid'], //category id ex. articles
		'author' => $_POST['author'],
		'created' => date('Y-m-d h:i:s'),
		'date_published' => $start,
		'end_published' => $down,
		// 'access' => '1',
		// 'modified' => date('Y-m-d h:i:s')
		);


	$tbl_name = '#__flunew_articles';
	$data = json_decode(json_encode($data), FALSE);
	save_data($data,$tbl_name);
}

function save_ads(){
	$data = array(
		'title' => $_POST['title'],
		'introtext' => $_POST['content'],
		'alias' => strtolower(str_replace(' ', '-', $_POST['title'])),
		'state' => '1'
		);
	$tbl_name = '#__content';
	$data = json_decode(json_encode($data), FALSE);
	save_data($data,$tbl_name);
}

function update_articles(){

	if ($_POST['finish'] == '0000-00-00 00:00:00' || $_POST['finish'] == '') {
		$down = '0000-00-00 00:00:00';
	}else{
		$down = date('Y-m-d h:i:s', strtotime($_POST['finish']));
	}

	// $data = array(
	// 	'id' => $_POST['id'],
	// 	'title' => $_POST['title'],
	// 	'image_path' => str_replace('../', '', $_POST['thumbnailimage']),
	// 	'introtext' => $_POST['content'],
	// 	// 'alias' => strtolower(str_replace(' ', '-', $_POST['title'])),
	// 	'state' => $_POST['state'],
	// 	'catid' => $_POST['catid'],
	// 	'publish_up' => date('Y-m-d h:i:s', strtotime($_POST['start'])),
	// 	'publish_down' => $down,
	// 	'created_by' => $_SESSION['session_id'],
	// 	'modified' => date('Y-m-d h:i:s')
	// 	); 

	$string = strtolower(str_replace(' ', '-', $_POST['title']));

	$data = array(
		'id' => $_POST['id'],
		'article_title' => $_POST['title'],
		'intro_text' => $_POST['content'],
		//'introtext' => '<div class ="col-md-8 articles"><div class ="col-md-12"><h2><label>'.strtoupper($_POST['title']).'</label></h2></div><div class="col-md-12 sharer-container pad-0"></div><div class ="col-md-12">'.$_POST['content'].'</div><div class="col-md-12 sharer-container pad-0"></div></div>',
		'image' => str_replace('../', '', $_POST['thumbnailimage']),
		'state' => $_POST['state'],
		'author' => $_POST['author'],
		'tags' => $_POST['tags'],
		'cat_type' => $_POST['catid'], //category id ex. articles
		'created_by' => $_SESSION['session_id'],
		'date_published' => date('Y-m-d', strtotime($_POST['start'])),
		'end_published' => $down,
		'created' => date('Y-m-d h:i:s')
		);



	$tbl_name = '#__flunew_articles';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');

}

function update_ads(){
	$data = array(
		'id' => $_POST['id'],
		'title' => $_POST['title'],
		'yes_link' => $_POST['yeslink'],
		'subtext' => $_POST['subtitle'],
		'status' => $_POST['status'],
		'no_link' => $_POST['nolink']
		); 
	$tbl_name = '#__widgets';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}

function get_videos(){
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = video_list($limit,$offset);
	echo json_encode($data);
}

function get_videos_count(){
	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	$data = count(video_list($limit,$offset));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function remove_videos(){
	$id = $_POST['id'];
	$data = delete_data($id);
	echo json_encode($data);

}

function getimages(){
	$files = glob("../images/bioflu/*.*");
	echo "<div class = 'col-md-12 size' style='overflow:scroll; height: 350px;'> ";
	for ($i=0; $i<count($files); $i++)
	{
		$path = $files[$i];
		
		echo "<div class = 'col-md-2 col-xs-2 col-sm-2 pad-5 image-con' style = 'margin:10px 9px; border-radius:3px;'> <div class = 'col-md-12 pad-0 size-img' style='overflow: hidden; height: 48px;'>
			<img style = 'position:absolute; display:none' class = 'check check_".$i."' width='15px' src = 'assets/img/check.png'>
		 <p style = 'display:none;'>" . $path;
		 $filename = explode('/', $path);
		echo '</p><img title="'.$filename[3].'" class = "image-file img-file_'.$i.'" data-id = "'.$i.'" style = "width:100%; min-height: 42px; cursor:pointer; text-align:center;" src="'.$path.'" alt="random image" />'."</div><d style = 'font-size:10px;' title='".$filename[3]."'>".substr($filename[3], 0, 15)."</d></div>";
		
	}
	echo "</div>";
}




function getvideos(){
	$files = glob("../images/videos/*.*");
	echo "<div class = 'col-md-12 size' style='overflow:scroll; height: 350px;'>";
	for ($i=0; $i<count($files); $i++)
	{
		$path = $files[$i];
		
		echo "<div class = 'col-md-2 col-xs-2 col-sm-2 pad-5 image-con' style = 'margin:10px 9px; border-radius:3px;'> <div class = 'col-md-12 pad-0 size-img' style='overflow: hidden; height: 48px;'>
			<img style = 'position:absolute; display:none' class = 'check check_".$i."' width='15px' src = 'assets/img/check.png'>
		 <p style = 'display:none;'>" . $path;
		 $filename = explode('/', $path);
		echo '</p><video width="100%"  class = "image-file img-file_'.$i.'" data-id = "'.$i.'" src="'.$path.'" controls ><source title="'.$filename[3].'" class = "image-file img-file_'.$i.'" data-id = "'.$i.'" src="'.$path.'"  type="video/mp4"></video>'."</div><d style = 'font-size:10px;' title='".$filename[3]."'>".substr($filename[3], 0, 17).".mp4</d></div>";
		
	}
	echo "</div>";
}

function getmodalvideos(){
	$files = glob("../images/videos/*.*");
	echo "<div class = 'col-md-12 size' style='overflow:scroll; height: 350px;'>";
	for ($i=0; $i<count($files); $i++)
	{
		$path = $files[$i];
		
		echo "<div class = 'col-md-2 col-xs-2 col-sm-2 pad-5 image-con' style = 'margin:10px 9px; border-radius:3px;'> <div class = 'col-md-12 pad-0 size-img' style='overflow: hidden; height: 48px;'>
			<img style = 'position:absolute; display:none' class = 'check check_".$i."' width='15px' src = 'assets/img/check.png'>
		 <p style = 'display:none;'>" . $path;
		 $filename = explode('/', $path);
		echo '</p><video width="100%"  class = "image-file img-file_'.$i.'" data-id = "'.$i.'" src="'.$path.'" controls ><source title="'.$filename[3].'" class = "image-file img-file_'.$i.'" data-id = "'.$i.'" src="'.$path.'"  type="video/mp4"></video>'."</div><d style = 'font-size:10px;' title='".$filename[3]."'>".substr($filename[3], 0, 7)."...mp4</d></div>";
		
	}
	echo "</div>";
}

function add_video(){
	$data = array(
		'title' => $_POST['title'],
		'description' => $_POST['desc'],
		'alias' => strtolower(str_replace(' ', '-', $_POST['title'])),
		'path' =>'/uploads/' . $_POST['file'],
		'creation_date' => $_POST['date']
		);
	$tbl_name = '#__videos';
	$data = json_decode(json_encode($data), FALSE);
	save_video($data,$tbl_name);
}

function get_ads(){
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = ads_list($limit,$offset);
	echo json_encode($data);
}

function add_ads(){
	$data = array(
		'title' => $_POST['title'],
		'yes_link' => $_POST['yeslink'],
		'subtext' => $_POST['subtitle'],
		'no_link' => $_POST['nolink']
		);
	$tbl_name = '#__widgets';
	$data = json_decode(json_encode($data), FALSE);
	save_data($data,$tbl_name);
}

function get_slider(){
	$data = slider_list();
	echo json_encode($data);
}

function uploadfile(){

	if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
        move_uploaded_file($_FILES['file']['tmp_name'], '../images/bioflu/' . $_FILES['file']['name']);
    }

}

function uploadvideo(){

	if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
        move_uploaded_file($_FILES['file']['tmp_name'], '../images/videos/' . $_FILES['file']['name']);
    }

}


function insertslider(){
	$data = array(
		'id' => $_POST['id'],
		'params' => $_POST['params'],
		); 

	$tbl_name = '#__modules';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}

function get_data_slider(){
	$id = $_POST['id'];
	$data = getslider($id);
	echo '['.$data[0]['params'].']';

}




function inactive_article_update(){
	$id = $_POST['id'];
	$type = $_POST['type'];
	inactive_article($id, $type);
}

function inactive_module_update(){
	$id = $_POST['id'];
	$type = $_POST['type'];
	inactive_module($id, $type);
}

function login_controller(){
	$username = $_POST['username'];
	$password = sha1($_POST['password']);
	login($username, $password);
		$result = login($username, $password);
		$msg = '';
	if ($result != NULL) {
		$msg = array('status' => 'success', 'id' => $result[0]->id);
	}else{
		$msg = array('status' => 'failed');
	}
	


	echo json_encode($msg);

}

function menu(){
	echo json_encode(getmenu());
}

function submenu(){
	echo json_encode(getsubmenu($_POST['id']));
}

function updatesetting_controller(){
	$id = $_POST['id'];
	$status = $_POST['status'];
	updatesettings($id, $status);
}

function get_category(){
	$data = get_categories();
	echo json_encode($data);	
}

function get_facility(){
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = gethospital($limit,$offset);
	echo json_encode($data);
}

function get_facility_count() {
	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	$data = count(gethospital($limit,$offset));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function save_imagegallery(){
	$data = array(
		'image' => str_replace('../', '', $_POST['image']),
		'title' => $_POST['title'],
		'description' => $_POST['description'],
		'url' => $_POST['url']
		);
	$tbl_name = '#__image_gallery';
	$data = json_decode(json_encode($data), FALSE);
	save_data($data,$tbl_name);
}

function update_imagegallery(){
	$data = array(
		'id' => $_POST['id'],
		'image' => str_replace('../', '', $_POST['image']),
		'title' => $_POST['title'],
		'description' => $_POST['description'],
		'url' => $_POST['url']
		); 

	$tbl_name = '#__image_gallery';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}


function update_imagegallery_status(){
	$data = array(
		'id' => $_POST['id'],
		'state' => $_POST['state']
		); 

	$tbl_name = '#__image_gallery';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}

function save_videogallery(){
	$data = array(
		'path' => $_POST['video'],
		'title' => $_POST['title'],
		'thumbnail' => $_POST['image'],
		'description' => $_POST['desc'],
		'status' => $_POST['status'],
		'is_featured' => $_POST['feat']
		);
	$tbl_name = '#__video';
	$data = json_decode(json_encode($data), FALSE);
	$id = save_data($data,$tbl_name);
	if($_POST['feat'] == 1){
		update_isfeatured($id);
	}
}

function edit_videogallery() {
	$id = $_POST['id'];
	$data = get_video_gallery($id);
	echo json_encode($data);
}

function update_videogallery(){
	if($_POST['feat'] == 1){
		$id = $_POST['id'];
		update_isfeatured($id);
	}
	$data = array(
		'id' => $_POST['id'],
		'path' => $_POST['video'],
		'title' => $_POST['title'],
		'thumbnail' => $_POST['image'],
		'description' => $_POST['desc'],
		'status' => $_POST['status'],
		'is_featured' => $_POST['feat']
		); 

	$tbl_name = '#__video';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}


function update_videogallery_status(){
	$data = array(
		'id' => $_POST['id'],
		'state' => $_POST['state']
		); 

	$tbl_name = '#__video_gallery';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}

function get_host() {
	$data = gethost();
	echo json_encode($data);
}

function update_host(){
	$data = array(
		'id' => $_POST['id'],
		'smtp_host' => $_POST['smtphost'],
		'smtp_port' => $_POST['smtpport'],
		'smtp_username' => $_POST['smtpusername'],
		'smtp_password' => $_POST['smtppassword'],
		'mailrecipient' => $_POST['mailrecipient']
		); 

	$tbl_name = '#__contact_us';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}

function get_symptoms() {
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = getsymptoms($limit,$offset);
	echo json_encode($data);
}


function get_symptoms_count() {
	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	$data = count(getsymptoms($limit,$offset));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function edit_symptoms() {
	$id = $_POST['id'];
	$data = editsymptoms($id);
	echo json_encode($data);
}

function update_symptoms(){
	$data = array(
		'id' => $_POST['id'],
		'flu_symptoms' => $_POST['symptom'],
		'alias' => $_POST['alias'],
		'state' => $_POST['status'],
		); 

	$tbl_name = '#__flu_symptoms';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}

function update_symptoms_status(){
	$data = array(
		'id' => $_POST['id'],
		'state' => $_POST['status']
		); 

	$tbl_name = '#__flu_symptoms';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}

function saved_symptoms(){
	$data = array(
		'flu_symptoms' => $_POST['flu_symptoms'],
		'alias' => $_POST['alias'],
		'state' => $_POST['status']
		);
	$tbl_name = '#__flu_symptoms';
	$data = json_decode(json_encode($data), FALSE);
	save_data($data,$tbl_name);
}

function edit_hospital() {
	$id = $_POST['id'];
	$data = edithospital($id);
	echo json_encode($data);
}

function update_facility(){
	$data = array(
		'id' => $_POST['id'],
		'facility_code' => $_POST['facility_code'],
		'facility_name' => $_POST['facility_name'],
		'street_name' => $_POST['street_name'],
		'region_name' => $_POST['region_name'],
		'city_name' => $_POST['city_name'],
		'province_name' => $_POST['province_name'],
		'barangay_name' => $_POST['barangay_name'],
		'is_active' => $_POST['status'],
		'latitude' => $_POST['latitude'],
		'longitude' => $_POST['longitude']
		); 



	$tbl_name = '#__maps_facility';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}

function update_facility_status(){
	$data = array(
		'id' => $_POST['id'],
		'is_active' => $_POST['status']
		); 

	$tbl_name = '#__maps_facility';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}


function saved_facility(){
	$data = array(
		'facility_code' => $_POST['facility_code'],
		'facility_name' => $_POST['facility_name'],
		'street_name' => $_POST['street_name'],
		'region_name' => $_POST['region_name'],
		'city_name' => $_POST['city_name'],
		'province_name' => $_POST['province_name'],
		'barangay_name' => $_POST['barangay_name'],
		'is_active' => $_POST['status'],
		'latitude' => $_POST['latitude'],
		'longitude' => $_POST['longitude']
		);  
	$tbl_name = '#__maps_facility';
	$data = json_decode(json_encode($data), FALSE);
	save_data($data,$tbl_name);
}

function get_drugstore(){
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = getdrugstore($limit,$offset);
	echo json_encode($data);
}

function get_drugstore_count() {
	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	$data = count(getdrugstore($limit,$offset));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function edit_drugstore() {
	$id = $_POST['id'];
	$data = editdrugstore($id);
	echo json_encode($data);
}

function update_drugstore(){
	$data = array(
		'id' => $_POST['id'],
		'name' => $_POST['name'],
		'address1' => $_POST['address1'],
		'address2' => $_POST['address2'],
		'contact_number' => $_POST['contact_number'],
		'zip_code' => $_POST['zip_code'],
		'latitude' => $_POST['latitude'],
		'longitude' => $_POST['longitude'],
		'complete_address' => $_POST['complete_address'],
		'is_active' => $_POST['status']
		); 

	$tbl_name = '#__maps_drugstore';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}

function update_drugstore_status(){
	$data = array(
		'id' => $_POST['id'],
		'is_active' => $_POST['status']
		); 

	$tbl_name = '#__maps_drugstore';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}

function saved_drugstore(){
	$data = array(
		'name' => $_POST['name'],
		'address1' => $_POST['address1'],
		'address2' => $_POST['address2'],
		'contact_number' => $_POST['contact_number'],
		'zip_code' => $_POST['zip_code'],
		'latitude' => $_POST['latitude'],
		'longitude' => $_POST['longitude'],
		'complete_address' => $_POST['complete_address'],
		'is_active' => $_POST['status']
		); 
	$tbl_name = '#__maps_drugstore';
	$data = json_decode(json_encode($data), FALSE);
	save_data($data,$tbl_name);
}

function get_flu_reports(){
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = getflureports($limit,$offset);
	echo json_encode($data);
}

function get_flu_reports_count() {
	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	$data = count(getflureports($limit,$offset));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function edit_flureports() {
	$id = $_POST['id'];
	$data = editflureports($id);
	echo json_encode($data);
}

function get_promo() {
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = getpromo($limit,$offset);
	echo json_encode($data);
}

function saved_about(){
	$data = array(
		'title' => $_POST['title'],
		'content' => $_POST['content'],
		'state' => $_POST['state']
		);  
	$tbl_name = '#__maps_about';
	$data = json_decode(json_encode($data), FALSE);
	save_data($data,$tbl_name);
}

function get_promo_count() {
	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	$data = count(getpromo($limit,$offset));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function edit_promo() {
	$id = $_POST['id'];
	$data = editpromo($id);
	echo json_encode($data);
}

function update_promo(){
	$data = array(
		'promotion_id' => $_POST['id'],
		'promotion_name' => $_POST['promotion_name'],
		'promotion_description' => $_POST['promotion_description'],
		'is_active' => $_POST['status'],
		); 

	$tbl_name = '#__maps_promotion';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'promotion_id');
}

function saved_promo(){
	$data = array(
		'promotion_name' => $_POST['promotion_name'],
		'promotion_description' => $_POST['promotion_description'],
		'is_active' => $_POST['status'],
		); 
	$tbl_name = '#__maps_promotion';
	$data = json_decode(json_encode($data), FALSE);
	save_data($data,$tbl_name);
}

function update_promo_status(){
	$data = array(
		'promotion_id' => $_POST['id'],
		'is_active' => $_POST['status']
		); 

	$tbl_name = '#__maps_promotion';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'promotion_id');
}

function get_promolist() {
	$data = getpromolist();
	echo json_encode($data);
}

function get_usersymptoms() {
	$id = $_POST['id'];
	$data = getusersymptoms($id);
	echo json_encode($data);
}

function get_location() {
	$id = $_POST['id'];
	$data = getlocation($id);
	echo json_encode($data);
}


function get_menu_settings(){
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = getmenusettings($limit,$offset);
	echo json_encode($data);
}

function get_menu_settings_count() {
	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	$data = count(getmenusettings($limit,$offset));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function edit_menu() {
	$id = $_POST['id'];
	$data = editmenu($id);
	echo json_encode($data);
}

function get_select_article() {
	$data = getselectarticle();
	echo json_encode($data);
}


function assign_promotion(){
	$data = array(
		'promo_id' => $_POST['promo_id'],
		'drugstore_id' => $_POST['drugstore_id']
		); 
	$tbl_name = '#__assigned_promo';
	$data = json_decode(json_encode($data), FALSE);
	save_data($data,$tbl_name);
}

function get_assign_promotion(){

	$data = assignpromotion($_POST['id']);
	echo json_encode($data);
}

function get_drugstore_assign(){

	$data = getdrugstoreassign();
	echo json_encode($data);
}

function remove_promo(){
	$id = $_POST['id'];
	$data = removepromo($id);
	echo json_encode($data);

}

function submenusub(){
	echo json_encode(getsubmenusub($_POST['id']));
}


function twitterapi(){
error_reporting(0);
require_once dirname(__FILE__) . '/flumonitor/hashtag/twitteroauth.php'; 
// $consumer = 'pwaTrHaORgMwHH9cWzrFkIj27';
// $consumersecret = 'FwoWShF6oeNMfpnR33vG0nTlip5hFE1996UCRJzDkNcqqncvmH';
// $accesstoken = '3306663392-dgj9PwyFQ6GelvPGUl0RUgq4r1a3DwvAX0O4rMW';
// $accesstokensecret = 'cZDf45whao2QzFRVXq556LUfhnR3OHMMMr98NplFC21VW';
// twitter second account chrisphpdeveloper5@yahoo.com
$consumer = 'pqGHAuREZcJboEnANsY6uh25h';
$consumersecret = 'KCbhWjgkBBuO1YqzJXLDpcAAOlZHKfW4rhHJX29SWBabNqR1FZ';
$accesstoken = '3877989434-Ss4ulRH0XT6gAjA9iW9X0krTJ5hb5znQzDmGB75';
$accesstokensecret = 'gamPJ3iqvPoCvzfhvSDhmcyubhdZm2dyf5TB0WKfp2Gng';
$googleMapApi = 'AIzaSyANldOrkcTeu_Oz0E_RTB4erZoKB-frZxE';
$twitterBaseUrl = 'https://api.twitter.com/1.1/search/tweets.json';
$twitter = new TwitterOAuth($consumer,$consumersecret,$accesstoken,$accesstokensecret);
$symptoms = symptoms();
$tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q='.$symptoms.'&count=180&result_type=recent');

//$tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=ubo sipon&count=100&result_type=recent');
//$tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=ubo sipon&since=2015-10-23&until=2015-10-24&count=100&result_type=recent');
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

function export_tweets(){
	//error_reporting(0);
	$data_get = $_GET['data_get'];
	$date = date('m-d-Y');
	$filename = "Report-" .$date. ".xls";
	header("Content-Disposition: attachment; filename=\"$filename\"");
	header("Content-Type: application/vnd.ms-excel");
	get_twitter_reports_export($data_get);
}

function exports(){
	error_reporting(0);
	$date = date('Y-m-d');
	$filename = "Report-" .$date. ".xls";
	header("Content-Disposition: attachment; filename=\"$filename\"");
	header("Content-Type: application/vnd.ms-excel");
	exporttwitter();
}

function prints(){
	$result = twitterapi();
	echo "<pre>";
	print_r($result);
}

function exporttwitter(){
$result = twitterapi();
$symptoms = listsymtoms();
$x = 1;
$htm = "";
$htm .= '<table border="1">';
$htm .= '<thead>';
$htm .= '<tr>';
$htm .= '<th rowspan="2">NO.</th>';
$htm .= '<th rowspan="2">SN</th>';
$htm .= '<th rowspan="2">Date/Time</th>';
$htm .= '<th rowspan="2">Username</th>';
$htm .= '<th rowspan="2">Tweets</th>';
$htm .= '<th rowspan="2">Symptoms</th>';
$htm .= '<th colspan="2">GEO</th>';
$htm .= '<th rowspan="2">Address</th>';
$htm .= '</tr>';

$htm .= '<tr>';
$htm .= '<th>Latitude</th>';
$htm .= '<th>Longitude</th>';
$htm .= '</tr>';

$htm .= '</thead>';

foreach ($result as $key => $row) { 
$htm .= '<tbody>';
$htm .= '<tr>';
$htm .= '<td>'.$x.'</td>';
$htm .= '<td>'.$row->id_str.'</td>';
$htm .= '<td>'.$row->created_at.'</td>';
$htm .= '<td>'.$row->user->name.'</td>';
$htm .= '<td>'.$row->text.'</td>';

$htm .= '<td style = "width:100px;" >';
$x++;
$a='';

foreach ($symptoms as $key => $row2) { 
if(stripos($row->text, $row2) !== FALSE){
	
	$a .= $row2.', ';
}
else{
	$a = $a;
	
}
}
$b = substr($a, 0,-2);
$htm .= $b;
$htm .= '</td>';
$htm .= '<td>'.$row->geo->coordinates[0].'</td>';
$htm .= '<td>'.$row->geo->coordinates[1].'</td>';
$htm .= '<td>'.$row->place->full_name.'</td>';
$htm .= '</tr>';
$htm .= '</tbody>';
}
$htm .= '</table>';
echo $htm;
}

function twitter(){
$result = twitterapi();
$symptoms = listsymtoms();
$x = 1;
$htm = "";
$htm .= '<table class = "table-bordered">';
$htm .= '<thead>';
$htm .= '<tr>';
$htm .= '<th rowspan="2">NO.</th>';
$htm .= '<th rowspan="2">SN</th>';
$htm .= '<th rowspan="2">Date/Time</th>';
$htm .= '<th rowspan="2">Username</th>';
$htm .= '<th rowspan="2">Tweets</th>';
$htm .= '<th rowspan="2">Symptoms</th>';
$htm .= '<th colspan="2">GEO</th>';
$htm .= '<th rowspan="2">Address</th>';
$htm .= '</tr>';

$htm .= '<tr>';
$htm .= '<th>Latitude</th>';
$htm .= '<th>Longitude</th>';
$htm .= '</tr>';

$htm .= '</thead>';
foreach ($result as $key => $row) { 
$htm .= '<tbody>';
$htm .= '<tr>';
$htm .= '<td>'.$x.'</td>';
$htm .= '<td>'.$row->id_str.'</td>';
$htm .= '<td>'.$row->created_at.'</td>';
$htm .= '<td>'.$row->user->name.'</td>';
$htm .= '<td>'.$row->text.'</td>';

$htm .= '<td style = "width:100px;" >';
$x++;
$a='';
/*foreach ($row->entities->hashtags as $key => $row2) { 
if (in_array(strtolower($row2->text), $symptoms)) {
	$a .= $row2->text.', ';
} 
}
$b = substr($a, 0,-2);*/
foreach ($symptoms as $key => $row2) { 
if(stripos($row->text, $row2) !== FALSE){
	
	$a .= $row2.', ';
}
else{
	$a = $a;
	
}
}
$b = substr($a, 0,-2);
$htm .= $b;
$htm .= '</td>';
$htm .= '<td>'.$row->geo->coordinates[0].'</td>';
$htm .= '<td>'.$row->geo->coordinates[1].'</td>';
$htm .= '<td>'.$row->place->full_name.'</td>';
$htm .= '</tr>';
$htm .= '</tbody>';
}
$htm .= '</table>';
echo $htm;
}

function insert_tweets(){

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
}




function twitterinterjection($bordered){
	$startdate = date('Y-m-d', strtotime($_GET['startdate']));
	$enddate = date('Y-m-d', strtotime($_GET['enddate']));
	$group = groupings();
	$fin = array();
	foreach ($group as $key => $grp) {
			
		
		$data = twitter_interjection($grp->id);

		$data2['group_name'] = $grp->name;
		$x = 0;
		foreach ($data as $key => $row) {
			
			$result = gettwosymptoms($row->symptom1, $startdate, $enddate);

			if(count($result)!=0){

				foreach ($result as $key => $value) {
					if(stripos($value->symptoms, $row->symptom2) !== FALSE){
						$x++;
					}
			
				}
			}

		}
		$data2['count'] = $x;

		array_push($fin, $data2);

	}

if ($bordered == 'bordered') {
	$border = 1;
	$colorhead = 'background:#2e6da4;color:#fff';

}else{
	$border = 0;
	$colorhead = none;
}

	$htm = '';
	$htm .= '<table border="'.$border.'" class = "table-bordered">';
	$htm .= '<thead>';
	$htm .= '<tr>';
	$htm .= '<th style = "'.$colorhead.'">MULTI-SYMPTOMS</th>';
	$htm .= '<th style = "'.$colorhead.'">COUNT</th>';
	$htm .= '</tr>';
	$htm .= '</thead>';
	$htm .= '<tbody>';
	
		$n = 0;
		$total= 0;
	foreach ($fin as $key => $res) {
		$htm .= '<tr>';
		if ($res['group_name'] =='Flu Effects' ) {
		   $x = '';
		}else{
		    $x = ' + 1 ';
		}
		$htm .= '<td>'.$res['group_name'].$x.'</td>';
		$htm .= '<td>'.$res['count'].'</td>';
		$htm .= '</tr>';
		$total= $total + (int)($res['count']);
	}

		$htm .= '<tr>';
		$htm .= '<td style = "'.$colorhead.'">Total Count: </td>';
		$htm .= '<td style = "'.$colorhead.'">'.$total.'</td>';
		$htm .= '</tr>';
	
	$htm .= '</tbody>';
	$htm .= '</table>';
	echo $htm;
}

function export_twitterinterjection(){
	error_reporting(0);
	$date = date('m-d-Y h:i:s a', time());
	$filename = "Report-" .$date. ".xls";
	header("Content-Disposition: attachment; filename=\"$filename\"");
	header("Content-Type: application/vnd.ms-excel");
	twitterinterjection('bordered');
}

function get_twitter_reports(){
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data_get = $_POST['data_get'];
	$result = gettwitterreports($limit,$offset,$data_get);
$x=1;
$htm = "";
$htm .= '<table class = "table-bordered">';
$htm .= '<thead>';
$htm .= '<tr>';
$htm .= '<th rowspan="2">SN</th>';
$htm .= '<th rowspan="2">Date/Time</th>';
$htm .= '<th rowspan="2">Username</th>';
$htm .= '<th rowspan="2">Tweets</th>';
$htm .= '<th rowspan="2">Symptoms</th>';
$htm .= '<th colspan="2">GEO</th>';
$htm .= '<th rowspan="2">Address</th>';
$htm .= '</tr>';

$htm .= '<tr>';
$htm .= '<th>Latitude</th>';
$htm .= '<th>Longitude</th>';
$htm .= '</tr>';

$htm .= '</thead>';


foreach ($result as $key => $row) {

$htm .= '<tbody>';
$htm .= '<tr>';
$htm .= '<td>'.$row->sn.'</td>';
$htm .= '<td>'.$row->date.'</td>';
$htm .= '<td>'.$row->username.'</td>';
$htm .= '<td>'.$row->tweets.'</td>';
$htm .= '<td>'.$row->symptoms.'</td>';
$htm .= '<td>'.$row->latitude.'</td>';
$htm .= '<td>'.$row->longitude.'</td>';
$htm .= '<td>'.$row->address.'</td>';
$htm .= '</tbody>';
$x++;
}

$htm .= '</table>';
echo $htm;
}
function get_logs(){

	$result = getlogs();
$x=1;
$htm = "";
$htm .= '<table border="1" class = "table-bordered">';
$htm .= '<thead>';
$htm .= '<tr>';
$htm .= '<th>Name</th>';
$htm .= '<th>Count</th>';
$htm .= '</tr>';
$htm .= '</thead>';


foreach ($result as $key => $row) {

$htm .= '<tbody>';
$htm .= '<tr>';
$htm .= '<td>'.$row->name.'</td>';
$htm .= '<td>'.$row->count.'</td>';
$htm .= '</tbody>';
$x++;
}

$htm .= '</table>';
echo $htm;
}
function get_twitter_reports_count() {
	$per_page = $_POST['limit'];
	$data_get = $_POST['data_get'];
	$limit = '9999999';
	$offset = '0';

	
	$data = gettwitterreports($limit,$offset,$data_get);
	$page_count = ceil($data[0]->count/$per_page);
	echo $page_count;
}

function get_twitter_reports_export($data_get){
	$limit = 0;
	$offset = 0;
	$result = gettwitterreports($limit,$offset,$data_get);
$x=1;
$htm = "";
$htm .= '<table border="1" class = "table-bordered">';
$htm .= '<thead>';
$htm .= '<tr>';
$htm .= '<th rowspan="2">SN</th>';
$htm .= '<th rowspan="2">Date/Time</th>';
$htm .= '<th rowspan="2">Username</th>';
$htm .= '<th rowspan="2">Tweets</th>';
$htm .= '<th rowspan="2">Symptoms</th>';
$htm .= '<th colspan="2">GEO</th>';
$htm .= '<th rowspan="2">Address</th>';
$htm .= '</tr>';
$htm .= '<tr>';
$htm .= '<th>Latitude</th>';
$htm .= '<th>Longitude</th>';
$htm .= '</tr>';
$htm .= '</thead>';


foreach ($result as $key => $row) {

$htm .= '<tbody>';
$htm .= '<tr>';
$htm .= '<td>'.$row->sn.'</td>';
$htm .= '<td>'.$row->date.'</td>';
$htm .= '<td>'.$row->username.'</td>';
$htm .= '<td>'.$row->tweets.'</td>';
$htm .= '<td>'.$row->symptoms.'</td>';
$htm .= '<td>'.$row->latitude.'</td>';
$htm .= '<td>'.$row->longitude.'</td>';
$htm .= '<td>'.$row->address.'</td>';
$htm .= '</tbody>';
$x++;
}

$htm .= '</table>';
echo $htm;
}


function get_manual_reports_count() {
	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	$data = count(getmanualreports($limit,$offset));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function get_manual_reports(){

		$limit = $_POST['limit'];
		$offset = ($_POST['offset']-1)* $limit;
		$result = getmanualreports($limit,$offset);
		$htm = "";
		$counter = 1;
		$htm .= "<table style = 'font-family:arial; font-size:10px;' border='1'>";
		$htm .= "<thead>";
		$htm .= "<tr>";
		$htm .= "<th style = 'background:#2e6da4;color:#fff' rowspan= '2'>NO.</th>";
		$htm .= "<th style = 'background:#2e6da4;color:#fff' rowspan= '2'>S/N</th>";
		$htm .= "<th style = 'background:#2e6da4;color:#fff' rowspan= '2'>DATE</th>";
		$htm .= "<th style = 'background:#2e6da4;color:#fff' rowspan= '2'>NAME</th>";
		$htm .= "<th style = 'background:#2e6da4;color:#fff' rowspan= '2'>EMAIL</th>";
		$htm .= "<th style = 'background:#2e6da4;color:#fff' rowspan= '2'>CONTACT NO</th>";
		$htm .= "<th style = 'background:#2e6da4;color:#fff' rowspan= '2'>FLU SYMPTOMS</th>";
		$htm .= "<th style = 'background:#2e6da4;color:#fff' colspan='2'>GOOGLE MAP</th>";
		$htm .= "<th style = 'background:#2e6da4;color:#fff' colspan='4'>LOCATION</th>";
		$htm .= "</tr>";
		$htm .= "<tr>";
		$htm .= "<th style = 'background:#2e6da4;color:#fff' >LATITUDE</th>";
		$htm .= "<th style = 'background:#2e6da4;color:#fff' >LONGITUDE</th>";
		$htm .= "<th style = 'background:#2e6da4;color:#fff' >STREET NAME</th>";
		$htm .= "<th style = 'background:#2e6da4;color:#fff' >BRGY/DISTRICT</th>";
		$htm .= "<th style = 'background:#2e6da4;color:#fff' >CITY/MUNICIPALITY</th>";
		$htm .= "<th style = 'background:#2e6da4;color:#fff' >CITY</th>";
		$htm .= "</tr>";
		$htm .= "</thead>";
		$htm .= "<tbody>";
	foreach ($result as $key => $row) {
		$htm .= "<tr>";
		$htm .= "<td>". $counter. "</td>";
		$htm .= "<td>SN-000". $row->user_id. "</td>";
		$htm .= "<td>".$row->date_created."</td>";
		$htm .= "<td>". $row->user_name. "</td>";
		$htm .= "<td>". $row->user_email. "</td>";
		$htm .= "<td>". $row->user_contact. "</td>";
		$htm .=  "<td>";
		$user_symptoms = getusersymptoms($row->user_id);
		$u = '';
		foreach ($user_symptoms as $key => $urow) {
			$u .= $urow->flu_symptoms .', ';
		}
		$u = substr($u, 0,-2);
		$htm .=  $u;
		$htm .=  "</td>";
	
		$latlng = getlocation($row->territory_id);

		foreach ($latlng as $key => $lat) {
			$htm .=  "<td>";
			$htm .= $lat->latitude;
			$htm .=  "</td>";
			$htm .=  "<td>";
			$htm .= $lat->longitude;
			$htm .=  "</td>";
			$htm .= "<td></td>";
			$htm .= "<td></td>";
			$htm .=  "<td>";
			$htm .= $lat->province_name;
			$htm .=  "</td>";
		}
		$htm .= "<td></td>";
		$htm .= "</tr>";
		$counter++;
	}
		$htm .= "</tbody>";
		$htm .= "</table>";
		echo $htm;
}

function get_manual_reports_export(){
error_reporting(0);
date_default_timezone_set('Asia/Manila');
$date = date('m-d-Y h:i:s a', time());
$filename = "Report-" .$date. ".xls";
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");
get_manual_reports();

}

function get_twitter_interjection() {
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = gettwitterinterjection($limit,$offset);
	echo json_encode($data);
}

function get_comments() {
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = getcomments($limit,$offset);
	echo json_encode($data);
}

function update_comments(){
	$data = array(
		'id' => $_POST['id'],
		'is_active' => $_POST['status']
		); 

	$tbl_name = '#__article_comments';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}

function get_comments_count() {
	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	$data = count(getcomments($limit,$offset));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}


function get_twitter_interjection_count() {
	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	$data = count(gettwitterinterjection($limit,$offset));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function edit_get_twitter_interjection() {
	$id = $_POST['id'];
	$data = editgettwitterinterjection($id);
	echo json_encode($data);
}

function update_twitter_interjection(){
	$data = array(
		'id' => $_POST['id'],
		'symptom1' => $_POST['symptom1'],
		'symptom2' => $_POST['symptom2'],
		'groupings' => $_POST['groupings'],
		'state' => $_POST['status'],
		); 

	$tbl_name = '#__twitter_interjection';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}

function get_groupings() {
	$data = getgroupings();
	echo json_encode($data);
}

function update_twitter_interjection_status(){
	$data = array(
		'id' => $_POST['id'],
		'state' => $_POST['status']
		); 

	$tbl_name = '#__twitter_interjection';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}

function saved_twitter_interjection(){
	$data = array(
		'symptom1' => $_POST['symptom1'],
		'symptom2' => $_POST['symptom2'],
		'groupings' => $_POST['groupings'],
		'state' => $_POST['status'],
		);
	$tbl_name = '#__twitter_interjection';
	$data = json_decode(json_encode($data), FALSE);
	save_data($data,$tbl_name);
}

function session(){
	echo  $_SESSION['session_id'];
}

function get_user() {
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = getuser($limit,$offset);
	echo json_encode($data);
}

function get_user_count() {
	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	$data = count(getuser($limit,$offset));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function edit_user() {
	$id = $_POST['id'];
	$data = edituser($id);
	echo json_encode($data);
}

function get_user_group() {
	$data = getusergroup();
	echo json_encode($data);
}

function update_user(){

if ($_POST['password'] != '') {
	$password = sha1($_POST['password']);
}

	$data = array(
		'id' => $_POST['id'],
		'name' => $_POST['name'],
		'username' => $_POST['username'],
		'email' => $_POST['email'],
		'password' => $password,
		'state' => $_POST['status']
		); 

	$tbl_name = '#__users';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');

	$data2 = array(
		'user_id' => $_POST['id'],
		'group_id' => $_POST['usergroup'],
		); 

	$tbl_name = '#__user_usergroup_map';
	$data = json_decode(json_encode($data2), FALSE);
	update_data($data,$tbl_name,'user_id');
}

function saved_user(){
	$data = array(
		'name' => $_POST['name'],
		'username' => $_POST['username'],
		'email' => $_POST['email'],
		'password' => sha1($_POST['password']),
		'state' => $_POST['status']
		); 
	$tbl_name = '#__users';
	$data = json_decode(json_encode($data), FALSE);
	$id = save_data($data,$tbl_name);

	$data2 = array(
		'user_id' => $id,
		'group_id' => $_POST['usergroup'],
		); 

	$tbl_name = '#__user_usergroup_map';
	$data = json_decode(json_encode($data2), FALSE);
	save_data($data,$tbl_name);
}

function update_user_status(){
	$data = array(
		'id' => $_POST['id'],
		'state' => $_POST['status']
		); 

	$tbl_name = '#__users';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}

function checkemail(){
	echo json_encode(count(check_email($_POST['email'])));
}

function update_reset_password(){
$result = check_token($_POST['access_token']);

if (count($result) == 0 ) {
	echo "error";
}else{

	$data = array(
		'id' => $result[0]['id'],
		'password' => sha1($_POST['password']),
		); 



	$tbl_name = '#__users';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}
}

function get_article_featured() {
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = getarticlefeatured($limit,$offset);
	echo json_encode($data);
}

function get_article_featured_count() {
	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	$data = count(getarticlefeatured($limit,$offset));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function edit_article_featured() {
	$id = $_POST['id'];
	$data = editarticlefeatured($id);
	echo json_encode($data);
}

function update_article_featured(){
	$data = array(
		'id' => $_POST['id'],
		'article_id' => $_POST['article_id'],
		'state' => $_POST['state'],
		'image_path' => $_POST['image_path'],
		'date_created' => date('Y-m-d h:i:s')
		); 

	$tbl_name = '#__featured_article';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}

function saved_article_featured(){
	$data = array(
		'article_id' => $_POST['article_id'],
		'state' => $_POST['state'],
		'image_path' => $_POST['image_path'],
		'date_created' => date('Y-m-d h:i:s'),
		'ordering' => $_POST['ordering']
		); 

	$tbl_name = '#__featured_article';
	$data = json_decode(json_encode($data), FALSE);
	save_data($data,$tbl_name);
}

function update_article_featured_status(){
	$data = array(
		'id' => $_POST['id'],
		'state' => $_POST['status']
		); 

	$tbl_name = '#__featured_article';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}





function get_article_more() {
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = getarticlemore($limit,$offset);
	echo json_encode($data);
}

function get_article_more_count() {
	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	$data = count(getarticlemore($limit,$offset));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function edit_article_more() {
	$id = $_POST['id'];
	$data = editarticlemore($id);
	echo json_encode($data);
}

function update_article_more(){
	$data = array(
		'id' => $_POST['id'],
		'article_id' => $_POST['article_id'],
		'state' => $_POST['state'],
		'image_path' => $_POST['image_path'],
		); 

	$tbl_name = '#__more_article';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}

function saved_article_more(){
	$data = array(
		'article_id' => $_POST['article_id'],
		'state' => $_POST['state'],
		'image_path' => $_POST['image_path'],
		); 

	$tbl_name = '#__more_article';
	$data = json_decode(json_encode($data), FALSE);
	save_data($data,$tbl_name);
}

function update_article_more_status(){
	$data = array(
		'id' => $_POST['id'],
		'state' => $_POST['status']
		); 

	$tbl_name = '#__more_article';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}


function update_article_ordering(){
	$data = array(
		'id' => $_POST['id'],
		'ordering' => $_POST['ordering'],
		'date_created'=>date('Y-m-d h:i:s')
		); 

	$tbl_name = '#__featured_article';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}


function get_max_order() {
	$data = getmaxorder();

	if (count($data)== 0) {
		echo '0';
	}else{
		echo $data[0]->ordering;
	}
	
}



/* New */

function getlist_global() {
	$table = $_POST['table'];
	$order_by = $_POST['order_by'];

	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = getlist_global_model($limit,$offset, $table, $order_by);
	echo json_encode($data);
}


function get_article_list() {
	$search = $_POST['search'];
	// $cat_type = $_POST['cat_type'];

	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = getlist_article_model($limit,$offset, $search);
	echo json_encode($data);
}

function get_article_count() {
	$search = $_POST['search'];;
	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	$data = count(getlist_article_model($limit,$offset, $search));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function get_banner_count() {
	$search = $_POST['search'];;
	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	$data = count(getlist_banner_model($limit,$offset, $search));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function edit_global() {
	$table = $_POST['table'];
	$field = $_POST['field'];

	$id = $_POST['id'];
	$data = getedit_global($id,$table,$field);
	echo json_encode($data);
}



function pag2flu_array() {
	$tbl_name = '#__pag2flu';
	$field = 'id';
	$action = $_POST['action'];
	$id = "";
	if($action=="update") {
		$id = $_POST['id'];
	}


	$data = array(
		'id' => $id,
		'video_desc' => $_POST['mytext'],
		'video_title' => $_POST['mytitle'],
		'campaign_title' => $_POST['mytitlecamp'],
		'campaign_desc_right' => $_POST['mytextcampr'],
		'campaign_desc_left' => $_POST['mytextcampl'],
		'video' => str_replace('../', '', $_POST['image1']),
		'thumbnail' => str_replace('../', '', $_POST['image3']),
		'symptoms_title' => $_POST['mytitlesymp'],
		'symptoms_desc' => $_POST['mytextsymp'],
		'banner' => str_replace('../', '', $_POST['image2'])
	);

	$data = json_decode(json_encode($data), FALSE);
	checkAction($action, $data, $tbl_name, $field);
}


function pag2flu_symptoms() {
	$tbl_name = '#__pag2flu_symptoms';
	$field = 'id';
	$action = $_POST['action'];
	$id = "";

	if($action=="update") {
		$id = $_POST['id'];
	} 

	$data = array(
		'id' => $id,
		'name' => $_POST['name'],
		'alias' => $_POST['alias'],
		'icon_inactive' => str_replace('../', '', $_POST['inactive']),
		'icon_active' => str_replace('../', '', $_POST['active'])
	);

	$data = json_decode(json_encode($data), FALSE);
	checkAction($action, $data, $tbl_name, $field);
}

function about_flu() {
	$tbl_name = '#__maps_about';
	$field = 'id';
	$action = $_POST['action'];
	$id = "";
	$state = "";

	if($action=="update") {
		$id = $_POST['id'];
	} else {
		$state = 0;
	}

	$data = array(
		'id' => $id,
		'title' => $_POST['title'],
		'content' => $_POST['content']
	);

	$data = json_decode(json_encode($data), FALSE);
	checkAction($action, $data, $tbl_name, $field);
}

function pag2flu_articles() {
	$tbl_name = '#__flunew_articles';
	$field = 'id';
	$action = $_POST['action'];
	$id = "";
	$state = "";
	if($action=="update") {
		$id = $_POST['id'];
	} else {
		$state = 0;
	}

	$data = array(
		'id' => $id,
		'intro_text' => $_POST['mytext'],
		'article_title' => $_POST['mytitle'],
		'cat_type' => $_POST['cat_type'],
		'state' => $state,
		'tags' => $_POST['mytags'],
		'date_published' => $_POST['date_published'],
		'image' => str_replace('../', '', $_POST['image2'])
	);


	$data = json_decode(json_encode($data), FALSE);
	checkAction($action, $data, $tbl_name, $field);
}


function checkAction($action, $data, $tbl_name, $field) {
	if($action=="save"){
		save_data($data, $tbl_name);
	} else {
		update_data($data,$tbl_name,$field);
	}
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

function inactive_global_update(){
	$table = $_POST['table'];
	$field = $_POST['order_by'];

	$id = $_POST['id'];
	$type = $_POST['type'];
	inactive_global($id, $type, $field, $table);
}
/* End of new */
function update_combination(){

	$verify = count(check_combination_edit($_POST['flu_two'],$_POST['flu_one'],$_POST['id']));

	if($verify <= 0){
	$data = array(
		'id' => $_POST['id'],
		'name' => $_POST['title'],
		'image' => str_replace('../', '', $_POST['thumbnailimage']),
		'flu_one' => $_POST['flu_one'],
		'flu_two' => $_POST['flu_two']
		); 

	$tbl_name = '#__pag2flu_combination';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
			$msg = array('status' => 'success');
	} else {
			$msg = array('status' => 'Combination Already Exist');
	}
	echo json_encode($msg);
}


	 

function save_combination(){

	$verify = count(check_combination($_POST['flu_two'],$_POST['flu_one']));

	if($verify <= 0){
			$data = array(
				'name' => $_POST['title'],
				'image' => str_replace('../', '', $_POST['thumbnailimage']),
				'flu_one' => $_POST['flu_one'],
				'flu_two' => $_POST['flu_two']
				); 

			$tbl_name = '#__pag2flu_combination';
			$data = json_decode(json_encode($data), FALSE);
			save_data($data,$tbl_name);
			$msg = array('status' => 'success');
	} else {
			$msg = array('status' => 'Combination Already Exist');
	}
	echo json_encode($msg);
}

function update_default() {
	$tbl_name = '#__maps_default';
	$field = 'id';
	$action = $_POST['action'];
	$id = "";
	$state = "";

	if($action=="update") {
		$id = $_POST['id'];
	} else {
		$state = 0;
	}

	$data = array(
		'id' => $id,
		'name' => $_POST['location'],
		'default_long' => $_POST['longitude'],
		'default_lat' => $_POST['latitude']
	);

	$data = json_decode(json_encode($data), FALSE);
	checkAction($action, $data, $tbl_name, $field);
}


function saved_default(){
	$data = array(
		'name' => $_POST['location'],
		'default_long' => $_POST['longitude'],
		'default_lat' => $_POST['latitude']
		);  
	$tbl_name = '#__maps_default';
	$data = json_decode(json_encode($data), FALSE);
	save_data($data,$tbl_name);
}


function update_product(){

	$data = array(
		'id' => $_POST['id'],
		'formulation' => $_POST['formulation'],
		'usage' => $_POST['usage'],
		'dosage' => $_POST['overdosage']
		); 
	$tbl_name = '#__productpage';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
	$msg = array('status' => 'success');
	echo json_encode($msg);
}
?>