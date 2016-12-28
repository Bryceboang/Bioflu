<?php  require_once dirname(__FILE__) . '/layout/config.php';

function article_list($limit,$offset){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select($db->quoteName(array('c.id', 'c.title', 'c.state','c.catid')))
		->select($db->quoteName('g.title','category'))
		->from($db->quoteName('#__content', 'c'))
		->join('LEFT', $db->quoteName('#__categories', 'g') . ' ON (' . $db->quoteName('c.catid') . ' = ' . $db->quoteName('g.id') . ')')
		->where($db->quoteName('g.alias').'NOT IN ("about","contact") ')
		->where($db->quoteName('g.alias') . ' LIKE "%article%"')
		->where($db->quoteName('c.state').'= "1" OR '.$db->quoteName('c.state').'= "0"')
		->setLimit($limit,$offset);
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}

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
		->select($db->quoteName(array('id', 'title', 'content')))
		->from($db->quoteName('#__modules'))
		->where($db->quoteName('id') . ' = '. $db->quote($id));
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}

function save_data($data,$tbl_name) {
	$db = JFactory::getDBO();
   	$db->insertObject($tbl_name, $data);
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
		->select($db->quoteName(array('id', 'title', 'published')))
		->from($db->quoteName('#__modules'))
		->where($db->quoteName('published').'IN ("1","0") ')
		->where($db->quoteName('module') . '= "mod_custom" ')
		
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
		->where($db->quoteName('password') . '= "'.$password.'" ');
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
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('*')
		->from('#__sub_navigation')
		->where($db->quoteName('menu_id') . '= "'.$id.'" ')
		->order($db->quoteName('ordering') . ' ASC');
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
		->select($db->quoteName(array('id', 'title')))
		->from($db->quoteName('#__categories'))
		->where($db->quoteName('extension') . ' = "com_content"');
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}

function gethospital($limit,$offset){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select($db->quoteName(array( 'hospital_id', 'hospital_name', 'description','is_active')))
		->from($db->quoteName('#__maps_hospital'))
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
		->select($db->quoteName(array('id', 'video', 'title', 'description', 'url', 'state')))
		->from($db->quoteName('#__video_gallery'))
		->where($db->quoteName('state').'= "1" OR '.$db->quoteName('state').'= "0"')

		->setLimit($limit,$offset);
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}

function get_video_gallery($id){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select($db->quoteName(array('id', 'video', 'title', 'description', 'url', 'state')))
		->from($db->quoteName('#__video_gallery'))
		->where($db->quoteName('id') . ' = '. $db->quote($id))
		->where($db->quoteName('state').'= "1" OR '.$db->quoteName('state').'= "0"');	
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
		->select($db->quoteName(array( 'hospital_id', 'hospital_name', 'description','is_active', 'latlng','address', 'longitude', 'latitude')))
		->from($db->quoteName('#__maps_hospital'))
		->where($db->quoteName('hospital_id') . ' = '. $db->quote($id));
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

function exportreport(){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('*')
		->from($db->quoteName('#__maps_user_old'));
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}

 ?>
