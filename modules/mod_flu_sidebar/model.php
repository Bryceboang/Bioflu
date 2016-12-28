<?php require_once dirname(__FILE__) . '/config.php';

    function getprovince(){

    	 $db = JFactory::getDbo();
      $db->setQuery("SELECT province_name, province_id FROM bio_maps_province WHERE is_active = 1 ");
      return $db->loadObjectList();     

    }

     function getcity($province_id){

    	 $db         = JFactory::getDbo();
    	 $q = '';
    	 	 if (isset($province_id)) {
    	 	$q = " AND province_id = '".$province_id."' ";
    	 }

              $db->setQuery("SELECT territory_name, territory_id FROM bio_maps_territory WHERE is_active = 1 ".$q);

              return $db->loadObjectList();     

    }

    function getbarangay($city_id){

       $db         = JFactory::getDbo();
       $q = '';
         if (isset($city_id)) {
        $q = " AND territory_id = '".$city_id."' ";
       }

              $db->setQuery("SELECT barangay_name, barangay_id, barangay_geo FROM bio_maps_barangay WHERE is_active = 1 ".$q);

              return $db->loadObjectList();     

    }


    function insertdata($username, $email, $contact, $barangay_id, $number_of_symptoms){
    	$db         = JFactory::getDbo();

      $sql = mysql_query("SELECT barangay_geo FROM bio_maps_barangay WHERE is_active = 1  AND barangay_id = '".$barangay_id."'");

      while ($row = mysql_fetch_array($sql)) {
        $geo = $row['barangay_geo'];
      }

      $datecreated = date('Y-m-d');

    	mysql_query("INSERT INTO bio_maps_user_old (user_name, user_email, user_contact, barangay_id, date_created, flu_id)
    				 VALUES('$username', '$email', '$contact',  '$barangay_id' , '$datecreated', '$number_of_symptoms' )");
      echo mysql_insert_id();
    }


    function get_symptoms(){

       $db         = JFactory::getDbo();

              $db->setQuery("SELECT * FROM bio_flu_symptoms WHERE state = 1 ");

              return $db->loadObjectList();     

    }



function insertdata_symptoms($symptoms_id, $user_id){
      $db         = JFactory::getDbo();

      mysql_query("INSERT INTO bio_user_symptoms (user_symptoms_id, symptoms_id) VALUES ('$user_id', '$symptoms_id')");
      echo $symptoms_id;
    }

function check_mail($email){

       $db = JFactory::getDbo();
      $db->setQuery("SELECT * FROM bio_maps_user_old WHERE is_active = 1 AND user_email = '$email'");
      return $db->loadObjectList();     

    }

