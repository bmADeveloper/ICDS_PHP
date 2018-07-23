<?php 
function recover($mode,$email)
{
  $mode = sanitize($mode);
  $email1 = sanitize($email);
  $user_data=user_data(user_id_from_email($email),'id','name','email');
  if($mode == 'username')
  {
	  //email($email,"your username.... ", "Hello " . $user_data['name'] . " \n\nYour username is :"  .  $user_data['email'] . " \n\n project");  
    
	  
	  //.............................................................
    
          require_once($_SERVER['DOCUMENT_ROOT']."/SMTP/sendMail.php");
  
       $body = "Hello ".$user_data['name'] . " <br><br> Your username is :"  .  $user_data['email'] . " <br><br> -ICDS Jalpaiguri";
         smtpmailer($email1,"dpo@icdsjalpaiguri.in","icdsjalpaiguri.in","Icds@jal18", "user name recovery", $body);   
        
	  //...........................................................
      
  }
  else if($mode == 'password')
  {
	  $generated_password=substr(md5(rand(999,999999)), 0, 8);
	 // die($generated_password);
	  change_password($user_data['id'],$generated_password);
	 // email($email,"your recovery  passowrd.... ", "Hello " . $user_data['name'] . " \n\nYour recovery password is :"  .  $generated_password . " \n\nlogin -project");
	  
	  //.......................
	  
	   require_once($_SERVER['DOCUMENT_ROOT']."/SMTP/sendMail.php");
$body = "Hello " . $user_data['name'] . " <br><br> Your recovery password is : " .$generated_password . " <br><br> use above password for login -ICDS Jalpaiguri";
smtpmailer($email1,"dpo@icdsjalpaiguri.in","icdsjalpaiguri.in","Icds@jal18", "Password recovery ", $body);
	  
	  //..........................
	  
  }
  
}


function update_user($update_data)
  {  
  global $session_user_id;
  $update=array();
  array_walk($update_data,'array_sanitize');
  foreach($update_data as $field=>$data)
   {
	  $update[]= '`' .$field. '` = \'' . $data . '\'';
   }
   
    mysql_query("update dpo_cdpo_regist_table set ".  implode(', ',$update) . "where id='$session_user_id'") or die(mysql_error());
   }
   
   
function activate($email,$email_code)
{
	$email=mysql_real_escape_string($email);
	$email_code=mysql_real_escape_string($email_code);
	if(mysql_result(mysql_query("select COUNT('id') from dpo_cdpo_regist_table where email='$email' and email_code='$email_code' and active=0"),0)==1)
	{
		mysql_query("update dpo_cdpo_regist_table set active=1 where email='$email'");
		return true;
	}
	else
	{
	return false;	
	}
}

  function change_password($id,$password)
  {
	$user_id=(int)$id;
	$password=md5($password);
	mysql_query("update dpo_cdpo_regist_table set password='$password' where id='$user_id'");
  }

  function user_count()
  {
	  
	  $query5=mysql_query("select count('id') from dpo_cdpo_regist_table where active=1");
	  return(mysql_result($query5,0)); 
  }
  function user_data($id)
  {
	  
	  $data=array();
	  $user_id=(int)$id;
	  $func_num_args=func_num_args();
      $func_get_args=func_get_args(); 
	  if($func_num_args > 1)
	  {
		  unset($func_get_args[0]);
		  $fields='`' . implode('`, `',$func_get_args) . '`';
		  
		  $data=mysql_fetch_assoc(mysql_query("select $fields from `dpo_cdpo_regist_table` where `id`=$user_id")); 
		    //print_r($data);
		   
		  return $data;
	  }
  }

   function logged_in()
   {
	   return (isset($_SESSION['id'])) ? true : false;
   }
   
   function dpo_cdpo_exists($name,$email,$dob)
   {
	   include 'conn.php'; 
	  $name=sanitize($name);
	  $email=sanitize($email);
	  $dob=sanitize($dob);
	 if($stmt=$conn->prepare("select dpo_cdpo_code from dpo_cdpo_master_table where dpo_cdpo_name=? and dpo_cdpo_email=? and dpo_cdpo_dob=? "))
       {
		   $stmt->bind_param("sss",$name,$email,$dob);
		   $stmt->execute();
		   $stmt->store_result();
		   $count=$stmt->num_rows;
		   return($count>=1)? true:false;
		   $stmt->close();
		   $conn->close();
		}
   }
   function dpo_cdpo_exists_code_fetch($name,$email,$dob)
   {
	    
	   
	   include 'conn.php'; 
	  $name=sanitize($name);
	  $email=sanitize($email);
	  $dob=sanitize($dob);
	 if($stmt=$conn->prepare("select dpo_cdpo_code from dpo_cdpo_master_table where dpo_cdpo_name=? and dpo_cdpo_email=? and dpo_cdpo_dob=? "))
       {
		   $stmt->bind_param("sss",$name,$email,$dob);
		   $stmt->execute();
		   $stmt->store_result();
		   $stmt->bind_result($code);
		     $stmt->fetch();
		   $count=$stmt->num_rows;
		   return($count>=1)? $code:false;
		   $stmt->close();
		   $conn->close();
		}
   }
   
   function user_exists($username)
   {  //$conn=new mysqli("localhost","root","","mydatabase");
      include 'conn.php'; 
	  $username=sanitize($username);
	 if($stmt=$conn->prepare("select id from dpo_cdpo_regist_table where email=? "))
       {
		   $stmt->bind_param("s",$username);
		   $stmt->execute();
		   $stmt->store_result();
		   $count=$stmt->num_rows;
		   return($count>=1)? true:false;
		   $stmt->close();
		   $conn->close();
		}
   }
   function email_exists($email)
   {  //$conn=new mysqli("localhost","root","","mydatabase");
      include 'conn.php'; 
	  $email=sanitize($email);
	 if($stmt=$conn->prepare("select id from dpo_cdpo_regist_table where email=? "))
       {
		   $stmt->bind_param("s",$email);
		   $stmt->execute();
		   $stmt->store_result();
		   $count=$stmt->num_rows;
		   return($count>=1)? true:false;
		   $stmt->close();
		   $conn->close();
		}
   }
   function user_active($username)
   {
	  $username=sanitize($username);
	  $query2=mysql_query("select count('id') from dpo_cdpo_regist_table where email='$username' and active='1'");
	  return(mysql_result($query2,0)==1)?true:false; 
   }
   
   
   function user_id_from_username($username)
   {
	   $username=sanitize($username);
	   $query3=mysql_query("select id from dpo_cdpo_regist_table where email='$username'");
	   return mysql_result($query3, 0, 'id');
   }
   function user_id_from_email($email)
   {
	   $email=sanitize($email);
	   $query4=mysql_query("select id from dpo_cdpo_regist_table where email='$email'");
	   return mysql_result($query4, 0, 'id');
   }
   
   
   function register_user($register_data)
  {       //include 'conn.php';
		  // $conn=new mysqli("localhost","root","","mydatabase");
		  array_walk($register_data,'array_sanitize');
		  $register_data['password']=md5($register_data['password']);
		  $fields='`' . implode('`, `',array_keys($register_data)) . '`';
		  $data='\'' . implode('\', \'',$register_data) . '\'';
		  
	      mysql_query("insert into dpo_cdpo_regist_table($fields)values($data)");
		 // email($register_data['email'],'activate your account',"Hello".$register_data['name'].",\n\n you need to active your account,click the link bellow:\n\n http://localhost/nic/activate.php?email=".$register_data['email']."&email_code=".$register_data['email_code']." \n\n - project          ");
	   
	   
	   //.................................................................................
		
		require_once($_SERVER['DOCUMENT_ROOT']."/SMTP/sendMail.php");
  
$body = "Hello".$register_data['name'].",\n\n you need to active your account,click the link bellow:\n\n http://icdsjalpaiguri.in/activate.php?email=".$register_data['email']."&email_code=".$register_data['email_code']." \n\n -ICDS Jalpaiguri";
smtpmailer($register_data['email'],"dpo@icdsjalpaiguri.in","icdsjalpaiguri.in","Icds@jal18", "account activation", $body);
	 
		//.................................................................................	

	   
	   
	   
  }
		
   function login($username,$pass)
   {
	  $id=user_id_from_username($username);
	  $username=sanitize($username);
	  $pass=md5($pass);
	  $query4=mysql_query("select count(id) from dpo_cdpo_regist_table where email='$username' and password='$pass'");
	  return (mysql_result($query4,0)==1) ? $id:false;
   }
?> 