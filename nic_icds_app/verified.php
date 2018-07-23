<?php
    include("db_with_function/db_with_function.php");
    
    $email =$_POST["email"];
    $verify_code =$_POST["code"];
     
    
     $response = array();
     
     if(!empty($verify_code))
     {
         if(check_email_veri_code_exists($email, $verify_code)===false)
          {
              $response["success"]=true;
              $response["verified"]="Invali E-mail or verify_code(OTP)....";
          } 
         
          else
           {
               //Update..................
               if(verify_email($email, $verify_code)===true)
               {
                    $response["success"]=true;
                    $response["verified"]="Mobile Number and E-mail verification success....";
                    $response["ver"]=1;
               }
           }
     }
     else
     {
            $response["success"]=true;
            $response["verified"]="Field Required....!!!";
     }
     
       
  echo json_encode($response);
?>