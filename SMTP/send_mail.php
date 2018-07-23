<?php
require_once($_SERVER['DOCUMENT_ROOT']."/SMTP/sendMail.php");
$email = "wbjpg@nic.in";
$body = "Hello ";
smtpmailer($email,"dpo@icdsjalpaiguri.in","icdsjalpaiguri.in","Icds@jal18", "Test", $body);
?>