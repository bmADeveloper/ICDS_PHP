<?php
include 'main/init.php';
logged_in_redirect();
include 'includes/overall/header.php';  

if(isset($_GET['success'])===true && empty($_GET['success'])===true)
{
	?><h2>Thanks we have activated your account...</h2>
	  <p>login permission granted</p><?php
}
 else if(isset($_GET['email'] , $_GET['email_code'])===true)
{
  $email       = trim($_GET['email']);
  $email_code  = trim($_GET['email_code']);
  if(email_exists($email)===false)
  {
	  $errors[]="opps!!somthing wrong,could not find your email address!!!";
  }
  else if(activate($email,$email_code)===false)
  {
	 $errors[]="some problem activation your account !!!"; 
  }
  if(empty($errors) === false)
  {
	  ?><h2>Opps....</h2><?php
	  echo output_errors($errors);
  }
  else
  {
	  header("Location: activate.php?success");
	  exit();
  }
}
else
{
	header("Location: index.php");
	exit();
} 
include 'includes/overall/footer.php'  
?>    