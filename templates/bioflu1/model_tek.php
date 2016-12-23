<?php require_once dirname(__FILE__) . '/config.php';

function getHomeVideo(){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('*')
		->from($db->quoteName('#__video'))
		->where($db->quoteName('status').'= "1"')
		->where($db->quoteName('is_featured').'= 1');
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}

function getProducts_info(){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('*')
		->from($db->quoteName('#__productpage'));
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}

function getArticle($alias){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('*')
		->from($db->quoteName('#__flunew_articles'))
		->where($db->quoteName('article_title').' = '.$db->quote($alias));	
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}

function getrelatedArticles($tags,$limit){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('*')
		->from($db->quoteName('#__flunew_articles'))
		->where($db->quoteName('tags').' LIKE '.$db->quote('%'.$tags.'%'))
		->order('rand()')
		->setLimit($limit);	
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}

function save_data($data,$tbl_name) {	
		$db = JFactory::getDBO();	   	
	   	$db->insertObject($tbl_name, $data);
	   	return $db->insertid();
	}

function getcomment($is_parent,$comment_id,$id,$sort) {
	$db = JFactory::getDbo();

	if($is_parent==1){
		$order = $sort;
	}
	else{
		$order = "ASC";
	}
	$query = $db->getQuery(true);	
	$query
		->select('id,comment_id,comment,article_id,fb_id,fb_name,fb_photo,DATE_FORMAT(date_time,"%d %b %Y %h:%i") as date,like_count')	
		->from($db->quoteName('#__article_comments'))	
		->where($db->quoteName('comment_id') . ' = '. $db->quote($comment_id))
		->where($db->quoteName('article_id') . ' = '. $db->quote($id))
		->where($db->quoteName('is_parent') . ' = '. $db->quote($is_parent))
		->where($db->quoteName('is_active') . ' = "1"')	
		->order($db->quoteName('id') . $order);	
	$db->setQuery($query);	
	$results = $db->loadObjectList();	
	return $results;
}

function update_data($data,$tbl_name, $id){
	$db = JFactory::getDBO();
   	$db->updateObject($tbl_name, $data, $id);
}

function checkLikeStatus($id,$com_id){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('*')
		->from($db->quoteName('#__like_comments'))
		->where($db->quoteName('fb_id').' = '.$db->quote($id))
		->where($db->quoteName('comment_id').' = '.$db->quote($com_id));	
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}
function deletelike($fb_id,$com_id){
	$db = JFactory::getDbo(); 
	$query = $db->getQuery(true); 
	$query->delete($db->quoteName('#__like_comments')) 
		->where($db->quoteName('fb_id') . '='.$db->quote($fb_id))
		->where($db->quoteName('comment_id') . '='.$db->quote($com_id));
	$db->setQuery($query); 
	$result = $db->query(); 
	return $results;
}

function get_search_result($search,$limit,$offset){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('*')
		->from($db->quoteName('#__flunew_articles'))
		->where($db->quoteName('article_title').' LIKE '.$db->quote('%'.$search.'%'),'OR')
		->where($db->quoteName('tags').' LIKE '.$db->quote('%'.$search.'%'),'OR')
		->where($db->quoteName('intro_text').' LIKE '.$db->quote('%'.$search.'%').' AND '.$db->quoteName('state').' = 1')
		->setLimit($limit,$offset);
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}

function get_articleLimit(){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('limit_archive')
		->from($db->quoteName('#__flunews_archive'));
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}

function get_article_List($cat,$limit,$offset){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('*')
		->from($db->quoteName('#__flunew_articles'))
		->where($db->quoteName('cat_type').'='.$db->quote($cat))
		->setLimit($limit,$offset);
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}

function getFluSymptoms($limit){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('*')
		->from($db->quoteName('#__pag2flu_symptoms'))
		->setLimit($limit);
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}

function getWidget(){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('*')
		->from($db->quoteName('#__widgets'))
		->where($db->quoteName('status').' = 1');
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}
?>