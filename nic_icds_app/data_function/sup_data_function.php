<?php
    require"database_connection/db_connect.php";
    
//..........................................................SIGNUP FUNCTION.....................................................................


                                                  //...........Data exist or not in matste table......

    function sup_data_found_exists($name,$email,$dob,$ph_num)
    {
          global $con;
           $stmt = $con->prepare("select * from sup_details_master_table where sup_name=? and sup_email=? and sup_dob=? and sup_phone=?"); 
           $stmt->bind_param("ssss",$name,$email,$dob,$ph_num);
           $stmt->execute();
           $stmt->store_result();
           $count=$stmt->num_rows;
           return( $count>=1)? true:false;
           $stmt->close();
           $con->close();
    }
    
                                                  //.............collect centre_code and sup_code from Master Table........    
    function sup_data_collect($name,$email,$dob)
    {
         $arr=array();
          global $con;
           $stmt = $con->prepare("select sup_code from sup_details_master_table where sup_name=? and sup_email=? and sup_dob=?"); 
           $stmt->bind_param("sss",$name,$email,$dob);
           $stmt->execute();
           $stmt->store_result();
           $stmt->bind_result($arr['sup_code']);
           $stmt->fetch();
           $count=$stmt->num_rows;
           return($count>=1)? $arr:false;
           $stmt->close();
           $con->close();
    }
    
                                                    //..........Supercisor table check..............................
                                                    
											 function email_mobile_chek($email,$ph_num)
											{
												   global $con;
												   $stmt = $con->prepare("select * from supervisor where email=? and ph_number=?"); 
												   $stmt->bind_param("ss",$email,$ph_num);
												   $stmt->execute();
												   $stmt->store_result();
												   $count=$stmt->num_rows;
												   return( $count>=1)? true:false;    
												   $stmt->close();
												   $con->close();
											}
	
													   function phone_chek($phone)
													{
														   global $con;
														   $stmt = $con->prepare("select * from supervisor where ph_number=? "); 
														   $stmt->bind_param("s",$phone);
														   $stmt->execute();
														   $stmt->store_result();
														   $count=$stmt->num_rows;
														   return( $count>=1)? true:false;    
														   $stmt->close();
														   $con->close();
													}
    
    
    function sup_data_insert($sup_code,$name,$email,$dob,$gender,$ph_num,$encrypted_password,$code,$url_image)
    {
		 
           global $con;
		   
           $stmt = $con->prepare("insert into supervisor(sup_code,name,email,date_of_birth,gender,ph_number,password,verify_code,photo)values(?,?,?,?,?,?,?,?,?)"); 
           $stmt->bind_param("sssssssss",$sup_code,$name,$email,$dob,$gender,$ph_num,$encrypted_password,$code,$url_image);
           $stmt->execute();
         // send_mail_verify_code($email,$name,$code)===true;
            return true;
           $stmt->close();
           $con->close();
    }
//..........................................END  SIGNUP FUNCTION..........................................................



//...................................................... VERIFIED FUNCTION............................................

function send_mail_verify_code($email,$name,$code)
{
            $to =$email;
          /* 
		  $subject ="Your E-mail Verify Code....";
            $header = "Hello,$name";
            $message = "Your E-mail verify code is ::  $code \t one time verify code for login purpose.\n ";
            $message .= "after verification login permission granted....";
            mail($to,$subject,$message,$header);
	    */
	
	
	//.............................................................
    
          require_once($_SERVER['DOCUMENT_ROOT']."/SMTP/sendMail.php");
  
       $body = "Hello ".$name . " <br><br> Your E-mail verify code is ::  $code   One Time Password (OTP) for login purpose. <br><br> after verification login permission granted.... -MTMICDS,Jalpaiguri";
         smtpmailer($to,"dpo@icdsjalpaiguri.in","icdsjalpaiguri.in","Icds@jal18", "email verification", $body);   
        
	  //...........................................................
      
	
	
            return true;
	
	
	
}
                      
                      
                      //...............Email code check.........................
                      
function check_email_veri_code_exists($email, $verify_code)
{
         global $con;
         $stmt=$con->prepare("select email,verify_code from supervisor where email=? AND verify_code=?"); 
         $stmt->bind_param("ss",$email, $verify_code);
         $stmt->execute();
         $stmt->store_result();
         $count = $stmt->num_rows;
         return($count >=1)? true:false;
         $stmt->close();
}

                    //....................active flag 1.........................

function verify_email($email, $verify_code)
{
         global $con;
         $stmt=$con->prepare("update supervisor set active='1' where email=? AND verify_code=?"); 
         $stmt->bind_param("ss",$email, $verify_code);
         $stmt->execute();
         return true;
         $stmt->close();  
}
 

//.............................................END VERIFIED FUNCTIO.............................................


//.......................................CHANGE PASSWORD FUNCTION................................................................

function chek_email_current_pass_exists( $email,$encry_current_password)
{ 
           global $con;
           $stmt = $con->prepare("select * from supervisor where email=? and password=? "); 
           $stmt->bind_param("ss", $email,$encry_current_password);
           $stmt->execute();
           $stmt->store_result();
           $count=$stmt->num_rows;
           return($count >=1)? true:false;
           $stmt->close();
}


function change_current_pass($encry_confirm_password,$email,$encry_current_password)
{
        global $con;
        $stmt =$con->prepare("update supervisor set password=? where email=? and password=? "); 
        $stmt->bind_param("sss",$encry_confirm_password,$email,$encry_current_password);
        $stmt->execute();
        return true;
        $stmt->close();
}

//..........................................END CHANGE PASSWORD FUNCTION.............................................

//......................................UPDATE PROFILE FUNCTION............................................
  
function collect_sup_code_from_supervisor_table($email)   //take sup_code from supervisor  UNUSED
{
    $ar=array();
    global $con;
    $stmt=$con->prepare("select sup_code from supervisor where email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($ar['sup_code']);
    $stmt->fetch();
    $count=$stmt->num_rows;
    return($count >= 1)? $ar:false;
    $stmt->close();
    
}
function collect_sup_all_details_from_mastertable($sup_code)     //take address,phone number so on from master table UNSUED
{
    $arr_sup_details=array();
    global $con;
    $stmt=$con->prepare("select sup_address,sup_phone from sup_details_master_table where sup_code=?");
    $stmt->bind_param("s",$sup_code);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($arr_sup_details['sup_address'],$arr_sup_details['sup_phone']);
    $stmt->fetch();
    $count=$stmt->num_rows;
    return($count >= 1)? $arr_sup_details:false;
    $stmt->close();
}


function update_field_exists($email,$phone)  //update field phone number exists or not
{
           global $con;
           $stmt = $con->prepare("select name from supervisor where email=? and ph_number=? "); 
           $stmt->bind_param("ss", $email,$phone);
           $stmt->execute();
           $stmt->store_result();
           $stmt->bind_result($name);
           $stmt->fetch();
           $count=$stmt->num_rows;
           return($count >= 1)? true:false;
           $stmt->close();
}
function update_field($email,$phone)  //update field phone number
{
           global $con;
           $stmt = $con->prepare("update supervisor set ph_number=? where email=?"); 
           $stmt->bind_param("ss",$phone,$email);
           $stmt->execute();
           return true;
}
//....................................................END UPDATE PROFILE FUNCTION........................................

//...........................................FORGOT PASWORD FUNCTION.........................

						function collect_name_from_supervisor($phone)
						{
								   $arr=array();
								   global $con;
								   $stmt = $con->prepare("select name from supervisor where ph_number=?"); 
								   $stmt->bind_param("s",$phone);
								   $stmt->execute();
								   $stmt->store_result();
								   $stmt->bind_result($arr['name']);
								   $stmt->fetch();
								   $count=$stmt->num_rows;
								   return( $count>=1)? $arr:false;    
								   $stmt->close();
								   $con->close();
						}
function send_email_forgot_password($phone,$name,$forgot_pass_email)
{
			/*
			$to =$email;
			$subject ="your recovery  passowrd....";
			$header = "Hello,$name";
			$message = "Your recovery password is ::  $forgot_pass_email \t temporary grnerate password.\n ";
			$message .= "after login change temporary password....";
			mail($to,$subject,$message,$header);
			return true;
	*/
		
		
}
 



					function update_forgot_pass($encry_forgot_pass,$phone)
					{ 
							   global $con;
							   $stmt = $con->prepare("update supervisor set password=? where ph_number=?"); 
							   $stmt->bind_param("ss",$encry_forgot_pass,$phone);
							   $stmt->execute();
							   return true;
							   $stmt->close();
					}
 

//....................................................................END FORGOT PASWORD FUNCTION................................................................
 


?>