<?php
include("db_with_function/assignment_function_with_db.php");
$code=$_POST['centre_code'];
$state_dist="19328";
$centre_code=$state_dist.$code;
 $succ_date=date('Y-m-d');

 
$response=array();
 

           global $con;
           $stmt = $con->prepare("select assignment_date_time,assignment_data.centre_code,centre_name,location_address from assignment_data,centre_detailss where assignment_data.centre_code=centre_detailss.centre_code and assignment_data.centre_code=? and assignment_date_time=? "); 
           $stmt->bind_param("ss",$centre_code,$succ_date);
           $stmt->execute();
           $stmt->store_result();
           $stmt->bind_result($ass_date,$centre_code,$centre_name,$location);
           $arrr=array(); 
           $ss=$sup_code;
           $response["success"] = false;  
           while($stmt->fetch())
           {
               $response["success"]=true;
                $response["one"]=1;

	      $response["ass_date"]=$ass_date;  
               $response["centre_code"]=$centre_code;
               $response["centre_name"]=$centre_name;
                $response["location"]=$location;
                  
               
           }
           
   
         
    
         
    





echo json_encode($response);
?>