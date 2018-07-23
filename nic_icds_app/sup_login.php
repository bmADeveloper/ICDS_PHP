<?php

require_once("db_config.php");
	
	class LoginUser 
	{
		
						private $db;
						private $connection;
						
						function __construct() {
							$this -> db = new Conectar();
							$this -> connection = $this->db->connection();
						}
						
						public function does_user_exist($email,$encrypted_password)
						{
							$query1 = "Select * from supervisor where email='$email' and active=0";
							$result1 = $this -> connection->prepare($query1);
							$result1->execute();
							
							if($result1->rowCount() == 1)
							{
									$json['error'] = 'first verify your mobile number contact admin...';
									echo json_encode($json);
							}
							else
							{
							$query = "Select * from supervisor where email='$email' and password = '$encrypted_password' and  active=1";
							$result = $this -> connection->prepare($query);
							$result->execute();
							
							if($result->rowCount() == 1){
								$json['success'] = 'successfully loggedin '.$email;
								 
								$query = "SELECT sup_code,email,photo,name,ph_number FROM supervisor WHERE email = ?";
								
								try {
								
									$comando = $this->connection->prepare($query);
									 
									$comando->execute(array($email));
									 
									$row = $comando->fetch(PDO::FETCH_ASSOC);
									$json['tabledata'][]=$row;
													
								} catch (PDOException $e) {
									$json['error'] = 'exception';
									 
									return -1;
								}
				
								echo json_encode($json);
							}else{
								$json['error'] = 'invalid username or password';
								echo json_encode($json);
							}
							
						}
						}//else end
						
	}
					
	$loginUser = new LoginUser();
	if(isset($_POST['email'],$_POST['password']))
	{
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		if(!empty($email) && !empty($password))
		{
			$encrypted_password = md5($password);
			$loginUser-> does_user_exist($email,$encrypted_password);
		}
		else
		{
			$json['error'] ='field should not empty...!!'; 
			echo json_encode($json);
		}
		
	}
?>