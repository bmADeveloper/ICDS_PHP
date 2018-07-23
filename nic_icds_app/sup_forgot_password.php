<?php
    include("db_with_function/db_with_function.php");
    include_once('rand_string.php');//already create rand method 
    
    $forgotp=rand_string(8);
    $encry_forgot_pass=md5($forgotp);
    $phone =$_POST["mobile"];
    //$phone="9434985287";
     $response = array();
    
    
    if(empty($phone))
    {
         $response["success"]=true;
         $response["forgoted"]="Field require..!!!"; 
    }
    else if(phone_chek($phone)===false)  //already creat method in sugnup activity
    {
         $response["success"]=true;
         $response["forgoted"]="Mobile number not found please enter register mobile number....";
    } 
    else
    {
            $arr=array();
            $arr=collect_name_from_supervisor($phone);
            $name=$arr['name'];
              
          // if(send_email_forgot_password($phone,$name,$forgot_pass_email)===true)
           //{
               if(update_forgot_pass($encry_forgot_pass,$phone)===true)
               {
				   
    
				  $ph_num=$phone;
				   $code=$forgotp;
				   include_once("otp.php");
				   
				   
				    
				   
				   
				   
				   
				   
                    $response["success"]=true;
                    $response["forgoted"]="Check your mobile for new password....".$name;
                    $response["check"]=1;
				    
               }
          // }
    } 
       
  echo json_encode($response);
?>