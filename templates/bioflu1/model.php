<?php require_once dirname(__FILE__) . '/config.php';

function get_data_model( $table, $order_by){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('*')
		->from($db->quoteName('#__'.$table))
		->where($db->quoteName('state').'= "1"')
		//->where($db->quoteName('state').'= "1" OR '.$db->quoteName('state').'= "0"')
		->order($order_by,'DESC');
		
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}



function getlist_global_model($limit,$offset, $table, $order_by){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('*')
		->from($db->quoteName('#__'.$table))
		->where($db->quoteName('state').'= "1"')
		->order($order_by,'DESC')
		->setLimit($limit,$offset);
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}

function get_list_articles_model($limit,$offset, $table, $order_by, $articles){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('*')
		->from($db->quoteName('#__'.$table))
		->where($db->quoteName('cat_type').'=' . $db->quote($articles))
		->where($db->quoteName('state').'= "1" OR '.$db->quoteName('state').'= "0"')
		//->where($db->quoteName('type') . ' = '. $db->quote($articles))
		->order($order_by,'DESC')
		->setLimit($limit,$offset);
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}


function get_list_articles_filter_model($limit,$offset, $table, $order_by, $articles, $year){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('*')
		->from($db->quoteName('#__'.$table))
		->where($db->quoteName('cat_type').'=' . $db->quote($articles))
		->where('YEAR('.$db->quoteName('date_published') . ') = '. $db->quote($year), 'AND'.$db->quoteName('state').'= "1"')
		//->where('MONTH('.$db->quoteName('date_published') . ') = '. $db->quote($month), 'AND')
		->order($order_by,'DESC')
		->setLimit($limit,$offset);
	$db->setQuery($query);
	$results = $db->loadObjectList();
	return $results;
}


function get_limit(){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('limit_archive')
		->from($db->quoteName('#__flunews_archive'));
	$db->setQuery($query);
	$results = $db->loadResult();
	return $results;
}


function get_limit_id($offset, $articles){
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
		->select('id')
		->from($db->quoteName('#__flunew_articles'))
		->where($db->quoteName('cat_type').'=' . $db->quote($articles))
		->where($db->quoteName('state').'= "1" OR '.$db->quoteName('state').'= "0"')
		->order('id','ASC')
		->setLimit('1',$offset);
	$db->setQuery($query);
	$results = $db->loadResult();
	return $results;
}

 function add_count_model($id) {
 		$db = JFactory::getDbo();
		$sql = "UPDATE bio_flunew_articles SET hits = hits + 1 where id = '".$id."'";
		$db->setQuery($sql);  
		$db->execute();
	}


function get_serach_data_model($flu_one, $flu_two){
	$db = JFactory::getDbo();
    $sql = "SELECT image FROM bio_pag2flu_combination where state = 1 and flu_one = '".$flu_one."' and flu_two = '".$flu_two."' or flu_one = '".$flu_one."' and flu_two = '".$flu_two."'";
    $db->setQuery($sql);  
    $results = $db->loadResult();
    return $results;
}


?>