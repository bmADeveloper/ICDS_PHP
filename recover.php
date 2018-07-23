<?php
include 'main/init.php';
logged_in_redirect();
include 'includes/overall/header.php'  

?> 
 <br /><br /><font color="#003366" size="+1"><h1><p align="center">Forgotten your username or password</p></h1></font>
 <?php
 if(isset($_GET['success']) ===true && empty($_GET['success']) ===true)
{
	?><br /><br /><p><font color="#237DEB" size="+3">Thanks, Check your E-mail please....</font><img src="pic/email.png" height="50" width="50" /></p><?php
}
  else
  {
		   $mode_allowed=array('username','password');
		   if(isset($_GET['mode'])===true && in_array($_GET['mode'],$mode_allowed)===true)
		   {
			   
			   if(isset($_POST['email'])===true && empty($_POST['email'])===false)
			   {
				  if(email_exists($_POST['email'])===true)
				 {
					recover($_GET['mode'] , $_POST['email']);
					header("Location: recover.php?success");
					exit();
				  } 
				  else
				  {
					echo '<p><font color="#F7738D" size="25">opps could not find your E-mail</font><img src="pic/invalid.png"height="40" width="40"></p>';  
				  }
			   }
		 ?>
		 <form action="" method="post">
			<ul>
			   <li> Your E-mail address</li>
			   <li> <input type="text" name="email"></li>
			   <li><input type="submit" value="recover">
			</ul>
		 </form>
		 
		 <?php
			   
			 //echo $_GET['mode'];   
		   }
		   else
		   {
			   header("Location: index.php");
			   exit();
		   }
  }
	 
	 ?> 
<?php include 'includes/overall/footer.php'  ?>    