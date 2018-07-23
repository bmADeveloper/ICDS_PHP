<?php
include("db_with_function/assignment_function_with_db.php");
$code=$_POST['centre_code'];
$state_dist="19328";
$centre_code=$state_dist.$code;
$sup_code=$_POST['sup_code'];
$response=array();
if(empty($centre_code) || empty($sup_code))
{
    $response["success"]=true;
    $response["error_searched"]="Required field...!!!";
}
else if(check_centre_code_exists($centre_code)===false)
{
    $response["success"]=true;
    $response["error_searched"]="Centre Code not found...!!!";
}
else
{         


           global $con;
           $stmt = $con->prepare("select centre_code,centre_name,centre_address,block_code,gp_ward_code,supervisor.name from centre_detailss,supervisor where centre_code=? and centre_detailss.sup_code=? and centre_detailss.sup_code=supervisor.sup_code"); 
           $stmt->bind_param("ss",$centre_code,$sup_code);
           $stmt->execute();
           $stmt->store_result();
           $stmt->bind_result($c_code,$c_name,$c_address,$block_code,$gp_ward_code,$sup_name);
           $arrr=array(); 
           $ss=$sup_code;
           $response["success"] = false;  
           while($stmt->fetch())
           {
               $response["success"]=true;
                $response["one"]=1;

			   $response["c_code"]=$c_code;  
               $response["c_name"]=$c_name;
               $response["c_add"]=$c_address;
                $response["block_name"]=$block_code;
                 $response["gp_ward_name"]=$gp_ward_code;
                $response["sup_name"]=$sup_name;
              
               
           }
           
           
}
        
         
    
         
    





echo json_encode($response);
?>