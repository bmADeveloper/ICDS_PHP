<?php
require_once("class/class.phpmailer.php");
function smtpmailer($to, $from_email,$FormName,$from_email_password, $subject, $body) { 
	global $error;
$mail = new PHPMailer;

$mail->SMTPDebug = 0;                               // Enable verbose debug output

$mail->isSMTP(); 

$EmailDomain          = explode("@",$from_email);
$SmtpHost             = "mail.".$EmailDomain[1];

                                     // Set mailer to use SMTP
$mail->Host = $SmtpHost;  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = $from_email;                 // SMTP username
$mail->Password = $from_email_password;                           // SMTP password
//$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 25;                                    // TCP port to connect to

$mail->From = $from_email;
$mail->FromName = $FormName;
$mail->addAddress($to);     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC($cc);
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment($files);         // Add attachments
/*$mail->addAttachment($files1); */        // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $subject;
$mail->Body    = $body;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo;
		return $error;
	} else {
		$error = 'Your message has been successfully submited';
		return $error;
	}

}
?>