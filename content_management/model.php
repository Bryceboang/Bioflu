<?php  require_once dirname(__FILE__) . '/layout/config.php';



// function article_list($limit,$offset, $search){

// 	$db = JFactory::getDbo();

// 	$query = $db->getQuery(true);

// 	$query

// 		->select('*')

// 		->from($db->quoteName('#__flunew_articles', 'c'))

// 		->join('LEFT', $db->quoteName('#__categories', 'g') . ' ON (' . $db->quoteName('c.catid') . ' = ' . $db->quoteName('g.id') . ')')

// 		->where($db->quoteName('c.title') . ' LIKE "%'.$search.'%"'.' OR '.$db->quoteName('c.state').'= "1" OR '.$db->quoteName('c.state').'= "0"')

// 		->setLimit($limit,$offset);

// 	$db->setQuery($query);

// 	$results = $db->loadObjectList();

// 	return $results;

// }



function article_aboutus($limit,$offset){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select($db->quoteName(array('c.id', 'c.title', 'c.state','c.catid')))

		->select($db->quoteName('g.title','category'))

		->from($db->quoteName('#__content', 'c'))

		->join('LEFT', $db->quoteName('#__categories', 'g') . ' ON (' . $db->quoteName('c.catid') . ' = ' . $db->quoteName('g.id') . ')')

		->where($db->quoteName('g.alias') . ' LIKE "%about%"')

		->where($db->quoteName('c.state').'= "1" OR '.$db->quoteName('c.state').'= "0"')



		->setLimit($limit,$offset);

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function image_gallery($limit,$offset){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select($db->quoteName(array('id', 'image', 'title', 'description', 'url', 'state')))

		->from($db->quoteName('#__image_gallery'))

		->where($db->quoteName('state').'= "1" OR '.$db->quoteName('state').'= "0"')



		->setLimit($limit,$offset);

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function article_contactus($limit,$offset){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select($db->quoteName(array('c.id', 'c.title', 'c.state','c.catid')))

		->select($db->quoteName('g.title','category'))

		->from($db->quoteName('#__content', 'c'))

		->join('LEFT', $db->quoteName('#__categories', 'g') . ' ON (' . $db->quoteName('c.catid') . ' = ' . $db->quoteName('g.id') . ')')

		->where($db->quoteName('g.alias') . ' LIKE "%contact%"')

		->where($db->quoteName('c.state').'= "1" OR '.$db->quoteName('c.state').'= "0"')



		->setLimit($limit,$offset);

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}





function get_article($id){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select($db->quoteName(array('c.id', 'c.title','c.image_path', 'c.state', 'c.catid',  'c.introtext', 'c.alias', 'u.name', 'c.created', 'c.modified', 'c.publish_up', 'c.publish_down', 'c.hits', 't.path')))

		->from($db->quoteName('#__content','c'))

		->join('LEFT', $db->quoteName('#__users', 'u') . ' ON (' . $db->quoteName('c.created_by') . ' = ' . $db->quoteName('u.id') . ')')

		->join('LEFT', $db->quoteName('#__tags', 't') . ' ON (' . $db->quoteName('c.created_by') . ' = ' . $db->quoteName('t.created_user_id') . ')')

		->where($db->quoteName('c.id') . ' = '. $db->quote($id));

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}







function get_ads_m($id){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from($db->quoteName('#__widgets'))

		->where($db->quoteName('id') . ' = '. $db->quote($id));

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function save_data($data,$tbl_name) {

	$db = JFactory::getDBO();

   	$db->insertObject($tbl_name, $data);

   	return $db->insertid();

}



function update_data($data,$tbl_name, $id){

	$db = JFactory::getDBO();

   	$db->updateObject($tbl_name, $data, $id);

}



function video_list($limit,$offset){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select($db->quoteName(array('id', 'title', 'creation_date')))

		->from($db->quoteName('#__videos'))

		->setLimit($limit,$offset);

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function delete_data($id){

	$db = JFactory::getDbo(); 

	$query = $db->getQuery(true); 

	$query->delete($db->quoteName('#__videos')) 

		->where(array($db->quoteName('id') . '='.$id)); 

	$db->setQuery($query); 

	$result = $db->query(); 

	return $results;



}

function save_video($data,$tbl_name) {

	$db = JFactory::getDBO();

   	$db->insertObject($tbl_name, $data);

}



function ads_list($limit,$offset){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from($db->quoteName('#__widgets'))

		->where($db->quoteName('status').'= 1 OR '. $db->quoteName('status').' = 0')

		->setLimit($limit,$offset);

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}





function slider_list(){

	

	



	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from('#__modules')

		->where($db->quoteName('published').'IN ("1","0") ')

		->where($db->quoteName('module').'IN ("mod_js_flexslider","mod_js_featured") ');

	$db->setQuery($query);

	$results = $db->loadAssocList();

	return $results;





}

function getlogs(){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from('#__flumonitor_count');

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}

function getslider($id){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('params')

		->from('#__modules')

		->where(array($db->quoteName('id') . '='.$id)); 

	$db->setQuery($query);

	$results = $db->loadAssocList();

	return $results;

}





function inactive_article($id, $type){

	$db = JFactory::getDbo();

 

	$query = $db->getQuery(true);



	$fields = array(

	    $db->quoteName('state')  . ' = "'.$type.'"'

	);

	 

	$conditions = array(

	    $db->quoteName('id') . ' = "'.$id.'"'

	);





	 

	$query->update($db->quoteName('#__content'))->set($fields)->where($conditions);

	 

	$db->setQuery($query);

	 

	$result = $db->execute();

}



function inactive_module($id, $type){

	$db = JFactory::getDbo();

 

	$query = $db->getQuery(true);



	$fields = array(

	    $db->quoteName('published')  . ' = "'.$type.'"'

	);

	 

	$conditions = array(

	    $db->quoteName('id') . ' = "'.$id.'"'

	);





	 

	$query->update($db->quoteName('#__modules'))->set($fields)->where($conditions);

	 

	$db->setQuery($query);

	 

	$result = $db->execute();

}



function login($username,$password){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select($db->quoteName(array('id','username')))

		->from($db->quoteName('#__users'))

		->where($db->quoteName('username') . '= "'.$username.'" ')

		->where($db->quoteName('password') . '= "'.$password.'" ')

		->where($db->quoteName('state') . '= "1" ');

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function getmenu(){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('n.*')

		->select($db->quoteName(array('s.menu_id')))

		->from($db->quoteName('#__navigation', 'n'))	

		->join('LEFT', $db->quoteName('#__sub_navigation', 's') . ' ON (' . $db->quoteName('n.id') . ' = ' . $db->quoteName('s.menu_id') . ')')

		->order($db->quoteName('n.menu') . ' ASC')

		->group($db->quoteName('n.id'));

	$db->setQuery($query);

	$results = $db->loadAssocList();

	return $results;

}



function getsubmenu($id){

	// $db = JFactory::getDbo();

	// $query = $db->getQuery(true);

	// $query

	// 	->select('*')

	// 	->from('#__sub_navigation')

	// 	->where($db->quoteName('menu_id') . '= "'.$id.'" ')

	// 	->order($db->quoteName('ordering') . ' ASC');

	// $db->setQuery($query);

	// $results = $db->loadAssocList();

	// return $results;



	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('sn.*')

		->select($db->quoteName(array('sns.menu_id')))

		->from($db->quoteName('#__sub_navigation', 'sn'))	

		->join('LEFT', $db->quoteName('#__sub_navigation_sub', 'sns') . ' ON (' . $db->quoteName('sn.id') . ' = ' . $db->quoteName('sns.menu_id') . ')')

			->where($db->quoteName('sn.menu_id') . '= "'.$id.'" ')

		->order($db->quoteName('sn.sub_menu') . ' ASC')

		->group($db->quoteName('sn.id'));

	$db->setQuery($query);

	$results = $db->loadAssocList();

	return $results;







}



function updatesettings($id, $status){

	$db = JFactory::getDbo();

 

	$query = $db->getQuery(true);



	$fields = array(

	    $db->quoteName('is_active')  . ' = "'.$status.'"'

	);

	 

	$conditions = array(

	    $db->quoteName('id') . ' = "'.$id.'"'

	);





	$query->update($db->quoteName('#__navigation'))->set($fields)->where($conditions);

	 

	$db->setQuery($query);

	 

	$result = $db->execute();

}



function get_categories(){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from($db->quoteName('#__article_category'))

		->where($db->quoteName('status') . ' = 1');

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function gethospital($limit,$offset){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from($db->quoteName('#__maps_facility'))

		->where($db->quoteName('is_active').'= "1" OR '.$db->quoteName('is_active').'= "0"')

		->setLimit($limit,$offset);

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function get_image_gallery($id){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select($db->quoteName(array('id', 'image', 'title', 'description', 'url', 'state')))

		->from($db->quoteName('#__image_gallery'))

		->where($db->quoteName('id') . ' = '. $db->quote($id))

		->where($db->quoteName('state').'= "1" OR '.$db->quoteName('state').'= "0"');	

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}





function video_gallery($limit,$offset){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from($db->quoteName('#__video'))

		->where($db->quoteName('status').'= "1" OR '.$db->quoteName('status').'= "0"')

		->setLimit($limit,$offset);

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function get_video_gallery($id){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from($db->quoteName('#__video'))

		->where($db->quoteName('id') . ' = '. $db->quote($id));

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function gethost(){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from($db->quoteName('#__contact_us'));	

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function getsymptoms($limit,$offset){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from($db->quoteName('#__flu_symptoms'))

		->where($db->quoteName('state').'= "1" OR '.$db->quoteName('state').'= "0"')

		->setLimit($limit,$offset);

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function editsymptoms($id){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from($db->quoteName('#__flu_symptoms'))

		->where($db->quoteName('id') . ' = '. $db->quote($id));	

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function edithospital($id){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from($db->quoteName('#__maps_facility'))

		->where($db->quoteName('id') . ' = '. $db->quote($id));

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function getdrugstore($limit,$offset){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select($db->quoteName(array( 'id', 'name', 'address1', 'address2', 'location', 'zip_code', 'contact_number', 'complete_address', 'latitude', 'longitude', 'is_active')))

		->from($db->quoteName('#__maps_drugstore'))

		->where($db->quoteName('is_active').'= "1" OR '.$db->quoteName('is_active').'= "0"')

		->setLimit($limit,$offset);

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function editdrugstore($id){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select($db->quoteName(array( 'd.id', 'd.name', 'd.address1', 'd.address2', 'd.location', 'd.zip_code', 'd.contact_number', 'd.complete_address', 'd.latitude', 'd.longitude', 'd.is_active', 'p.promotion_name', 'p.promotion_id')))

		->from($db->quoteName('#__maps_drugstore', 'd'))

		->join('LEFT', $db->quoteName('#__maps_promotion', 'p') . ' ON (' . $db->quoteName('d.promotion_id') . ' = ' . $db->quoteName('p.promotion_id') . ')')

		->where($db->quoteName('d.id') . ' = '. $db->quote($id));	

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function getflureports($limit,$offset){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from($db->quoteName('#__maps_user_old'))

		->where($db->quoteName('is_active').'= "1" OR '.$db->quoteName('is_active').'= "0"')

		->setLimit($limit,$offset);

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function editflureports($id){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from($db->quoteName('#__maps_user_old'))

		->where($db->quoteName('user_id') . ' = '. $db->quote($id));

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}





function getpromo($limit,$offset){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from($db->quoteName('#__maps_promotion'))

		->where($db->quoteName('is_active').'= "1" OR '.$db->quoteName('is_active').'= "0"')

		->setLimit($limit,$offset);

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function editpromo($id){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from($db->quoteName('#__maps_promotion'))

		->where($db->quoteName('promotion_id') . ' = '. $db->quote($id));	

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function getpromolist(){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from($db->quoteName('#__maps_promotion'))

		->where($db->quoteName('is_active').'= "1" OR '.$db->quoteName('is_active').'= "0"');

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function getusersymptoms($id){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('u.*')

		->select('f.*')

		->from($db->quoteName('#__user_symptoms', 'u'))

		->join('LEFT', $db->quoteName('#__flu_symptoms', 'f') . ' ON (' . $db->quoteName('u.symptoms_id') . ' = ' . $db->quoteName('f.id') . ')')

		->where($db->quoteName('user_symptoms_id') . ' = '. $db->quote($id));

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function getlocation($id){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('t.*')

		->select('p.*')

		->from($db->quoteName('#__maps_territory', 't'))

		->join('LEFT', $db->quoteName('#__maps_province', 'p') . ' ON (' . $db->quoteName('t.province_id') . ' = ' . $db->quoteName('p.province_id') . ')')

		->where($db->quoteName('t.territory_id') . ' = '. $db->quote($id));

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}







function getmenusettings($limit,$offset){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select($db->quoteName(array('id', 'menutype', 'title', 'alias','link','published')))

		->from($db->quoteName('#__menu'))

		->where($db->quoteName('menutype').'= "mainmenu"')

		->where($db->quoteName('published').'NOT IN ("-2") ')

		->setLimit($limit,$offset);

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function editmenu($id){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select($db->quoteName(array('id', 'menutype', 'title', 'alias','link','published')))

		->from($db->quoteName('#__menu'))

		->where($db->quoteName('id') . ' = '. $db->quote($id));

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function getselectarticle(){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select($db->quoteName(array('id', 'title', 'alias')))

		->from($db->quoteName('#__content'))

		->where($db->quoteName('state').'NOT IN ("-2") ')

		->where($db->quoteName('catid').'= "8"');

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function assignpromotion($id){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('a.*')

		->select('d.name')

		->from($db->quoteName('#__assigned_promo','a'))

		->join('LEFT', $db->quoteName('#__maps_drugstore', 'd') . ' ON (' . $db->quoteName('a.drugstore_id') . ' = ' . $db->quoteName('d.id') . ')')

		->where(array($db->quoteName('a.promo_id') . '='.$id)); 

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function getdrugstoreassign(){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select($db->quoteName(array( 'id', 'name', 'address1', 'address2', 'location', 'zip_code', 'contact_number', 'complete_address', 'latitude', 'longitude', 'is_active')))

		->from($db->quoteName('#__maps_drugstore'))

		->where($db->quoteName('id').'NOT IN (select drugstore_id from ' . $db->quoteName('#__assigned_promo').')')

		->where($db->quoteName('is_active').'= "1" OR '.$db->quoteName('is_active').'= "0"');

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function removepromo($id){

	$db = JFactory::getDbo(); 

	$query = $db->getQuery(true); 

	$query->delete($db->quoteName('#__assigned_promo')) 

		->where(array($db->quoteName('id') . '='.$id)); 

	$db->setQuery($query); 

	$result = $db->query(); 

	return $results;



}



function getsubmenusub($id){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from('#__sub_navigation_sub')

		->where($db->quoteName('menu_id') . '= "'.$id.'" ')

		->order($db->quoteName('ordering') . ' ASC');

	$db->setQuery($query);

	$results = $db->loadAssocList();

	return $results;

}



function getsymptomsalias(){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select($db->quoteName(array( 'alias')))

		->from('#__flu_symptoms')

		->where($db->quoteName('type') . '= "filipino" ');

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function checktwitterid($id){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from('#__twitter_reports')

		->where($db->quoteName('sn') . '= "'.$id.'" ');

	$db->setQuery($query);

	$results = $db->loadAssocList();

	return $results;

}



function gettwosymptoms($symptom1, $strdate, $enddate){

	$id = 1;

	$datecheck= date('Y-m-d');

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from('#__twitter_reports')


		->where($db->quoteName('symptoms') . " LIKE '%".$symptom1."%'")

			->where( $db->quoteName('date_generated') . " BETWEEN '" . $strdate . "' AND '" . $enddate."'");



	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function twitter_interjection($id){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from('#__twitter_interjection')

		->where($db->quoteName('groupings') . '="'.$id.'" ');


	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function groupings(){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from('#__twitter_interjection_groupings');

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}





function gettwitterreports($limit,$offset,$data_get){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);
	if($limit =='9999999')
	{
			$query

	->select('count(*) as count')

		->from('#__twitter_reports')
		->where($db->quoteName('data_get') . ' = '. $db->quote($data_get))
		->order($db->quoteName('id') . ' DESC')
		->setLimit($limit,$offset);
	}
	else{
			$query
	->select('*')

		->from('#__twitter_reports')
		->where($db->quoteName('data_get') . ' = '. $db->quote($data_get))
		->order($db->quoteName('id') . ' DESC')
		->setLimit($limit,$offset);		
	}




	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function getmanualreports($limit,$offset){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

	->select('*')

		->from('#__maps_user_old')		

		->setLimit($limit,$offset);

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function gettwitterinterjection($limit,$offset){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('g.name')

		->select($db->quoteName(array('i.symptom1', 'i.symptom2', 'i.state', 'i.id')))

		->from($db->quoteName('#__twitter_interjection','i'))

		->join('LEFT', $db->quoteName('#__twitter_interjection_groupings', 'g') . ' ON (' . $db->quoteName('i.groupings') . ' = ' . $db->quoteName('g.id') . ')')

		->where($db->quoteName('i.state').'= "1" OR '.$db->quoteName('i.state').'= "0"')

		->setLimit($limit,$offset);

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}

function getcomments($limit,$offset){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('b.article_title')

		->select($db->quoteName(array('a.comment', 'a.fb_name', 'a.is_parent', 'a.is_active', 'a.id')))

		->from($db->quoteName('#__article_comments','a'))

		->join('LEFT', $db->quoteName('#__flunew_articles', 'b') . ' ON (' . $db->quoteName('a.article_id') . ' = ' . $db->quoteName('b.id') . ')')

		->order($db->quoteName('a.article_id') . ' DESC')

		->setLimit($limit,$offset);

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}


function editgettwitterinterjection($id){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('g.name')

		->select($db->quoteName('g.id','grp_id'))

		->select($db->quoteName(array('i.symptom1', 'i.symptom2', 'i.state', 'i.id')))

		->from($db->quoteName('#__twitter_interjection','i'))

		->join('LEFT', $db->quoteName('#__twitter_interjection_groupings', 'g') . ' ON (' . $db->quoteName('i.groupings') . ' = ' . $db->quoteName('g.id') . ')')

		->where($db->quoteName('i.id') . ' = '. $db->quote($id));	

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function getgroupings(){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from('#__twitter_interjection_groupings');

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function getuser($limit,$offset){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('u.*')

		->select('g.group_id')

		->select('ug.title')

		->from($db->quoteName('#__users', 'u'))

		->join('LEFT', $db->quoteName('#__user_usergroup_map', 'g') . ' ON (' . $db->quoteName('u.id') . ' = ' . $db->quoteName('g.user_id') . ')')

		->join('LEFT', $db->quoteName('#__usergroups', 'ug') . ' ON (' . $db->quoteName('g.group_id') . ' = ' . $db->quoteName('ug.id') . ')')

		->where($db->quoteName('u.state').'= "1" OR '.$db->quoteName('u.state').'= "0"')

		

		->setLimit($limit,$offset);

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function edituser($id){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('u.*')

		->select('g.group_id')

		->select('ug.title')

		->from($db->quoteName('#__users', 'u'))

		->join('LEFT', $db->quoteName('#__user_usergroup_map', 'g') . ' ON (' . $db->quoteName('u.id') . ' = ' . $db->quoteName('g.user_id') . ')')

		->join('LEFT', $db->quoteName('#__usergroups', 'ug') . ' ON (' . $db->quoteName('g.group_id') . ' = ' . $db->quoteName('ug.id') . ')')

		->where($db->quoteName('u.id') . ' = '. $db->quote($id));	

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}





function getusergroup(){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select('*')

		->from('#__usergroups');

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function check_email($email){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select($db->quoteName(array('email')))

		->from('#__users')

		->where($db->quoteName('email') . '= "'.$email.'" ')

		->where($db->quoteName('state') . ' = "1"');	

	$db->setQuery($query);

	$results = $db->loadAssocList();

	return $results;

}



function check_token($id){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select($db->quoteName(array('id')))

		->from('#__users')

		->where($db->quoteName('password') . '= "'.$id.'" ');

	$db->setQuery($query);

	$results = $db->loadAssocList();

	return $results;

}



function getarticlefeatured($limit,$offset){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select($db->quoteName(array('f.id', 'c.title', 'f.state', 'f.image_path', 'f.ordering')))

		->from($db->quoteName('#__featured_article', 'f'))

		->join('LEFT', $db->quoteName('#__content', 'c') . ' ON (' . $db->quoteName('f.article_id') . ' = ' . $db->quoteName('c.id') . ')')

		->setLimit($limit,$offset);

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}









function editarticlefeatured($id){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select($db->quoteName(array('f.id', 'c.title', 'f.state', 'f.image_path', 'f.article_id')))

		->from($db->quoteName('#__featured_article', 'f'))

		->join('LEFT', $db->quoteName('#__content', 'c') . ' ON (' . $db->quoteName('f.article_id') . ' = ' . $db->quoteName('c.id') . ')')

		->where($db->quoteName('f.id') . ' = '. $db->quote($id));	

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}



function getarticlemore($limit,$offset){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select($db->quoteName(array('f.id', 'c.title', 'f.state', 'f.image_path')))

		->from($db->quoteName('#__more_article', 'f'))

		->join('LEFT', $db->quoteName('#__content', 'c') . ' ON (' . $db->quoteName('f.article_id') . ' = ' . $db->quoteName('c.id') . ')')

		->setLimit($limit,$offset);

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}





function editarticlemore($id){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select($db->quoteName(array('f.id', 'c.title', 'f.state', 'f.image_path', 'f.article_id')))

		->from($db->quoteName('#__more_article', 'f'))

		->join('LEFT', $db->quoteName('#__content', 'c') . ' ON (' . $db->quoteName('f.article_id') . ' = ' . $db->quoteName('c.id') . ')')

		->where($db->quoteName('f.id') . ' = '. $db->quote($id));	

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}





function getmaxorder(){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select($db->quoteName('ordering'))

		->from($db->quoteName('#__featured_article'))

		->where($db->quoteName('state') . ' = 1')

		->order($db->quoteName('ordering') . ' DESC')

		->setLimit(1);

	$db->setQuery($query);

	$results = $db->loadObjectList();

	return $results;

}

/* New */

function getlist_global_model($limit,$offset, $table, $order_by){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('*')
		->from($db->quoteName('#__'.$table))
		->where($db->quoteName('state').'= "1" OR '.$db->quoteName('state').'= "0"')
		->order($order_by,'ASC')
		->setLimit($limit,$offset);
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}

function getlist_article_model($limit,$offset,$search){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('*')
		->from($db->quoteName('#__flunew_articles'))
		->where($db->quoteName('article_title') . ' LIKE "%'.$search.'%" AND '.$db->quoteName('state').'= "1" OR '.$db->quoteName('state').'= "0"')
		->order('id','ASC')
		->setLimit($limit,$offset);
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}

function getlist_banner_model($limit,$offset,$search){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('*')
		->from($db->quoteName('#__pag2flu_combination'))
		->where($db->quoteName('name') . ' LIKE "%'.$search.'%" AND '.$db->quoteName('state').'= "1" OR '.$db->quoteName('state').'= "0"')
		->order('id','ASC')
		->setLimit($limit,$offset);
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}


function getedit_global($id,$table,$field){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('*')
		->from($db->quoteName('#__'.$table))
		->where($db->quoteName($field) . ' = '. $db->quote($id));
		//->where($db->quoteName('state').'= "1" OR '.$db->quoteName('state').'= "0"');
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}

function inactive_global($id, $type, $field, $table){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$fields = array($db->quoteName('state')  . ' = "'.$type.'"'); 
	$conditions = array($db->quoteName($field) . ' = "'.$id.'"'); 
	$query->update($db->quoteName('#__'.$table))->set($fields)->where($conditions);	 
	$db->setQuery($query);	 
	$result = $db->execute();
}
/* End of new */

function update_isfeatured($id){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->update('#__video')
		->set($db->quoteName('is_featured').' = 0')
		->where($db->quoteName('id').'<>'. $db->quote($id));
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}

function get_products(){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('*')
		->from($db->quoteName('#__productpage'));
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}

function check_combination($flu_two,$flu_one){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select($db->quoteName(array('id')))

		->from('#__pag2flu_combination')

		->where(($db->quoteName('flu_one').'= "'.$flu_one.'" AND '.$db->quoteName('flu_two').'= "'.$flu_two.'"'),'OR')
		->where(($db->quoteName('flu_one').'= "'.$flu_two.'" AND '.$db->quoteName('flu_two').'= "'.$flu_one.'"'));

	$db->setQuery($query);

	$results = $db->loadAssocList();

	return $results;

}

function check_combination_edit($flu_two,$flu_one,$id){

	$db = JFactory::getDbo();

	$query = $db->getQuery(true);

	$query

		->select($db->quoteName(array('id')))

		->from('#__pag2flu_combination')

		->where(($db->quoteName('flu_one').'= "'.$flu_one.'" AND '.$db->quoteName('flu_two').'= "'.$flu_two.'" AND '.$db->quoteName('id').'!= "'.$id.'"'),'OR')
		->where(($db->quoteName('flu_one').'= "'.$flu_two.'" AND '.$db->quoteName('flu_two').'= "'.$flu_one.'" AND '.$db->quoteName('id').'!= "'.$id.'"'));

	$db->setQuery($query);

	$results = $db->loadAssocList();

	return $results;

}
