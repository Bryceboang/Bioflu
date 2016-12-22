<?php  
	
	require_once dirname(__FILE__) . '/model.php'; 
	
	$_GET['function']();
	
	function tags()
	{
		
		if (!empty($_POST['longitude'])) { 
			$long = $_POST['longitude'];
		} else { 
			$long = get_longitude(); }
		if (!empty($_POST['latitude'])) { 
			$lat = $_POST['latitude'];
		} else { 
			$lat = get_latitude();}
			
		$tags = array();
		$data = getTags($long,$lat);
		// foreach ($data as $key => $value) {
		// 	$arrs =array("user_name" => $value['user_name'],"geocode"=>unserialize($value['territory_geo']));
		// 	$tags[$key] = $arrs;
		// }
		foreach ($data as $key => $value) {
			$arrs =array("user_name" => $value['user_name'],"latitude"=>$value['latitude'],"longitude"=>$value['longitude']);
			$tags[$key] = $arrs;
		}


		echo json_encode(array("dbTags"=> $tags));

	}

	function tagstest()
	{
		
		
		// if (!empty($_POST['longitude'])) {
		// 	$long = $_POST['longitude'];
		// } else {
		// 	$long = 14.6090537;
		// }
		// if (!empty($lat = $_POST['latitude'])) {
		// 	$lat = $_POST['latitude'];
		// } else {
		// 	$lat = 121.0222565;
		// }
		if (!empty($_POST['longitude'])) { $long = $_POST['longitude'];
		} else { $long = get_longitude(); }
		if (!empty($_POST['latitude'])) { $lat = $_POST['latitude'];
		} else { $lat = get_latitude();}
		$tags = array();
		$data = getTagsTest($long,$lat);
		// foreach ($data as $key => $value) {
		// 	$arrs =array("user_name" => $value['user_name'],"geocode"=>unserialize($value['territory_geo']));
		// 	$tags[$key] = $arrs;
		// }
		foreach ($data as $key => $value) {
			$arrs =array("user_name" => $value['user_name'],"latitude"=>$value['latitude'],"longitude"=>$value['longitude']);
			$tags[$key] = $arrs;
		}


		echo json_encode(array("dbTags"=> $tags));

	}


function loadDrugstores()
	{


		if (!empty($_POST['longitude']) || !empty($_POST['latitude'])){ 
			$long = $_POST['longitude'];
			$lat = $_POST['latitude'];
			$data = getDrugstores($long,$lat);
		} else { 
			$long = get_longitude();
			$lat = get_latitude();
			$data = getDrugstoresDefault();
		}

		$store_data = array();
		// $data = getDrugstores($long,$lat);
		// print_r($data);
		foreach ($data as $key => $value) {
			$arrs =array("store_id" => $value['drugstore_id'],"store_name" => $value['name'],"latitude"=>$value['latitude'],"longitude"=>$value['longitude'],"store_address"=>$value['complete_address'],"drugstore_name"=>$value['drugstore_name'],'marker'=> $value['drugstore_marker'],'pro_name'=>$value['promotion_name'], 'pro_desc'=>$value['promotion_description'], 'pro_id'=>$value['promotion_id']);
			$store_data[$key] = $arrs;
		
		}
		// print_r($store_data);
		echo json_encode(array("stores"=>$store_data));
}
	// function loadDrugstores()
	// {

	// 	if (!empty($_POST['longitude'])) { $long = $_POST['longitude'];
	// 	} else { $long = get_longitude(); }
	// 	if (!empty($_POST['latitude'])) { $lat = $_POST['latitude'];
	// 	} else { $lat = get_latitude();}
	// 	// $long = 121.0222565;
	// 	// $lat = 14.6090537;
	// 	$store_data = array();
	// 	$data = getDrugstores($long,$lat);
	// 	// print_r($data);
	// 	foreach ($data as $key => $value) {
	// 		$arrs =array("store_id" => $value['drugstore_id'],"store_name" => $value['name'],"latitude"=>$value['latitude'],"longitude"=>$value['longitude'],"store_address"=>$value['complete_address'],"drugstore_name"=>$value['drugstore_name'],'marker'=> $value['drugstore_marker'],'pro_name'=>$value['promotion_name'], 'pro_desc'=>$value['promotion_description'], 'pro_id'=>$value['promotion_id']);
	// 		$store_data[$key] = $arrs;
		
	// 	}
	// 	// print_r($store_data);
	// 	echo json_encode(array("stores"=>$store_data));
	// }


	function loadPromos()
	{
		$promo_data = array();
		$data = getPromos();
		print_r($data);
	}

	function passSymptoms()
	{
		// print_r($_POST);
		// $post = extract($_POST);
		$data = array($_POST);
		$data = json_decode(json_encode($data[0]), FALSE);
		// print_r($user_symptoms);
		$insert = saveSymptoms($data);
		// if($insert)
		// {
		// 	echo json_encode(array('status'=>'success', 'msg' => 'Symptom(s)Saved!'));
		// }
		// echo json_encode(array('status'=>'fail', 'msg' => 'Symptom(s) NOT Saved!'));
	}

	function loadProvince()
	{
		$data = getProvince();
		echo json_encode(array('provinces' => $data));
	}

	function loadTerritory()
	{
		$province_id = $_POST['province_id'];
		$data =getTerritory($province_id);
		echo json_encode(array('territory' => $data));
	}

	function loadHospitals()
	{
		$hospital_data = array();
		$data = getHospital();

		foreach ($data as $key => $value) {
			$arrs =array("id" => $value['hospital_id'],"name" => $value['hospital_name'],"latlng"=>unserialize($value['latlng']),"address"=>$value['address'],"desc"=>$value['description'],'marker'=> $value['marker_path']);
			$hospital_data[$key] = $arrs;
		
		}

		echo json_encode(array("hospital"=>$hospital_data));
	}

	function generateExcelData()
	{
		// print_r(extract($_POST['dbData']));
		jimport('phpexcel.library.PHPExcel');
		$userdata = array();
		$dbCount = 0;
		$dbMarkers = json_decode($_POST['dbData']);
		$dbTweets = json_decode($_POST['dbTweets']);
		$path = JPATH_BASE;
		$return_path = JURI::root(false,'/bioflu/tmp');

		foreach ($dbMarkers as $key => $value) {
			$fever = ($value->fever == 1) ? "YES": "NO";
			$cough = ($value->cough == 1) ? "YES": "NO";
			$colds = ($value->colds == 1) ? "YES": "NO";
			$body_ache = ($value->body_ache == 1) ? "YES": "NO";
			$numSymptoms = $value->fever + $value->cough + $value->colds + $value->body_ache;

			$userdata[$key] = array('username'=>$value->user_name,'fever'=>$fever,'cough'=>$cough,'colds'=>$colds,'body_ache'=>$body_ache,'flunum'=>$numSymptoms);
			$dbCount ++;
		}
		
		foreach ($dbTweets as $key => $value) {
			$fever = (strpos(strtolower($value->text),'#fever')!== false) ? "YES": "NO";
			$cough = (strpos(strtolower($value->text),'#cough')!== false) ? "YES": "NO";
			$colds = (strpos(strtolower($value->text),'#colds')!== false) ? "YES": "NO";
			$body_ache = (strpos(strtolower($value->text),'#bodyache') !== false) ? "YES": "NO";
			$numSymptoms = count($value->hastags);

			$userdata[$dbCount] = array('username'=>$value->name,'fever'=>$fever,'cough'=>$cough,'colds'=>$colds,'body_ache'=>$body_ache,'flunum'=>$numSymptoms);
			$dbCount = $dbCount + 1;
		}

		$usernameCol = 'A';
		$coughCol = 'B';
		$coldsCol = 'C';
		$feverCol = 'D';
		$bodyCol = 'E';
		$numSymps = 'F';
		$startRow = 7;

		$style = array('font' => array('bold' => false, 'size'=> 10, 'name'=> 'Calibri', 'color' => array('rgb' => '000000')),'alignment'=> array('wrap'=>true,'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical'=> PHPExcel_Style_Alignment::HORIZONTAL_LEFT));

		$labels = array('A2'=>'Bioflu Report','A3'=>"As of:", 'B3'=> date("Y/m/d"), 'A6' =>'People', 'B5'=>'Symptoms', 'B6'=>'Coughs', 'C6'=>'Colds','D6'=>'Fever','E6'=>'Body Ache', 'F6'=>'Number of Symptoms');

		ob_start();
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->mergeCells('B5:E5');

		foreach ($labels as $key => $value) {
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key, $value);
		}

		foreach ($userdata as $key => $value) {
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($usernameCol.$startRow, $value['username']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($coughCol.$startRow, $value['cough']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($coldsCol.$startRow, $value['colds']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($feverCol.$startRow, $value['fever']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($bodyCol.$startRow, $value['body_ache']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($numSymps.$startRow, $value['flunum']);
			$objPHPExcel->getActiveSheet()->getStyle($usernameCol.$startRow)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle($coughCol.$startRow)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle($coldsCol.$startRow)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle($feverCol.$startRow)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle($bodyCol.$startRow)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->getStyle($numSymps.$startRow)->applyFromArray($style);
			$startRow++;
		}


		$objPHPExcel->getActiveSheet()->setTitle('Bioflu Symptoms');
		$objPHPExcel->getProperties()->setCreator("Admin")
                                    ->setLastModifiedBy("Admin")
                                    ->setTitle("Bioflu Symptoms Report")
                                    ->setSubject("Bioflu")
                                    ->setDescription("Bioflu Report")
                                    ->setKeywords("office 2007 openxml php")
                                    ->setCategory("Bioflu");
    	ob_end_clean();
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($path."/tmp/Bioflu_Report.xlsx");
		echo $return_path."Bioflu_Report.xlsx";
	}

	function getTagTerritory()
	{
		$ter_data = array();
		$ter_count = array();
		$new_ter_array = array();
		$final_data;
		$data = getAreaTags();

		// print_r($data);
		foreach ($data as $key => $value) {
			$territory_id = $value['territory_id'];

			$arrs =array("area_user" => $value['user_name'],"flu_id" => $value['flu_id'],"territory_id"=>$value['territory_input'],"territory_id"=>$value['territory_input'],'territory_latlng'=>unserialize($value['territory_geo']));
			$ter_data[$key] = array($value['territory_id'] =>$arrs);
			$new_ter_array[$value['territory_id']] = array();

			// $ter_data[$value['territory_input']] = array_push($arrs);
		}
		// print_r($new_ter_array);
		foreach ($ter_data as $key => $value) {
			foreach ($value as $a => $b) {
				# code...
			
		// 	$a = array_merge($value,$new_ter_array);
		// // 	$a = array_merge($new_ter_array,$ter_data);
				if(array_key_exists($a, $new_ter_array) == true)
				{
					array_push($new_ter_array[$a],$b);
				}
			}
		}

		
		// print_r($new_ter_array);
		// 
		// print_r($ter_data);
		// print_r($ter_data);
		// foreach ($data as $key => $value) {
		// 	$arrs =array("area_user" => $value['user_name'],"flu_id" => $value['flu_id'],"territory_id"=>$value['territory_input'],"territory_id"=>$value['territory_input'],'territory_latlng'=>unserialize($value['territory_geo']));
		// // 	$hospital_data[$key] = $arrs;
		// 	$ter_data[$key] = $arrs;
		// }
		// print_r($new_ter_array);
		echo json_encode(array("tag_Area"=>$new_ter_array));
	}

	function getgeocode()
	{
		$address='Cagayan De Oro City bicol albay';
		// echo serialize() https://maps.googleapis.com/maps/api/geocode/xml?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=API_KEY
		$url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&key=AIzaSyANldOrkcTeu_Oz0E_RTB4erZoKB-frZxE';

		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		//curl_setopt($ch, CURLOPT_POST, 5);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 7);
		//execute post
		$result = curl_exec($ch);
		//close connection
		curl_close($ch);

		print_r($result);

	}

	// save function v2
	function saveSymptom()
	{
		print_r($_POST);
	}

	function thisTwitterReport()
	{
		// $data = getTwitterReport();
		// print_r($tweet_data);
		print_r($_POST);
	}

	function markerFacility()
	{
		$facility_data = array();
		$data  =  getfacility();

		foreach ($data as $key => $value) {
			$arrs =  array("id" => $value['id'], "facility_name"=> $value['facility_name'], "latitude" => $value['latitude'], "longitude"=>$value['longitude'], "city_name"=>$value['city_name'],'marker'=> $value['marker_path']);
			$facility_data[$key]= $arrs;
		}

		echo json_encode(array("facility"=>$facility_data));
	}

	function thisfacility()
	{
		$data = getfacility2();
		// print_r($data);
		// exit();
		foreach ($data as $key => $value) {
			$id = $value['id'];
			$facility_name = $value['facility_name'];
			$street_name = $value['street_name'];
			$city_name = $value['city_name'];
			$barangay_name = $value['barangay_name'];
			$latitude = $value['latitude'];
			$address = $facility_name." ".$barangay_name." ".$city_name;
			// if($latitude == "" )
			// {
				// $address = $value['barangay_name'];
				getLatLng($id,$address);	
			// }
			// echo $id." ".$facility_name." ".$street_name."<br>";	
		}
		// print_r($data);
	}

	function facilityCounter()
	{
		$totalMarkers = countFacility();
		echo $totalMarkers;
		// $limit = 300;
		// $offset = 0;
		// for ($i=0; $i <=$totalMarkers; $i++) { 
		// 	$offset = ($limit*$i);
		// 	// echo $offset."<br>";
		// }

	}

	function markerFacilityOffset()
	{
		
		// print_r($_POST);
		$offset = $_POST['offset'];
		if (!empty($_POST['longitude'])) { $long = $_POST['longitude'];
		} else { $long = get_longitude(); }
		if (!empty($_POST['latitude'])) { $lat = $_POST['latitude'];
		} else { $lat = get_latitude();}
		$facility_data = array();
		$data  =  getfacilityOffset($offset,$long,$lat);
		// print_r($data);
		foreach ($data as $key => $value) {
			$index = $value['id'];
			$arrs =  array("id" => $value['id'], "facility_name"=> $value['facility_name'], "latitude" => $value['latitude'], "longitude"=>$value['longitude'], "city_name"=>$value['city_name'],'marker'=> $value['marker_path']);
			$facility_data[$index]= $arrs;
		}

		echo json_encode(array("facility"=>$facility_data));
	}

	function addFluCount()
	{
		$name = $_POST['flu_name'];
		addThisCount($name);
	}

	// function ptb()
	// {
	// 	$data = getptb();
	// 	// print_r($data);
	// 	foreach ($data as $key => $value) {
	// 		$barangay_id = $value['barangay_id'];
	// 		$latitude = $value['latitude'];
	// 		if($latitude == "")
	// 		{
	// 			$address = $value['barangay_name'];
	// 		getLatLng($barangay_id,$address);	
	// 		}
			
	// 	}
	// }

	// // latlng generator
	// function drugStores()
	// {
	// 	$data = drugs();

	// 	foreach ($data as $key => $value) {
	// 		// echo $value['complete_address'];
		
	// 		$id = $value['id'];
	// 		$add = $value['complete_address'];
	// 		$latitude = $value['latitude'];
	// 		$longitude = $value['longitude'];
	// 		if($add != null || $add != '' || $latitude != null ||$latitude != '' || $longitude != null || $longitude != '')
	// 		{
	// 			getLatLng($id,$add);
	// 		}
			
	// 	}
	// }

	function getLatLng($id,$address)
	{

		// $address = 'Barangka Marikina City'; // Google HQ
		// api key 2 = AIzaSyCXnwzEYpCfYIUjNt1q9OilUj97UWoXyh8 
		// api key 3 = AIzaSyALKd61ruul0c1JvR2c_luNefoFdlax5VI 

		//api key 3 = AIzaSyAPjbz3xkeZ4kZNQa_-VNv6IfYS_btoCCI
		//
		$prepAddr = str_replace(' ','+',$address);
		$geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?key=AIzaSyAkHoGjFtwv6d4DIRSP_Z3fSDMTMxEXoZc&address='.$prepAddr.'&sensor=false&components=country:PH');
		$output= json_decode($geocode);
		// if($output)
		// echo $address.'<br>';
		// echo 'https://maps.google.com/maps/api/geocode/json?key=AIzaSyCXnwzEYpCfYIUjNt1q9OilUj97UWoXyh8&address='.$prepAddr.'&sensor=false&components=country:PH';
		// print_r($output);
		if($output->status == 'OK')
		{
			$latitude = $output->results[0]->geometry->location->lat;
			$longitude = $output->results[0]->geometry->location->lng;

			// if($latitude != null || $latitude != '' || $longitude != null || $longitude != '')
			// {
				updateLatlng($id,$latitude,$longitude);
			// }
		}
		else if($output->status == 'ZERO_RESULTS')
		{
			$latitude = "NULL";
			$longitude = "NULL";
			updateLatlng($id, $latitude,$longitude);

		}

		
	}	

		
	// 	//       echo 'Latitude : '. $latitude;
	// 	//       echo "<br>";
	// 	//       echo 'Longitude : '. $longitude;
	// 	//       echo "<br>";
	// 	//echo 'Geocode : '; print_r($output);
	// }
	
	function updateLatlng($id, $latitude,$longitude)
	{
		// Initialiase variables.
		// echo "id:".$id;
		// echo "lat:".$latitude;
		// echo "long".$longitude;
		

		// $db    = JFactory::getDbo();
		// $query = $db->getQuery(true);
		// // Create the base update statement.
		// $query->update($db->quoteName('#__maps_barangay'))
		// 	->set($db->quoteName('latitude') . ' = ' . $db->quote($latitude))
		// 	->set($db->quoteName('longitude') . ' = ' . $db->quote($longitude))
		// 	->where($db->quoteName('barangay_id') . ' = ' . $db->quote($id));
		// // Set the query and execute the update.
		// $db->setQuery($query);
		// try
		// {
		// 	$a = $db->execute();
		// 	if($a)
		// 	{
		// 		echo"insert";
		// 	}
		// 	// echo "executed";

		// }
		// catch (RuntimeException $e)
		// {
		// 	JError::raiseWarning(500, $e->getMessage());
		// }


		// $db    = JFactory::getDbo();
		// $query = $db->getQuery(true);
		// // Create the base update statement.
		// $query->update($db->quoteName('#__maps_drugstore'))
		// 	->set($db->quoteName('latitude') . ' = ' . $db->quote($latitude))
		// 	->set($db->quoteName('longitude') . ' = ' . $db->quote($longitude))
		// 	->where($db->quoteName('id') . ' = ' . $db->quote($id));
		// // Set the query and execute the update.
		// $db->setQuery($query);
		// try
		// {
		// 	$a = $db->execute();
		// 	if($a)
		// 	{
		// 		echo"insert";
		// 	}
		// 	// echo "executed";

		// }
		// catch (RuntimeException $e)
		// {
		// 	JError::raiseWarning(500, $e->getMessage());
		// }
		// 
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		// Create the base update statement.
		$query->update($db->quoteName('#__maps_facility'))
			->set($db->quoteName('latitude') . ' = ' . $db->quote($latitude))
			->set($db->quoteName('longitude') . ' = ' . $db->quote($longitude))
			->where($db->quoteName('id') . ' = ' . $db->quote($id));
		// Set the query and execute the update.
		$db->setQuery($query);
		try
		{
			$a = $db->execute();
			if($a)
			{
				echo"insert";
			}
			// echo "executed";

		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}
	}


function get_data_map_list() {
	$table = $_POST['table'];
	$order_by = $_POST['order_by'];
	$limit = $_POST['limit'];
	$offset = ($_POST['offset']-1)* $limit;
	if (!empty($_POST['longitude'])) { $long = $_POST['longitude'];
	} else { $long = get_longitude(); }
	if (!empty($_POST['latitude'])) { $lat = $_POST['latitude'];
	} else { $lat = get_latitude();}

	$data = get_data_model_map_list($limit,$offset, $table, $order_by,$long,$lat);
	echo json_encode($data);
}

function get_data_map_count() {
	$table = $_POST['table'];
	$order_by = $_POST['order_by'];
	$per_page = $_POST['limit'];
	$limit = '9999999';
	$offset = '0';
	if (!empty($_POST['longitude'])) { $long = $_POST['longitude'];
	} else { $long = get_longitude(); }
	if (!empty($_POST['latitude'])) { $lat = $_POST['latitude'];
	} else { $lat = get_latitude();}
	$data = count(get_data_model_map_list($limit,$offset, $table, $order_by,$long,$lat));
	$page_count = ceil($data/$per_page);
	echo $page_count;
}

function nfm_count(){

		if (!empty($_POST['longitude'])) { $long = $_POST['longitude'];
		} else { $long = get_longitude(); }
		if (!empty($_POST['latitude'])) { $lat = $_POST['latitude'];
		} else { $lat = get_latitude();}

		$flu_reports = count(getTags($long,$lat));

		$nfr_reports_tag = count(getTagsCountPhil($long,$lat));
		$nfr_reports_twitter = count(getTwitterTagsCountPhil($long,$lat));
		$nfr_reports = count(getTwitterTagsCountPhil($long,$lat)); //$nfr_reports_tag + $nfr_reports_twitter;

		$drugStores = count(getDrugstores($long,$lat));
		$default_place = get_default_place();
// ,'flucount' => $data
		echo json_encode(array('location' => $default_place,'drugStores' => $drugStores, 'flu_reports' => $flu_reports, 'nfr_reports' => $nfr_reports));		
}


function get_data() {
	$table = $_POST['table'];
	$order_by = $_POST['order_by'];

	$data = get_data_model($table, $order_by);
	echo json_encode($data);
}


?>