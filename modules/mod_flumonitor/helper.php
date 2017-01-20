<?php

class ModProfile
{
   
    public static function getinfo($params){
        if (isset($_SESSION['user_id'])){ 
              $id = $_SESSION['user_id'];
              $db         = JFactory::getDbo();
              $db->setQuery("SELECT name, firstname, middlename, lastname, email, username, contactnumber, mailingaddress FROM enp_users WHERE id = '".$id."'");
              return $db->loadObjectList(); 
             }
    }

      public static function logout($params){
      if (isset($_POST['logout'])){
            session_destroy();
            header('location:enervon-prime-registration');
        } 
    }


    public static function uploadimage($params){
      if(isset($_FILES['files'])){
          $errors= array();

        foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
          $file_name = $key.$_FILES['files']['name'][$key];
          $originalfilename = $_FILES['files']['name'][$key];
          $file_size =$_FILES['files']['size'][$key];
          $file_tmp =$_FILES['files']['tmp_name'][$key];
          $file_type=$_FILES['files']['type'][$key];  
              if($file_size > 1097152){
            $errors='File size must be less than 2 MB';
              return 'failed';
              }   

          if($file_type != 'image/jpeg' && $file_type != 'image/png'  && $file_type != 'image/gif' && $file_type != 'image/bmp' && $file_type != 'image/psd' && $file_type != 'image/tif'){
            $errors='Unsupported filetype uploaded';
              return 'unsupported';
            }

   if (isset($_SESSION['user_id'])){ 
             
               $userid = $_SESSION['user_id'];
              
               
             }

             $timefile = time().$file_name;

              $query="INSERT into enp_uploads (user_id, filename , filesize,  filetype, types, originalfilename) VALUES('$userid','$timefile','$file_size','$file_type','image','$originalfilename'); ";
            
              $desired_dir="images/or/";
              if(empty($errors)==true){
                  if(is_dir($desired_dir)==false){
                      mkdir("$desired_dir", 0700);    // Create directory if it does not exist
                  }
                  if(is_dir("$desired_dir/".$file_name)==false){
                      move_uploaded_file($file_tmp,"images/or/".$timefile);
                  }else{                  //rename the file if another one exist
                      $new_dir="images/or/".$file_name.time();
                       rename($file_tmp,$new_dir) ;       
                  }
                  mysql_query($query);      
              }else{
                     
              }
          }
        if(empty($error)){
          return 'success';
        }
      }
   }



public static function uploadimageedit($params){
      if(isset($_FILES['filesedit'])){
          $errors= array();

        foreach($_FILES['filesedit']['tmp_name'] as $key => $tmp_name ){
          $file_name = $key.$_FILES['filesedit']['name'][$key];
          $originalfilename = $_FILES['filesedit']['name'][$key];
          $file_size =$_FILES['filesedit']['size'][$key];
          $file_tmp =$_FILES['filesedit']['tmp_name'][$key];
          $file_type=$_FILES['filesedit']['type'][$key];  
              if($file_size > 2097152){
            $errors='File size must be less than 2 MB';
              return 'failed';
              }   

          if($file_type != 'image/jpeg' && $file_type != 'image/png'  && $file_type != 'image/gif' && $file_type != 'image/bmp' && $file_type != 'image/psd' && $file_type != 'image/tif'){
            $errors='Unsupported filetype uploaded';
              echo  'unsupported';
            }else{

   if (isset($_SESSION['user_id'])){ 

               $userid = $_SESSION['user_id'];
              
               
             }

             $timefile = time().$file_name;

              // $query="INSERT into enp_uploads (user_id, filename , filesize,  filetype, types, originalfilename) VALUES('$userid','$timefile','$file_size','$file_type','image','$originalfilename'); ";
              
              $query = "UPDATE  enp_uploads SET user_id = '$userid', filename = '$timefile', filesize = '$file_size', filetype = '$file_type', types = 'image', originalfilename = '$originalfilename' 
                        WHERE user_id = '".$userid."' AND id = '".$_POST['imagidedit']."'
                        ";
                       echo "success";
                        header('location:profile');

                      }

              $desired_dir="images/or/";
              if(empty($errors)==true){
                  if(is_dir($desired_dir)==false){
                      mkdir("$desired_dir", 0700);    // Create directory if it does not exist
                  }
                  if(is_dir("$desired_dir/".$file_name)==false){
                      move_uploaded_file($file_tmp,"images/or/".$timefile);
                  }else{                  //rename the file if another one exist
                      $new_dir="images/or/".$file_name.time();
                       rename($file_tmp,$new_dir) ;       
                  }
                  mysql_query($query);      
              }else{
                     
              }
          }
        if(empty($error)){
          return 'success';
        }
      }
   }

   public static function uploadvideoedit($params){
      if(isset($_FILES['filesvideoedit'])){
          $errors= array();

        foreach($_FILES['filesvideoedit']['tmp_name'] as $key => $tmp_name ){
          $file_name = $key.$_FILES['filesvideoedit']['name'][$key];
          $originalfilename = $_FILES['filesvideoedit']['name'][$key];
          $file_size =$_FILES['filesvideoedit']['size'][$key];
          $file_tmp =$_FILES['filesvideoedit']['tmp_name'][$key];
          $file_type=$_FILES['filesvideoedit']['type'][$key];  
              if($file_size > 5097152){
            $errors='File size must be less than 2 MB';
              return 'failed';
              }   

          // if($file_type != 'image/mp4' && $file_type != 'image/png'  && $file_type != 'image/gif' && $file_type != 'image/bmp' && $file_type != 'image/psd' && $file_type != 'image/tif'){
          //   $errors='Unsupported filetype uploaded';
          //     echo  'unsupported';
          //   }else{

   if (isset($_SESSION['user_id'])){ 
    
               $userid = $_SESSION['user_id'];
              
               
             }

             $timefile = time().$file_name;

              // $query="INSERT into enp_uploads (user_id, filename , filesize,  filetype, types, originalfilename) VALUES('$userid','$timefile','$file_size','$file_type','image','$originalfilename'); ";
              
              $query = "UPDATE  enp_uploads SET user_id = '$userid', filename = '$timefile', filesize = '$file_size', filetype = '$file_type', types = 'video', originalfilename = '$originalfilename' 
                        WHERE user_id = '".$userid."' AND id = '".$_POST['videoidedit']."'
                        ";

                        header('location:profile');

                      //}

              $desired_dir="images/or/";
              if(empty($errors)==true){
                  if(is_dir($desired_dir)==false){
                      mkdir("$desired_dir", 0700);    // Create directory if it does not exist
                  }
                  if(is_dir("$desired_dir/".$file_name)==false){
                      move_uploaded_file($file_tmp,"images/or/".$timefile);
                  }else{                  //rename the file if another one exist
                      $new_dir="images/or/".$file_name.time();
                       rename($file_tmp,$new_dir) ;       
                  }
                  mysql_query($query);      
              }else{
                     
              }
          }
        if(empty($error)){
          return 'success';
        }
      }
   }





   public static function uploadvideo($params){
      if(isset($_FILES['filesvideo'])){
          $errors= array();

        foreach($_FILES['filesvideo']['tmp_name'] as $key => $tmp_name ){
          $file_name = $key.$_FILES['filesvideo']['name'][$key];
          $originalfilename = $_FILES['filesvideo']['name'][$key];
          $file_size =$_FILES['filesvideo']['size'][$key];
          $file_tmp =$_FILES['filesvideo']['tmp_name'][$key];
          $file_type=$_FILES['filesvideo']['type'][$key];  
              if($file_size > 20097152){
            $errors[]='File size must be less than 2 MB';
              }   

           if (isset($_SESSION['user_id'])){ 

               $userid =$_SESSION['user_id'];
     
               
             }

             $timefile = time().$file_name;

              $query="INSERT into enp_uploads (user_id, filename , filesize,  filetype, types, originalfilename) VALUES('$userid','$timefile','$file_size','$file_type', 'video', '$originalfilename'); ";
            
              $desired_dir="images/video/";
              if(empty($errors)==true){
                  if(is_dir($desired_dir)==false){
                      mkdir("$desired_dir", 0700);    // Create directory if it does not exist
                  }
                  if(is_dir("$desired_dir/".$file_name)==false){
                      move_uploaded_file($file_tmp,"images/video/".$timefile);
                  }else{                  //rename the file if another one exist
                      $new_dir="images/video/".$file_name.time();
                       rename($file_tmp,$new_dir) ;       
                  }
                  mysql_query($query);      
              }else{
                      print_r($errors);
              }
          }
        if(empty($error)){
          return 'success';
        }
      }
   }

public static function getimg(){

      if (isset($_SESSION['user_id'])){ 

                if (isset($_SESSION['user_id'])){ 
      
               $userid = $_SESSION['user_id'];
              
               
             }
              $db         = JFactory::getDbo();
              $db->setQuery("SELECT filename, user_id, id , originalfilename FROM enp_uploads WHERE types = 'image' and user_id = '".$userid."'");
              return $db->loadObjectList(); 
             }

}

public static function getvideo(){

      if (isset($_SESSION['user_id'])){ 
                if (isset($_SESSION['user_id'])){ 
       
               $userid = $_SESSION['user_id'];
              
               
             }
              $db         = JFactory::getDbo();
              $db->setQuery("SELECT filename, user_id, id , originalfilename FROM enp_uploads WHERE types = 'video' and user_id = '".$userid."'");
              return $db->loadObjectList(); 
             }

}

}