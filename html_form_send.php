<?php

if(isset($_POST['email'])) {
	
	// CHANGE THE TWO LINES BELOW
	$email_to = "hotel_sveti_stefan@yahoo.com";
	
	$email_subject = "Порака од контакт форма";
	
	
	function died($error) {
		// your error code can go here
		echo "We're sorry, but there's errors found with the form you submitted.<br /><br />";
		echo $error."<br /><br />";
		echo "Please go back and fix these errors.<br /><br />";
		die();
	}
	
	// validation expected data exists
	if(!isset($_POST['first_name']) ||
		!isset($_POST['email']) ||
		!isset($_POST['telephone']) ||
		!isset($_POST['comments'])) {
		died('Се извинуваме, има проблем со пораката која се обидувате да ја пратите.');		
	}
	
	$first_name = $_POST['first_name']; // required
	$email_from = $_POST['email']; // required
	$telephone = $_POST['telephone']; // not required
	$comments = $_POST['comments']; // required
	
	$error_message = "";
	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  // if(!preg_match($email_exp,$email_from)) {
  // 	$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  // }
	$string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$first_name)) {
  	$error_message .= 'Името кое го внесовте не е валидно.<br />';
  }
  if(strlen($comments) < 2) {
  	$error_message .= 'Пораката која ја внесовте не е валидна.<br />';
  }
  if(strlen($error_message) > 0) {
  	died($error_message);
  }
	$email_message = "Содржина на пораката.\n\n";
	
	function clean_string($string) {
	  $bad = array("content-type","bcc:","to:","cc:","href");
	  return str_replace($bad,"",$string);
	}
	
	$email_message .= "Име: ".clean_string($first_name)."\n";
	$email_message .= "E-маил ".clean_string($email_from)."\n";
	$email_message .= "Телефон: ".clean_string($telephone)."\n";
	$email_message .= "Порака: ".clean_string($comments)."\n";
	
	
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
<?php
}
header("Location: http://hotelsvetistefan.com.mk/index-4.html");
die();
?>