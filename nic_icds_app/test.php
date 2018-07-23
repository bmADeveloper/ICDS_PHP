<?php
 /*include("db_with_function/db_with_function.php");

$email="barun7m@gmail.com";

    $arr=array();
    global $con;
    $stmt=$con->prepare("select sup_code from supervisor where email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($arr['sup_code']);
    $stmt->fetch();
    $count=$stmt->num_rows;
    print_r($arr);
    //return($count > 1)? $sup_code:false;
    $stmt->close();
	*/include("db_with_function/db_with_function.php");
	$centre_code="19328100101";
	$date="2018-04-29 03:56:07";
	      global $con;
           $stmt = $con->prepare("select * from assignment_data where centre_code=? and assignment_date_time=?"); 
           $stmt->bind_param("ss",$centre_code,$date);
           $stmt->execute();
           $stmt->store_result();
           $count=$stmt->num_rows;
           //return( $count>=1)? true:false;
		   echo $count;
           $stmt->close();
           $con->close();
?>