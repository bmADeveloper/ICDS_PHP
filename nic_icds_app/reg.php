
<?php

require_once("db_config.php");
class RegUser
{
    private $db;
	private $connection;
	
	function __construct() {
		$this -> db = new Conectar();
		$this -> connection = $this->db->connection();
	}
	
	public function email_not_already_reg($sup_code,$name,$email,$dob,$gender,$ph_num,$encrypted_password,$code,$url_image)
	{
		$query1 = "select * from supervisor where email='$email'";
		$result1 = $this -> connection->prepare($query1);
		$result1->execute();
		
		if($result1->rowCount() == 1)
		{
				$json['error'] = 'Email already registered...';
				echo json_encode($json);
		}
		else
		{
$query = "insert into supervisor(sup_code,name,email,date_of_birth,gender,ph_number,password,verify_code,photo)
values('$sup_code','$name','$email','$dob','$gender','$ph_num','$encrypted_password','$code','$url_image')";
			$result = $this -> connection->prepare($query);
			$result->execute();
			if($result->rowCount() == 1)
			{
				$json['success'] = 'successfully Reg ';
				echo json_encode($json);
			}
		}
	}
}


$RegUser = new RegUser();
//if(isset($_POST['email'],$_POST['password']))
//{	
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
		
		
		
		
	if(!empty($email) && !empty($password))
	{
			$sup_code='sup01';
			$RegUser-> email_not_already_reg($sup_code,$name,$email,$dob,$gender,$ph_num,$encrypted_password,$code,$url_image);
	}
	else
	{
			echo json_encode("field should not empty!!");
	}
//}

?>