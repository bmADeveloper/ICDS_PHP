<?php 
    session_start();
	require 'database/connect.php';
	require 'function/general.php';
	require 'function/users.php';
	require 'function/assignment_report_data_function.php';
	 
	if(logged_in()===true)
	{
		$session_user_id=$_SESSION['id'];
	    $user_data=user_data($session_user_id,'id','name','email','phone_number','address','dob','password','dpo_cdpo_code');
		
		if(user_active($user_data['email'])===false)
		{
			session_destroy();
		    header("Location:index.php");
			exit();
		}
	}
	$errors=array();
?>