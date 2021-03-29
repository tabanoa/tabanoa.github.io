<?php
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$error = "";
$errorMessage = 'Sorry your message can not be sent.';

//Validate first
if(empty($name)||empty($email)||empty($message)) 
{
    echo "Name and email and message are required !";
    header('Location: index.html');
}
//validate against any email injection attempts
if(IsInjected($email))
{
    echo "Invalid email!";
    header('Location: index.html');
}


$msg =  " Name : $name \r\n"; 
$msg .= " Email: $email \r\n";
$msg .= " Message : ".stripslashes($_POST['message'])."\r\n\n";
$msg .= "User information \r\n"; 
$msg .= "User IP : ".$_SERVER["REMOTE_ADDR"]."\r\n"; 
$msg .= "Browser info : ".$_SERVER["HTTP_USER_AGENT"]."\r\n"; 
$msg .= "User come from : ".$_SERVER["SERVER_NAME"];

$recipient = "manjotsidhuu98@gmail.com";
$sujet =  "Sender information";
$mailheaders = "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n";

if (!$error){

		$sending = mail($recipient, $sujet, $msg, $mailheaders); 
		
		if ($sending) {
				echo "SENDING"; 
			} else {
				echo $errorMessage; 
			}
	} else {
		echo $error; 
	}

// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?>