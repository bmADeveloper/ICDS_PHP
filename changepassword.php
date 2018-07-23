<?php
include 'main/init.php';
protect_page();
if(empty($_POST)===false)
{
  $required_fields=array('current_password','password','confirm_password');	
   foreach($_POST as $key=>$value)
   {
	   if(empty($value) && in_array($key,$required_fields)===true)
	   {
	      $errors[]='Fields  marked with  *  are required';
           break 1;
	   }
   }
   if(md5($_POST['current_password']) === $user_data['password'] )
   {
	 if(trim($_POST['password']) !== trim($_POST['confirm_password']))
	 {
		 $errors[]='password does not match';
     }
	}
	else
	{
	   $errors[]='your current password is incorrect';	
	}
  // echo $user_data['password'];
   //print_r($errors);
}
include 'includes/overall/header.php' ; 

?> 
 <h1>Change Password</h1>
 
 <?php
   if(empty($_POST)===false && empty($errors)===true)
	  {
		  change_password($session_user_id,$_POST['password']);
		  header("Location:changepassword.php?success");
	  }
	   else if(empty($errors)===false)
     {
		echo output_errors($errors);
	 }
 ?>
 <form action="" method="post">
   <table align="center">
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr>
           <td> Current Password*:</td>
           <td><input type="text" name="current_password" placeholder="current password"></td>
        </tr>   
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr>
           <td>New Passsword*:</td>
           <td><input type="password" name="password" placeholder="************"></td>
        </tr> 
        <tr><td></td></tr>
        <tr><td></td></tr> 
         <tr>
           <td>Confirm Passsword*:</td>
           <td><input type="password" name="confirm_password" placeholder="************"></td>
        </tr> 
        <tr><td></td></tr>
        <tr><td></td></tr>  
        <tr>
            <td></td>
            <td><input type="submit" value="Change Password"></td>
         </tr>
   </table>
   
 </form>



 
<?php include 'includes/overall/footer.php'  ?>    