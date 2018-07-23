<?php
include("db_with_function/db_with_function.php");
$response=array();
/*
    $name="Barun Mandal";
    $email="barun8m@gmail.com";
    $dob="4/4/2018";
    $password = "123456789";
    $image ="";
    $gender="male";
    $ph_num= "9434985287";
  */
$email =$_POST['email'];
$password =$_POST['password'];
$name =$_POST['name'];
$image =$_POST['photo'];
$dob =$_POST['dob'];
$gender =$_POST['gender'];
$ph_num =$_POST['phone_number'];

$encrypted_password = md5($password);

       include_once('rand_string.php');//already create rand method 
        $code=rand_string(6);
        
if($image!="no imagen")
{
			$path  = "profile_image/$name.jpg"; 
			$url_image = "profile_image/".$name.".jpg";// image aly allow jpeg files
			file_put_contents($path,base64_decode($image));
}
else
{
	$url_image = "empty";
}        

if(!empty($name) && !empty($email) && !empty($dob))
{
 //..............check supervisor exists or not..................................
    if(sup_data_found_exists($name,$email,$dob,$ph_num)===false)
    {
            //$response['success']=true;
            $response['error']="You are not allow to register contact admin...";
			echo json_encode($response);
    }
	
    else if(email_mobile_chek($email,$ph_num)===true)
    {
           
            $response['error']="Mobile number and E-mail already registered....";
			echo json_encode($response);
    }
    else
    {
        //....................data insert.......................................
        $a=array();
        $a=sup_data_collect($name,$email,$dob); 
         $sup_code=$a['sup_code'];
        // $centre_code=$a['centre_code'];
          if(sup_data_insert($sup_code,$name,$email,$dob,$gender,$ph_num,$encrypted_password,$code,$url_image)===true)
          {
             $response['success']='Registration successfull...'; 
			 echo json_encode($response);
			 
			 include_once("otp.php");
			 
          }
     }
	
	
        
}//end does not empty
else
{
    //$response['success']=true;
       $response['error']="field require....!!";
	   echo json_encode($response);
}
        
        
        
        
    




 
?>