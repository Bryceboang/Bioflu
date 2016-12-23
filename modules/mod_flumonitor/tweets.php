<?php  
	include './modules/mod_flumonitor/hashtag/twitteroauth.php';
	include './modules/mod_flumonitor/config2.php';
	
	$x = '';
	$tweet_reports = array();
	$db    = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query
	    ->select('alias')
	    ->from($db->quoteName('#__flu_symptoms'))
	    ->where($db->quoteName('type').'="filipino"');
	$db->setQuery($query);

	try
	{
		$result = $db->loadObjectList();
		$b = array();
		foreach ($result as $key => $row) {
			$a = $row->alias;
			 array_push($b, $a);
		}
		foreach ($b as $key => $val) {
			$x .= '"'.$val.'"'."+OR+";
		}
		$symptoms_a = rtrim($x,"+OR+");
	}
	catch (RuntimeException $e)
	{
		JError::raiseWarning(500, $e->getMessage());
	}
	// twitter reports
	
	$db    = JFactory::getDbo();
	$query = $db->getQuery(true);
	//BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() order by date_generated asc
	$query
	    ->select('*')
	    ->from($db->quoteName('#__twitter_reports'))
	    ->where('('.$db->quoteName('latitude').'!= "" OR'.$db->quoteName('longitude').'!= "" OR'. $db->quoteName('address').'!=""'.')')
	    ->where($db->quoteName('date_generated').' BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()')
	    ->where('('.$db->quoteName('latitude').'!="X" OR'.$db->quoteName('longitude').'!= "X"'.')');
	$db->setQuery($query);
	try
	{

		$result = $db->loadAssocList();
		foreach ($result as $key => $value) 
		{
			$lat = $value['latitude'];
			$long = $value['longitude'];
			$address = $value['address'];
			$count = 0;
			$date = strtotime($value['date']);

			$arrs = json_encode(array('id_str'=>$value['sn'],'text' => $value['tweets'], 'name'=> $value['username'], 'geometry'=>'','latitude'=>$lat, 'longitude'=>$long,'data'=>$value['date_generated']));
			$tweet_reports[$key] = $arrs;
		}
		
	}
	catch (RuntimeException $e)
	{
		JError::raiseWarning(500, $e->getMessage());
	}
	// Initialiase variables.
	$db    = JFactory::getDbo();
	$query = $db->getQuery(true);

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
	// $tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q='.$symptoms_a.'&count=100&result_type=recent');
	$tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q='.$symptoms_a.'&count=100&result_type=recent');
	// print_r($tweets);
	@$arr_tweets = (array)$tweets->statuses;
	$tweet_data = array();
	$twitter_array_data = array();
	$tweet_meta;
	$fetchSuccess = false;
	$i = 1;
	$user_count = 0;
	if($arr_tweets != NULL){
		foreach ($tweets->statuses as $key => $value) {
			if($value->geo!=null){
				$data = check_tweet($value->id_str);
				if(count($data)==0){
					$arrs = json_encode(array('id_str'=>$value->id_str,'text' => $value->text, 'name'=> $value->user->name, 'geometry'=> $value->geo, 'latitude'=>'', 'longitude'=>''));
					 $tweet_data[$user_count] =$arrs;
					 $user_count++;
				}
			}
		}
	}
	function check_tweet($id){
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
		    ->select('*')
		    ->from($db->quoteName('#__twitter_reports'))
		    ->where($db->quoteName('sn').'='.$id);
		$db->setQuery($query);
		$result = $db->loadAssocList();
		return $result;
	}
	function getLatLng($address)
	{
		$prepAddr = str_replace(' ','+',$address);
		$geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?key=AIzaSyCAp0rfvNXFlin9qgVY8Pw3rRqOFxXy-fk&address='.$prepAddr.'&sensor=false');
		$output= json_decode($geocode);
		return $output;
	}
	
	
?>