<?php
      include("db_with_function/db_with_function.php");
    $responseChangePassword = array();
    $email =$_POST["email"];
    $current_password=$_POST["current_password"];
    $encry_current_password=md5($current_password);
    $confirm_password=$_POST["confirm_password"];
    $encry_confirm_password=md5($confirm_password);
   
    
	$new_password=$_POST["new_password"];
	
	
     
     if(empty($current_password) || empty($confirm_password))
     {
         
          $responseChangePassword["ChangePassSuccess"]=true;
          $responseChangePassword["changed"]="Field Required.........!!!! ";
		  $responseChangePassword["check"]=1;
     }
	 else if($new_password != $confirm_password)
	 {
		  $responseChangePassword["ChangePassSuccess"]=true;
          $responseChangePassword["changed"]="New password and Confirm password should be same...!!!! ";
		  $responseChangePassword["check"]=1;
	  }
     else if($current_password == $confirm_password)
     {
          $responseChangePassword["ChangePassSuccess"]=true;
          $responseChangePassword["changed"]="Current Password and New Password Should be different..!!!! ";
		  $responseChangePassword["check"]=1;
     }
     else if(chek_email_current_pass_exists( $email,$encry_current_password)===false)
     {
          $responseChangePassword["ChangePassSuccess"]=true;
          $responseChangePassword["changed"]="Invalid Current Password..!!!! ";
		  $responseChangePassword["check"]=1;
     }
	 
     else
     {       //...............Update Password
         if(change_current_pass($encry_confirm_password,$email,$encry_current_password)===true)
         {
              $responseChangePassword["ChangePassSuccess"]=true;
            $responseChangePassword["changed"]="Password has changed successfully....";
            $responseChangePassword["check"]=1;
         }
    }
     
  echo json_encode($responseChangePassword);
?>