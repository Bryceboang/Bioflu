<?php require_once dirname(__FILE__) . '/config.php';


function getBanner(){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('*')
		->from($db->quoteName('#__banner'))
		->where($db->quoteName('state').' = '.$db->quote('1'))
		// ->where($db->quoteName('banner_position').' = '. $db->quote($uri))
		->order('banner_id ASC');
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}

// function getlimitarchives(){
// 	$db = JFactory::getDbo();
// 	$query = $db->getQuery(true);
// 	$query
// 		->select('limit_archive')
// 		->from($db->quoteName('#__flunews_archive'));
// 		// ->where($db->quoteName('limit').' = '.$db->quote('1'))
// 		// ->where($db->quoteName('banner_position').' = '. $db->quote($uri))
// 	$db->setQuery($query);
// 	$results = $db->loadObjectList();
// 	return $results;
// }

?>