<?php 

         define( '_JEXEC', 1 ); 
         define( 'JPATH_BASE', realpath(dirname(__FILE__).'/../..' )); // print this out or observe errors to see which directory you should be in (this is two subfolders in) 
         define( 'DS', DIRECTORY_SEPARATOR ); 
  
         require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' ); 
         require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' ); 
         require_once ( JPATH_CONFIGURATION   .DS.'configuration.php' ); 
         require_once ( JPATH_LIBRARIES .DS.'joomla'.DS.'database'.DS.'database.php' ); 
         require_once ( JPATH_LIBRARIES .DS.'import.php' ); 
  
         //DB Connection 
         $Config = new JConfig(); 
         $db_driver      = $Config->dbtype;   // Database driver name 
         $db_host        = $Config->host;     // Database host name 
         $db_user        = $Config->user;     // User for database authentication 
         $db_pass        = $Config->password; // Password for database authentication 
         $db_name        = $Config->db;       // Database name 
         $db_prefix      = $Config->dbprefix; // Database prefix (may be empty) 
 		 $db_prefix      = (trim($db_prefix)=="") ? "":$db_prefix; 
  
         $db_connect = mysql_connect($db_host,$db_user,$db_pass); 
         $db = mysql_select_db($db_name); 

         ?>