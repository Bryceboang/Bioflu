<?php require_once dirname(__FILE__) . '/config.php';

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


?>