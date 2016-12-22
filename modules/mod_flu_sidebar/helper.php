<?php require_once dirname(__FILE__) . '/config.php';


if(!class_exists("ModProfile"))
{


class ModProfile

{

   

    function getprovince(){

    	 $db         = JFactory::getDbo();

              $db->setQuery("SELECT province_name, province_id FROM bio_maps_province");

              return $db->loadObjectList();     

    }









 }

}