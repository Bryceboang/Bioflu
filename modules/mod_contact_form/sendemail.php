<?php require_once dirname(__FILE__) . '/config.php'; 
include 'phpmailer.php';
$db = JFactory::getDbo();
$query = $db->getQuery(true);
$query
  ->select('*')
  ->from($db->quoteName('#__contact_us'));  
$db->setQuery($query);
$results = $db->loadObjectList();
foreach ($results as $key => $row) {
        define("SMTP_HOST", $row->smtp_host); //Hostname of the mail server
        define("SMTP_PORT", $row->smtp_port); //Port of the SMTP like to be 25, 80, 465 or 587
        define("SMTP_UNAME", $row->smtp_username); //Username for SMTP authentication any valid email created in your domain
        define("SMTP_PWORD", $row->smtp_password);
        $email = $row->mailrecipient;
 }
$fullname = $_POST['fullname'];
$emailadd = $_POST['emailaddress'];
$mail = new PHPMailer; // call the class 
$mail->IsSMTP(); 
$mail->SMTPDebug  = 2;
$mail->SMTPAuth   = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = SMTP_HOST; //Hostname of the mail server
$mail->Port = SMTP_PORT; //Port of the SMTP like to be 25, 80, 465 or 587
$mail->Username = SMTP_UNAME; //Username for SMTP authentication any valid email created in your domain
$mail->Password = SMTP_PWORD; //Password for SMTP authentication
$mail->AddReplyTo($emailadd, $fullname); //reply-to address
$mail->SetFrom($emailadd, $fullname);    
$mail->Subject = 'Inquiry: '.$_POST['subject'];
$mail->AddAddress($email, $email);         
$mail->MsgHTML("         
  <p>From: ".ucwords($fullname)."</p>
  <p>Inquiry type: ".ucwords($_POST['subject'])."</p>
  <p>Message: ".$_POST['message']."</p>
  ");

$send = $mail->Send(); 

if($send){
  echo 'success';
  }

?>

             