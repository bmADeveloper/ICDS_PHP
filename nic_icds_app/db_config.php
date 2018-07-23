<?php

class Conectar{
	public static function connection(){
	   // $con = mysqli_connect("localhost", "id4168852_barun8m", "9679662070", "id4168852_mydatabase");
    
		
		try{
			$connection = new PDO('mysql:host=localhost; dbname=icdsjalp_mtms','icdsjalp','Icds@jal18');
			$connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$connection -> exec("SET CHARACTER SET UTF8");
			
	}catch(Exception $e){
		
		die("Error " . $e->getMessage());
		echo "Linea del error " . $e->getLine();
	}
	
	return $connection;
	}
}
?>
 