<?php require_once dirname(__FILE__) . '/config.php'; 

	function save_model($data) {
		//$result = mysql_query("INSERT INTO `table` (name) VALUES('".$data."') ");

		//return true;

		echo $data;
	}

	function getTags($long,$lat)
	{
		// Initialiase variables.
		$db    = JFactory::getDbo();
		// $query = $db->getQuery(true);
		$sql = "SELECT a.*,b.*,( 3959 * acos( cos( radians('".$lat."') ) * cos( radians( b.latitude ) ) * cos( radians( b.longitude ) - radians('".$long."') ) + sin( radians('".$lat."') ) * sin(radians(b.latitude)) ) ) AS distance 
				FROM `bio_maps_user_old` AS `a` LEFT JOIN `bio_maps_barangay` AS `b` ON (b.barangay_id = a.barangay_id) WHERE `a`.`is_active`= 1 AND `a`.`date_created`> NOW() - INTERVAL 7 DAY HAVING `distance`< 10";
		$db->setQuery($sql);
		// $query
		//     ->select('a.*,b.*')
		//     ->from($db->quoteName('bio_maps_user_old', 'a'))
		//     ->join('LEFT', $db->quoteName('bio_maps_barangay', 'b') . ' ON (b.barangay_id = a.barangay_id)')
		//     ->where($db->quoteName('a.is_active').'= 1')
		//     ->where($db->quoteName('a.date_created').'> NOW() - INTERVAL 7 DAY');		    
		// $db->setQuery($query);
		$results = $db->loadObjectList();
		try{
			$result = $db->loadAssocList();
			return $result;
		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}

	}



	function getDrugstores($long,$lat)
	{

		// Initialiase variables.
		$db    = JFactory::getDbo();

		$sql = "SELECT ( 3959 * acos( cos( radians('".$lat."') ) * cos( radians( a.latitude ) ) * cos( radians( a.longitude ) - radians('".$long."') ) + sin( radians('".$lat."') ) * sin(radians(a.latitude)) ) ) AS distance,
				a.id, a.drugstore_id, a.name, a.latitude,a.longitude, a.complete_address, b.drugstore_id, b.drugstore_name,b.drugstore_marker,c.promotion_id,c.promotion_name,c.promotion_description FROM bio_maps_drugstore AS a
				LEFT JOIN bio_maps_drugstore_marker AS b ON (b.drugstore_id = a.drugstore_id) LEFT JOIN bio_assigned_promo AS p ON (a.id = p.drugstore_id) LEFT JOIN bio_maps_promotion AS c ON (p.promo_id = c.promotion_id) 
				WHERE a.latitude != '' HAVING distance < 10";
		$db->setQuery($sql);
		$results = $db->loadObjectList();

		// $query = $db->getQuery(true);
		// $query
		//     // ->select('a.*,b.*,c.*')
		//     ->select('a.id, a.drugstore_id, a.name, a.latitude,a.longitude, a.complete_address, b.drugstore_id, b.drugstore_name,b.drugstore_marker,c.promotion_id,c.promotion_name,c.promotion_description')
		//     ->from($db->quoteName('bio_maps_drugstore', 'a'))
		//     ->join('LEFT', $db->quoteName('bio_maps_drugstore_marker', 'b') . ' ON (b.drugstore_id = a.drugstore_id)')
		//     ->join('LEFT', $db->quoteName('bio_assigned_promo', 'p') . ' ON (a.id = p.drugstore_id)')
		//     ->join('LEFT', $db->quoteName('bio_maps_promotion', 'c') . ' ON (p.promo_id = c.promotion_id)')
		// //     ->where($db->quoteName('a.latitude').'!=""');


		// $db->setQuery($query);
		// $results = $db->loadObjectList();
		try
		{
			$result = $db->loadAssocList();
			return $result;
		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}

	}

	function getProvince()
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
			
		$query
		    ->select('*')
		    ->from($db->quoteName('bio_maps_province'));
		  
		$db->setQuery($query);
		$results = $db->loadObjectList();
		try
		{
			$result = $db->loadAssocList();
			return $result;
		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}
	}

	function getTerritory($province_id)
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
			
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query
		    ->select('*')
		    ->from($db->quoteName('bio_maps_territory'))
		    ->where($db->quoteName('province_id') . ' = ' . $db->quote($province_id));
		  
		$db->setQuery($query);
		$results = $db->loadObjectList();
		try
		{
			$result = $db->loadAssocList();
			return $result;
		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}
	}

	function saveSymptoms($data)
	{	
		// print_r($data);
		$db = JFactory::getDbo();
   		$inserted = $db->insertObject('#__maps_user', $data);
   		// if($inserted)
   		// {
   		// 	return true;
   		// }
   		// return false;
	}

	function getHospital()
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);


		$query
		    ->select('a.*,b.*')
		    ->from($db->quoteName('bio_maps_hospital', 'a'))
		    ->join('LEFT', $db->quoteName('bio_maps_hospital_marker', 'b') . ' ON (b.marker_id = a.marker_id)');

		$db->setQuery($query);
		$results = $db->loadObjectList();
		try
		{
			$result = $db->loadAssocList();
			return $result;
		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}
	}

	function getAreaTags()
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);


		$query
		    ->select('a.*,t.*')
		    ->from($db->quoteName('bio_maps_user', 'a'))
		    ->join('LEFT', $db->quoteName('bio_maps_territory', 't') . ' ON (t.territory_id = a.territory_input)')
		    ->where($db->quoteName('a.flu_id').'!= NULL OR'.$db->quoteName('a.flu_id').'!=""')
		    ->where($db->quoteName('a.is_active').'= 1')
		    ->order($db->quoteName('t.territory_id'));
		   // ->where($db->quoteName('a.date_created').'> NOW() - INTERVAL 5 DAY');

		$db->setQuery($query);
		$results = $db->loadObjectList();
		try
		{
			$result = $db->loadAssocList();
			return $result;
		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}

	}

	function getTwitterReport()
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
		    ->select('*')
		    ->from($db->quoteName('#__twitter_reports'))
		    ->where($db->quoteName('latitude').'!= "" AND'.$db->quoteName('longitude').'!= "" OR'. $db->quoteName('address').'!=""');


		$db->setQuery($query);
		// $results = $db->loadObjectList();
		try
		{
			$result = $db->loadAssocList();
			return $result;
		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}
		// Initialiase variables.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
	}


	function getptb()
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
		    ->select('a.*,b.*,c.*')
		    ->from($db->quoteName('#__maps_province','a'))
		    ->join('LEFT', $db->quoteName('#__maps_territory', 'b') . ' ON (b.province_id = a.province_id)')
		    ->join('LEFT', $db->quoteName('#__maps_barangay', 'c') . ' ON (c.territory_id = b.territory_id)')
		    ->order($db->quoteName('c.barangay_id'));

		// $query->setLimit(5);
		$db->setQuery($query);
		// $results = $db->loadObjectList();
		try
		{
			$result = $db->loadAssocList();
			return $result;
		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}
		// Initialiase variables.

	}

	function getfacility()
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
		    ->select('a.*,b.*')
		    ->from($db->quoteName('#__maps_facility','a'))
		    ->join('LEFT', $db->quoteName('bio_maps_hospital_marker', 'b') . ' ON (b.marker_id = a.marker_id)')
		    ->where($db->quoteName('a.latitude').'!=""')
		    ->where($db->quoteName('a.latitude').'!="NULL"')
		    ->order($db->quoteName('a.id'));
		$query->setLimit(300);
		$db->setQuery($query);
		// $results = $db->loadObjectList();
		try
		{
			$result = $db->loadAssocList();
			return $result;
		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}
	}

	function getfacilityOffset($offset,$long,$lat)
	{

		
		$db    = JFactory::getDbo();



		$sql = "SELECT ( 3959 * acos( cos( radians('".$lat."') ) * cos( radians( a.latitude ) ) * cos( radians( a.longitude ) - radians('".$long."') ) + sin( radians('".$lat."') ) * sin(radians(a.latitude)) ) ) AS distance,
				a.*,b.* FROM bio_maps_facility AS a LEFT JOIN bio_maps_hospital_marker AS b ON (b.marker_id = a.marker_id) WHERE a.latitude!='' HAVING distance < 5";
		$db->setQuery($sql);

		// $query = $db->getQuery(true);
		// $query
		//     ->select('a.*,b.*')
		//     ->from($db->quoteName('#__maps_facility','a'))
		//     ->join('LEFT', $db->quoteName('bio_maps_hospital_marker', 'b') . ' ON (b.marker_id = a.marker_id)')
		//     ->where($db->quoteName('a.latitude').'!=""')
		//     ->where($db->quoteName('a.latitude').'!="NULL"')
		//     ->order($db->quoteName('a.id'));
		// $query->setLimit(300,$offset);
		// $db->setQuery($query);
		// $results = $db->loadObjectList();
		try
		{
			$result = $db->loadAssocList();
			return $result;
		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}
	}
	function countFacility()
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
		    ->select('count(*)')
		    ->from($db->quoteName('#__maps_facility'))
		    ->where($db->quoteName('latitude').'!=""')
		    ->where($db->quoteName('latitude').'!="NULL"')
		    ->order($db->quoteName('id'));
		$db->setQuery($query);
		try
		{
			$result = $db->loadResult();
			return $result;
		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}
	}

	function getfacility2()
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
		    ->select('*')
		    ->from($db->quoteName('#__maps_facility'))
		    ->where($db->quoteName('latitude').'is NULL')
		    ->where($db->quoteName('id').'>"24499"')
		    ->order($db->quoteName('id'));

		$db->setQuery($query);
		// $results = $db->loadObjectList();
		try
		{
			$result = $db->loadAssocList();
			return $result;
		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}
	}

	function addThisCount($name)
	{
		// Initialiase variables.
		// UPDATE table SET field = field + 1 WHERE [...]
		// 
		// 
		// echo $name;
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		// Create the base update statement.
		$query->update($db->quoteName('#__flumonitor_count'))
			->set($db->quoteName('count') . ' = count + 1')
			->where($db->quoteName('name') . ' = ' . $db->quote($name));
		
		// Set the query and execute the update.
		$db->setQuery($query);
		
		try
		{
			$db->execute();
		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}
	}


	//latlng generator
	// function drugs()
	// {
	// 	$db    = JFactory::getDbo();
	// 	$query = $db->getQuery(true);

	// 	$query
	// 	    // ->select('a.*,b.*,c.*')
	// 	    ->select('id,complete_address,latitude,longitude')
	// 	    ->from($db->quoteName('bio_maps_drugstore', 'a'))
	// 	    ->where($db->quoteName('drugstore_id') .'='. '2');

	// 	$db->setQuery($query);
	// 	$results = $db->loadObjectList();
	// 	try
	// 	{
	// 		$result = $db->loadAssocList();
	// 		return $result;
	// 	}
	// 	catch (RuntimeException $e)
	// 	{
	// 		JError::raiseWarning(500, $e->getMessage());
	// 	}

	// }



    // Get lat and long by address         
	// function getMapSettings()
	// {	
	// 	// Initialiase variables.
	// 	$db    = JFactory::getDbo();
	// 	$query = $db->getQuery(true);

	// 	// Create the base select statement.
	// 	$query->select('*')
	// 		->from($db->quoteName('#___map_setting'));
		
	// 	// Set the query and load the result.
	// 	$db->setQuery($query);

	// 	try
	// 	{
	// 		$result = $db->loadAssocList();
	// 		return $result();
	// 	}
	// 	catch (RuntimeException $e)
	// 	{
	// 		JError::raiseWarning(500, $e->getMessage());
	// 	}
	// }


function get_data_model_map_list($limit,$offset, $table, $order_by,$long,$lat){
	$db = JFactory::getDbo();
	//$query = $db->getQuery(true);

	$sql = "SELECT *,( 3959 * acos( cos( radians('".$lat."') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('".$long."') ) + sin( radians('".$lat."') ) * sin(radians(latitude)) ) ) AS distance
			FROM #__".$table." WHERE is_active = 1 HAVING distance < 10 ORDER BY ".$order_by."  LIMIT ".$offset.", ".$limit." ";
	$db->setQuery($sql);  
	// $query
	// 	->select('*')
	// 	->from($db->quoteName('#__'.$table))
	// 	->where($db->quoteName('is_active').'= "1"')
	// 	->order($order_by,'DESC')
	// 	->setLimit($limit,$offset);
	// $db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}


function getTagsCount($latitude,$longitude){

		// Initialiase variables.
		$db = JFactory::getDBO();
		//$userid = $arr['user_id'];
		$sql = "SELECT b.barangay_id, ( 3959 * acos( cos( radians('".$latitude."') ) * cos( radians( b.latitude ) ) * cos( radians( b.longitude ) - radians('".$longitude."') ) + sin( radians('".$latitude."') ) * sin(radians(b.latitude)) ) ) AS distance,
				a.* FROM `bio_maps_user_old` AS `a` LEFT JOIN `bio_maps_barangay` AS `b` ON (b.barangay_id = a.barangay_id) WHERE `a`.`is_active`= 1 AND `a`.`date_created`> NOW() - INTERVAL 7 DAY HAVING `distance`< 10 ";
		$db->setQuery($sql);  
		$results = $db->loadObjectList();
		try{
			$result = $db->loadAssocList();
			return $result;
		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}

}

function getTagsCountPhil($latitude,$longitude){
		// Initialiase variables.
		$db = JFactory::getDBO();
		//$userid = $arr['user_id'];
		$sql = "SELECT b.barangay_id, ( 3959 * acos( cos( radians('".$latitude."') ) * cos( radians( b.latitude ) ) * cos( radians( b.longitude ) - radians('".$longitude."') ) + sin( radians('".$latitude."') ) * sin(radians(b.latitude)) ) ) AS distance, a.* FROM `bio_maps_user_old` AS `a` LEFT JOIN `bio_maps_barangay` AS `b` ON (b.barangay_id = a.barangay_id) WHERE `a`.`is_active`= 1 AND `a`.`date_created`> NOW() - INTERVAL 7 DAY";
		$db->setQuery($sql);  
		$results = $db->loadObjectList();
		try{
			$result = $db->loadAssocList();
			return $result;
		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}
}
	
function get_data_model( $table, $order_by){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('*')
		->from($db->quoteName('#__'.$table))
		->where($db->quoteName('state').'= "1" OR '.$db->quoteName('state').'= "0"')
		->order($order_by,'ASC');
		
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}

function get_longitude(){
    $db = JFactory::getDBO();
    $sql = "SELECT default_long FROM bio_maps_default";

    $db->setQuery($sql);  
    $results = $db->loadResult();
    return $results;
}
function get_latitude(){
    $db = JFactory::getDBO();
    $sql = "SELECT default_lat FROM bio_maps_default";

    $db->setQuery($sql);  
    $results = $db->loadResult();
    return $results;
}



function getTagsDefault($long,$lat)
	{
		// Initialiase variables.
		$db    = JFactory::getDbo();
		// $query = $db->getQuery(true);
		$sql = "SELECT a.*,b.*,( 3959 * acos( cos( radians('".$lat."') ) * cos( radians( b.latitude ) ) * cos( radians( b.longitude ) - radians('".$long."') ) + sin( radians('".$lat."') ) * sin(radians(b.latitude)) ) ) AS distance 
				FROM `bio_maps_user_old` AS `a` LEFT JOIN `bio_maps_barangay` AS `b` ON (b.barangay_id = a.barangay_id) WHERE `a`.`is_active`= 1 AND `a`.`date_created`> NOW() - INTERVAL 7 DAY HAVING `distance`< 50";
		$db->setQuery($sql);

		$results = $db->loadObjectList();
		try{
			$result = $db->loadAssocList();
			return $result;
		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}

	}

function getDrugstoresDefault()
	{
		// Initialiase variables.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
		    // ->select('a.*,b.*,c.*')
		    ->select('a.id, a.drugstore_id, a.name, a.latitude,a.longitude, a.complete_address, b.drugstore_id, b.drugstore_name,b.drugstore_marker,c.promotion_id,c.promotion_name,c.promotion_description')
		    ->from($db->quoteName('bio_maps_drugstore', 'a'))
		    ->join('LEFT', $db->quoteName('bio_maps_drugstore_marker', 'b') . ' ON (b.drugstore_id = a.drugstore_id)')
		    ->join('LEFT', $db->quoteName('bio_assigned_promo', 'p') . ' ON (a.id = p.drugstore_id)')
		    ->join('LEFT', $db->quoteName('bio_maps_promotion', 'c') . ' ON (p.promo_id = c.promotion_id)')
		     ->where($db->quoteName('a.latitude').'!=""');


		$db->setQuery($query);
		$results = $db->loadObjectList();
		try
		{
			$result = $db->loadAssocList();
			return $result;
		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}

	}

	// function getTagsDefault($long,$lat)
	// {
	// 	// Initialiase variables.
	// 	$db    = JFactory::getDbo();
	// 	$query = $db->getQuery(true);

	// 	$query
	// 	    ->select('a.*,b.*')
	// 	    ->from($db->quoteName('bio_maps_user_old', 'a'))
	// 	    ->join('LEFT', $db->quoteName('bio_maps_barangay', 'b') . ' ON (b.barangay_id = a.barangay_id)')
	// 	    ->where($db->quoteName('a.is_active').'= 1')
	// 	    ->where($db->quoteName('a.date_created').'> NOW() - INTERVAL 7 DAY');		    
	// 	$db->setQuery($query);
	// 	$results = $db->loadObjectList();
	// 	try{
	// 		$result = $db->loadAssocList();
	// 		return $result;
	// 	}
	// 	catch (RuntimeException $e)
	// 	{
	// 		JError::raiseWarning(500, $e->getMessage());
	// 	}

	// }


	function getfacilityOffsetDefault($offset)
	{
		
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
		    ->select('a.marker_id,a.latitude,a.id,a.city_name,a.longitude,a.latitude,a.facility_name,b.marker_id,b.marker_path')
		    ->from($db->quoteName('#__maps_facility','a'))
		    ->join('LEFT', $db->quoteName('bio_maps_hospital_marker', 'b') . ' ON (b.marker_id = a.marker_id)')
		    ->where($db->quoteName('a.latitude').'!=""')
		    ->where($db->quoteName('a.latitude').'!="NULL"')
		    ->order($db->quoteName('a.id'));
		$query->setLimit(300,$offset);
		$db->setQuery($query);
		$results = $db->loadObjectList();
		try
		{
			$result = $db->loadAssocList();
			return $result;
		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}
	}

function get_data_model_map_list_default($limit,$offset, $table, $order_by){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('*')
		->from($db->quoteName('#__'.$table))
		->where($db->quoteName('is_active').'= "1"')
		->order($order_by,'DESC')
		->setLimit($limit,$offset);
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}

?>