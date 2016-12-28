<?php require_once dirname(__FILE__) . '/../layout/config.php'; 

error_reporting(0);
include "/../phpmailer.php"; 
$db = JFactory::getDbo();
$query = $db->getQuery(true);
$query
->select('*')
->from($db->quoteName('#__contact_us'));  
$db->setQuery($query);
$results = $db->loadObjectList();
foreach ($results as $key => $row) {
define("SMTP_HOST", $row->smtp_host); 
define("SMTP_PORT", $row->smtp_port); 
define("SMTP_UNAME", $row->smtp_username); 
define("SMTP_PWORD", $row->smtp_password);
}


$db = JFactory::getDbo();
$query = $db->getQuery(true);
$query
->select('*')
->from($db->quoteName('#__users'))
->where($db->quoteName('email') . ' = '. $db->quote($_POST['email'])); 
$db->setQuery($query);
$results = $db->loadObjectList();
foreach ($results as $key => $row) {

$email = $row->email;
$mail   = new PHPMailer; 
$mail->IsSMTP(); 
$mail->Host = SMTP_HOST; 
$mail->Port = SMTP_PORT; 
$mail->SMTPAuth = true;
$mail->Username = SMTP_UNAME; 
$mail->Password = SMTP_PWORD;
$mail->AddReplyTo($email, "Reply name"); 
$mail->SetFrom($email, "UNILAB");    
$mail->Subject ="Reset Password";
$mail->AddAddress($email, $email); 
$fullname = $row->name;

$mail->MsgHTML("

<table style = 'border:1px solid #ccc; font-family: arial, verdana, sans-serif; width:80%; margin:0 auto' cellspacing='0' cellpadding='0'>

<tr>
<td style = 'padding:15px; background-color:#337ab7'>
<h2 style = 'color:#fff'> Content Management System</h2>
</td>
</tr>

<tr>
<td style = 'padding:15px;'>
Dear <b>". $fullname."</b> <br />
</td>
</tr>

<tr>
<td style = 'padding:15px;'>
You have requested to reset your password on ".date('Y-m-d h:i:s').".
</td>
</tr>

<tr>
<td style = 'padding:15px;'>
If you follow the link below you will be able to personally reset you password.
Click <a href = '".JURI::root()."../reset.php?access_token=".$row->password."'> here</a>.
</td>
</tr>

<tr>
<td style = 'padding:15px; '>
This password reset request is valid for the next 24 hours.
</td>
</tr>

</table>

");

// $mail->AddAttachment("images/asif18-logo.png"); 
$send = $mail->Send(); 
if($send){
echo 'success';
}
}

?>

