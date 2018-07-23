 
 <?php
include 'main/init.php';
logged_in_redirect();
include 'includes/overall/header.php';
 
if(empty($_POST) === false)
{
   $required_fields=array('name','email','phone_number','address','dob','password','confirm_password');	
   foreach($_POST as $key=>$value)
   {
	   if(empty($value) && in_array($key,$required_fields)===false)
	   {
	      $errors[]='Fields  marked with  *  are required';
           break 1;
	   }
   }
   if(empty($errors)===true)
   {
	   $name=$_POST['name'];
	   $email=$_POST['email'];
	   $dob=$_POST['dob'];
	   if(dpo_cdpo_exists($name,$email,$dob)===false)
	   {
		   $errors[]='sorry, dpo/cdpo data not found';  
	   }
	   if(user_exists($_POST['email'])===true)
	   {
		   $errors[]='sorry,the username\''.$_POST['email'].'\' is already used';
	   }
	   
	   if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)===false) 
	   {
		 $errors[]='invalid email address';   
	   }
		   
	   
	   if(strlen($_POST['password']) < 6)
	   {
		   $errors[]='minimum 6 char password require';
	   }
	   if($_POST['password']!=$_POST['confirm_password'])
	   {
		   $errors[]='password does not match';
	   }   
   }
  }
?>

<?php
if(isset($_GET['success']) ===true && empty($_GET['success']) ===true)
{	
 
	echo "you have been register successfully, please check your email active your account.";
	
	
}
else
{
	
	   
	
	if(empty($_POST)===false && empty($errors)===true)
	  {
		  $name=$_POST['name'];
	      $email=$_POST['email'];
	     $dob=$_POST['dob'];
	     $dpo_cdpo_code=dpo_cdpo_exists_code_fetch($name,$email,$dob);
		  
		  
		  $register_data=array(
			 'name'         => $_POST['name'],
			 'email'		=> $_POST['email'],
			 'phone_number' => $_POST['phone_number'],
			 'address'		=> $_POST['address'],
			 'dob'			=> $_POST['dob'],
			 'password'		=> $_POST['password'],
			 'email_code'   => md5($_POST['username'] + microtime()),
			 'dpo_cdpo_code'		=> $dpo_cdpo_code,
			);
		  register_user($register_data); 
		  header("Location:register.php?success");
		  exit();
	  }

/*		 
	 else if(empty($errors)===false)
     {
		echo output_errors($errors);
	 }  
*/
?>

 <script type="text/javascript" src="includes/validation/user_validation.js"></script>
  <link rel="stylesheet" href="css/tagstyle.css">
  
 <h1><font size="+3" color="#003366" face="MS Serif, New York, serif"><p align="center"><b>DPO/CDPO Registration Form</b></p></font></h1>
 

 <form name="fm" action="" method="post" onSubmit="valid_empty();">
     <table align="center">
     
        <tr>
           <td><font size="+1" color="#333333" face="MS Serif, New York, serif"><b>
                Name*
                </b></td>
           <td><input style="width:200px;
                            height:10px;
                            font-size:20px;
                            text-align:left;
                            color:#666;
                            border:0px solid #797979;
                            padding:10px;
                            border-radius:4px;
                            background-color:#F7F7F7"
                            name="name" type="text"   onchange="valid_name();" /></td>
        </tr>
        
        
        
        <tr>
           <td><font size="+1" color="#333333" face="MS Serif, New York, serif"><b>
                Email*
                </b></td>
           <td><input style="width:200px;
                            height:10px;
                            font-size:20px;
                            text-align:left;
                            border:0px solid #797979;
                            padding:10px;
                            border-radius:4px;
                            background-color:#F7F7F7"
                             name="email" type="text"  onchange="valid_email();" /></td>
        </tr>
        
        
        
        
        <tr>
           <td><font size="+1" color="#333333" face="MS Serif, New York, serif"><b> 
                      Phone Number*
            </b></td>
           <td><input style="width:200px;
                            height:10px;
                            font-size:20px;
                            text-align:left;
                            border:0px solid #797979;
                            padding:10px;
                            border-radius:4px;
                            background-color:#F7F7F7"
                            
                            name="phone_number" type="text"   onchange="valid_phone_number();"/></td>
        </tr>
        <tr>
           <td><font size="+1" color="#333333" face="MS Serif, New York, serif"><b>
               Address*
               </b></td>
           <td><input style="width:200px;
                            height:50px;
                            font-size:20px;
                            text-align:left;
                            border:0px solid #797979;
                            padding:10px;
                            border-radius:4px;
                            background-color:#F7F7F7"
                            name="address" type="text"   onchange="valid_address();" /></td>
        </tr>
        
        <tr>
           <td><font size="+1" color="#333333" face="MS Serif, New York, serif"><b>
                Gender*
                </b></td>
           <td><input style="width:50px;
                            height:20px;"
                             type="radio" name="gender" value="male" /><font size="+1" color="#333333" face="MS Serif, New York, serif">Male</font>
                <input style="width:50px;
                            height:20px;"
                            type="radio" name="gender" value="female" /><font size="+1" color="#333333" face="MS Serif, New York, serif">Female</font></td>
        </tr>
        
        
        <tr>
           <td><font size="+1" color="#333333" face="MS Serif, New York, serif"><b>
               DOB*
               </b></td>
           <td><input style="width:200px;
                            height:10px;
                            font-size:20px;
                            text-align:centre;
                            border:0px solid #797979;
                            padding:10px;
                            border-radius:4px;
                            background-color:#F7F7F7"
                             name="dob" type="date" /></td>
        </tr>
        
        
        
        
        <tr>
           <td><font size="+1" color="#333333" face="MS Serif, New York, serif"><b>
               Password*
               </b></td>
           <td><input style="width:200px;
                            height:10px;
                            font-size:20px;
                            text-align:left;
                            border:0px solid #797979;
                            padding:10px;
                            border-radius:4px;
                            background-color:#F7F7F7"
                             name="password" type="password" onchange="valid_password_string();"></td>
        </tr>
        <tr>
           <td><font size="+1" color="#333333" face="MS Serif, New York, serif"><b>
                Confirm Password*
                </b></td>
           <td><input style="width:200px;
                            height:10px;
                            font-size:20px;
                            text-align:left;
                            border:0px solid #797979;
                            padding:10px;
                            border-radius:4px;
                            background-color:#F7F7F7"
                             name="confirm_password" type="password" onchange="valid_password_match();"></td>
        </tr>
        <tr>
        <td></td>
           <td><input style="width:110px;
                             height:40px;
                             font-size:20px;
                             font-color:#333333;
                             background-color:#09C66B; 
                             border-radius:10px;" 
                           type="submit" value="SignUp" name="submit">
               <input style="width:110px;
                             height:40px;
                             font-size:20px;
                             font-color:#333333;
                             background-color:#09C66B; 
                             border-radius:10px;"
                             type="reset" value="Clean"/></td>
        </tr>
        <?php  if(empty($errors) === false){?>
	       <tr>
            <td></td>
	        <td><font color="#FF0000"><?php echo output_errors($errors); } ?></font></td>
           </tr> 
   
     </table>  
     	
<?php
}
include 'includes/overall/footer.php'  ?>    