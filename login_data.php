<?php 
    include 'main/init.php';
	logged_in_redirect();
	if(empty($_POST)===false)
	{
		$username=$_POST['username'];
		$pass=$_POST['pass'];
		                                                          //user_name and password empty.
	    if(empty($username)===true || empty($pass)===true)
		{
			$errors[]="you need to enter username and password";
		}
		                                                          //user_name does not exists.
		else if(user_exists($username)===false)
		{
			$errors[]="user name can't find !!!!";
		}
		                                                         //user_name not active
		else if(user_active($username)===false)
		{
			$errors[]="first active your account";
		}
		                                  
		else
		{
			if(strlen($passs) > 20)
			{
				$error[]="password too long !!!!";
			}
			
			$login=login($username,$pass);
			if($login===false)
			   $errors[]="Invalid Username or Password";
			 else
			 {
				 
				 //user session start
				 $_SESSION['id']=$login;
				 header("location: index.php");
				exit(); 
			 }
			
		}
		 
	}
	include 'includes/overall/header.php'; 
	if(empty($errors) === false)
      {
	?>
	  <h2>Please Valid data input....</h2>
	<?php
	echo output_errors($errors);
	  }
	include 'includes/overall/footer.php'; 	
?>