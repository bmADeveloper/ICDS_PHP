<?php
include("db_with_function/db_with_function.php");
$responseChangePassword = array();


    $email =$_POST["email"];
    $phone=$_POST["phone"];
    
     //$email="barun8m@gmail.com";
    //$address=" ";
    //$phone="9851303587";
    
     if(empty($email) || empty($phone))
     {
          $responseChangePassword["UpdateSuccess"]=true;
          $responseChangePassword["update"]="Required field.....!!!";
		  $responseChangePassword["check"]=1;
     }
     else if(update_field_exists( $email,$phone)===true)
     {
         $responseChangePassword["UpdateSuccess"]=true;
         $responseChangePassword["update"]="Phone number already exists....!!!";
		 $responseChangePassword["check"]=1;
     }
     
     else
     {
         if(update_field($email,$phone)===true)
         {
              $responseChangePassword["UpdateSuccess"]=true;
            $responseChangePassword["update"]="Updated Successfully....";
            $responseChangePassword["check"]=1;
         }
     }
  echo json_encode($responseChangePassword);
 

?>