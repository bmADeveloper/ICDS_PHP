<?php
include 'main/init.php';
protect_page();
include 'includes/overall/header.php' ; 
if(empty($_POST) === false)
{
 $required_fields=array('name' ,'email', 'address');	
   foreach($_POST as $key=>$value)
   {
	   if(empty($value) && in_array($key,$required_fields)===true)
	   {
	      $errors[]='Fields  marked with  *  are required';
           break 1;
	   }
   }
   if(empty($errors)===true)
   {
       if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)===false) 
	   {
		 $errors[]='invalid email address';   
	   }
	   else if(email_exists($_POST['email'])===true && $user_data['email'] !== $_POST['email'])
	   {
		 $errors[]='sorry,the email\' ' .$_POST['email']. '\' is already used';  
	   }
   }
  
}
?>
<?php
 
if(isset($_GET['success']) ===true && empty($_GET['success']) ===true)

{
	echo "you details have been updated";
}
else
{
	   if(empty($_POST)===false && empty($errors)===true)
		  {
			  $update_data=array(
				 'name'         => $_POST['name'],
				 'email'		=> $_POST['email'],
				 'address'		=> $_POST['address']
				);
			  update_user($update_data);
			  header("Location: settings.php?success");
			  exit();
		  }
		   else if(empty($errors)===false)
		 {
			echo output_errors($errors);
		 }
	 ?>
	 <form action="" method="post">
	   <table align="center">
			<th><h1>Settings</h2></th>
			<tr><td></td></tr>
			<tr><td></td></tr>
			<tr>
			   <td>Name:</td>
			   <td><input type="text" name="name" value=<?php echo $user_data['name'];?>></td>
			</tr>   
			<tr><td></td></tr>
			<tr><td></td></tr>
			<tr>
			   <td>Address:</td>
			   <td><input type="text" name="address" value=<?php echo $user_data['address'];?>></td>
			</tr> 
			<tr><td></td></tr>
			<tr><td></td></tr> 
			 <tr>
			   <td>Eamil:</td>
			   <td><input type="text" name="email" value=<?php echo $user_data['email'];?>></td>
			</tr> 
			<tr><td></td></tr>
			<tr><td></td></tr>  
			<tr>
				<td></td>
				<td><input type="submit"  value="update"></td>
			 </tr>
	   </table>
	   
	 </form>
	
	
	<?php 
}
 include 'includes/overall/footer.php'  ?>    