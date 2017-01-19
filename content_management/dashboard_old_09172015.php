<?php  require_once dirname(__FILE__) . '/model.php'; 
session_start();
$_GET['function']();

function get_articles() {
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = article_list($limit,$offset);
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

function get_articles_count() {
	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	$data = count(article_list($limit,$offset));
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

	$data = array(
		'title' => $_POST['title'],
		'introtext' => $_POST['content'],
		'image_path' => str_replace('../', '', $_POST['thumbnailimage']),
		'alias' => strtolower(str_replace(' ', '-', $_POST['title'])),
		'state' => $_POST['state'],
		'catid' => $_POST['catid'],
		'created_by' => $_SESSION['session_id'],
		'created' => date('Y-m-d h:i:s'),
		'publish_up' => date('Y-m-d h:i:s', strtotime($_POST['start'])),
		'publish_down' => $down,
		'modified' => date('Y-m-d h:i:s')
		);
	$tbl_name = '#__content';
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

	$data = array(
		'id' => $_POST['id'],
		'title' => $_POST['title'],
		'image_path' => str_replace('../', '', $_POST['thumbnailimage']),
		'introtext' => $_POST['content'],
		'alias' => strtolower(str_replace(' ', '-', $_POST['title'])),
		'state' => $_POST['state'],
		'catid' => $_POST['catid'],
		'publish_up' => date('Y-m-d h:i:s', strtotime($_POST['start'])),
		'publish_down' => $down,
		'modified' => date('Y-m-d h:i:s')
		); 


	$tbl_name = '#__content';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'id');
}

function update_ads(){
	$data = array(
		'id' => $_POST['id'],
		'title' => $_POST['title'],
		'content' => $_POST['content'],
		// 'alias' => strtolower(str_replace(' ', '-', $_POST['title'])),
		// 'state' => '1'
		); 
	$tbl_name = '#__modules';
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

function gallery(){
	$files = glob("../images/bioflu/*.*");
		$htm ='';
		$htm .= '<div id="myCarousel" class="carousel slide" data-ride="carousel">';

		$htm .= '<ol class="carousel-indicators">';
		$htm .= ' <li data-target="#myCarousel" data-slide-to="0" class="active"></li>';
		$htm .= ' <li data-target="#myCarousel" data-slide-to="1" ></li>';
		$htm .= ' <li data-target="#myCarousel" data-slide-to="2" ></li>';
		$htm .= '</ol>';

		$htm .= '<div class="carousel-inner" role="listbox">';

			$htm .= '<div class="item">';
			$htm .= ' <img src="../images/bioflu/1.png" width="460" height="345" alt="">';
			$htm .= '</div>';

			$htm .= '<div class="item">';
			$htm .= ' <img src="../images/bioflu/4.png" width="460" height="345" alt="">';
			$htm .= '</div>';

			$htm .= '<div class="item">';
			$htm .= ' <img src="../images/bioflu/3.png" width="460" height="345" alt="">';
			$htm .= '</div>';

		$htm .= '</div>';

		$htm .= '<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">';
		$htm .= ' <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>';
		$htm .= ' <span class="sr-only">Previous</span>';
		$htm .= '</a>';
		$htm .= ' <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">';
		$htm .= '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>';
		$htm .= '<span class="sr-only">Next</span>';
		$htm .= '</a>';
		$htm .= '</div>';

	echo $htm;
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
		'content' => $_POST['content'],
		'asset_id' =>'18',
		'ordering' =>'1',
		'module' => 'mod_custom',
		'published' => '1',
		);
	$tbl_name = '#__modules';
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
	$password = $_POST['password'];
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

function get_hospital(){
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	$data = gethospital($limit,$offset);
	echo json_encode($data);
}

function get_hospital_count() {
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
		'video' => str_replace('../', '', $_POST['video']),
		'title' => $_POST['title'],
		'description' => $_POST['description'],
		'url' => $_POST['url']
		);
	$tbl_name = '#__video_gallery';
	$data = json_decode(json_encode($data), FALSE);
	save_data($data,$tbl_name);
}

function edit_videogallery() {
	$id = $_POST['id'];
	$data = get_video_gallery($id);
	echo json_encode($data);
}

function update_videogallery(){
	$data = array(
		'id' => $_POST['id'],
		'video' => str_replace('../', '', $_POST['video']),
		'title' => $_POST['title'],
		'description' => $_POST['description'],
		'url' => $_POST['url']
		); 

	$tbl_name = '#__video_gallery';
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

function update_hospital(){
	$data = array(
		'hospital_id' => $_POST['id'],
		'hospital_name' => $_POST['hospital'],
		'address' => $_POST['address'],
		'description' => $_POST['description'],
		'is_active' => $_POST['status'],
		'latitude' => $_POST['latitude'],
		'longitude' => $_POST['longitude']
		); 

	$tbl_name = '#__maps_hospital';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'hospital_id');
}

function update_hospital_status(){
	$data = array(
		'hospital_id' => $_POST['id'],
		'is_active' => $_POST['status']
		); 

	$tbl_name = '#__maps_hospital';
	$data = json_decode(json_encode($data), FALSE);
	update_data($data,$tbl_name,'hospital_id');
}


function saved_hospital(){
	$data = array(
		'hospital_name' => $_POST['hospital'],
		'address' => $_POST['address'],
		'description' => $_POST['description'],
		'is_active' => $_POST['status'],
		'latitude' => $_POST['latitude'],
		'longitude' => $_POST['longitude']
		); 
	$tbl_name = '#__maps_hospital';
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
		'promotion_id' => $_POST['edit_promotion_id'],
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
		'promotion_id' => $_POST['add_promotion_id'],
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

function export_report(){
date_default_timezone_set('Asia/Manila');
$date = date('m-d-Y h:i:s a', time());
$filename = "Report-" .$date. ".xls";
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");
		$result = exportreport();
		$htm = "";
		$counter = 1;
		$htm .= "<table style = 'font-family:arial; font-size:10px;' border='1'>";
		$htm .= "<thead>";
		$htm .= "<tr>";
		$htm .= "<th style = 'background:#ccc' rowspan= '2'>NO.</th>";
		$htm .= "<th style = 'background:#ccc' rowspan= '2'>S/N</th>";
		$htm .= "<th style = 'background:#ccc' rowspan= '2'>DATE</th>";
		$htm .= "<th style = 'background:#ccc' rowspan= '2'>TIME</th>";
		$htm .= "<th style = 'background:#ccc' rowspan= '2'>Twitter Handle</th>";
		$htm .= "<th style = 'background:#ccc' rowspan= '2'>Message Tweet</th>";
		$htm .= "<th style = 'background:#ccc' rowspan= '2'>NAME</th>";
		$htm .= "<th style = 'background:#ccc' rowspan= '2'>EMAIL</th>";
		$htm .= "<th style = 'background:#ccc' rowspan= '2'>CONTACT NO</th>";
		$htm .= "<th style = 'background:#ccc' rowspan= '2'>FLU SYMPTOMS</th>";
		$htm .= "<th style = 'background:#ccc' colspan='2'>GOOGLE MAP</th>";
		$htm .= "<th style = 'background:#ccc' colspan='4'>LOCATION</th>";
		$htm .= "</tr>";
		$htm .= "<tr>";
		$htm .= "<th style = 'background:#ccc' >LATITUDE</th>";
		$htm .= "<th style = 'background:#ccc' >LONGITUDE</th>";
		$htm .= "<th style = 'background:#ccc' >STREET NAME</th>";
		$htm .= "<th style = 'background:#ccc' >BRGY/DISTRICT</th>";
		$htm .= "<th style = 'background:#ccc' >CITY/MUNICIPALITY</th>";
		$htm .= "<th style = 'background:#ccc' >CITY</th>";
		$htm .= "</tr>";
		$htm .= "</thead>";
		$htm .= "<tbody>";
	foreach ($result as $key => $row) {
		$htm .= "<tr>";
		$htm .= "<td>". $counter. "</td>";
		$htm .= "<td>SN-000". $row->user_id. "</td>";
		$htm .= "<td></td>";
		$htm .= "<td></td>";
		$htm .= "<td></td>";
		$htm .= "<td></td>";
		$htm .= "<td>". $row->user_name. "</td>";
		$htm .= "<td>". $row->user_email. "</td>";
		$htm .= "<td>". $row->user_contact. "</td>";
		$htm .=  "<td>";
		$user_symptoms = getusersymptoms($row->user_id);
		foreach ($user_symptoms as $key => $urow) {
			$htm .= $urow->flu_symptoms;
			$htm .= ', ';
		}
		$htm .=  "</td>";
		$htm .= "<td></td>";
		$htm .= "<td></td>";
		$htm .= "<td></td>";
		$htm .= "<td></td>";
		$htm .=  "<td>";
		$location = getlocation($row->territory_id);
		foreach ($location as $key => $lrow) {
			$htm .= $lrow->territory_name .', ';
			
		}
		$htm .=  "</td>";
		$htm .=  "<td>";
		$location = getlocation($row->territory_id);
		foreach ($location as $key => $lrow) {
			$htm .= $lrow->province_name;
		}
		$htm .=  "</td>";
		$htm .= "</tr>";
		$counter++;
	}
		$htm .= "</tbody>";
		$htm .= "</table>";
		echo $htm;
}

?>