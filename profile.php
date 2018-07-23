<?php
include 'main/init.php';
include 'includes/overall/header.php';  
if(isset($_GET['username'])===true && empty($_GET['username'])===false)
{
	$username=$_GET['username'];
	echo $username;
}
else
{
  header("Location: index.php");
  exit();
}
 
include 'includes/overall/footer.php'  ?>    