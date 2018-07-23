<?php
include("db_with_function/assignment_function_with_db.php");
$awc_building_yesno=$_POST['awc_building_yesno'];
$awc_found_close=$_POST['awc_found_close'];
$fullAddress=$_POST['fullAddress'];
$lati=$_POST['lati2'];
$longi=$_POST['longi2'];
$response=array();

if(empty($awc_building_yesno) || empty($fullAddress) || empty($lati) || empty($longi))
{
    $response["success"]=true;
    $response["data_saved"]="Field required...!!!";
}
else
{
    if($awc_building_yesno=="yes")
    {
        if(few_assignment_data_saved1($awc_building_yesno,$awc_found_close,$fullAddress,$lati,$longi)===true)
        {
             $response["success"]=true;
             $response["data_saved"]="few data assigned1...!!!";
             $response["success_true"]=1;
        }
    }
    else
    {
        if(few_assignment_data_saved2($awc_building_yesno,$fullAddress,$lati,$longi)===true)
        {
             $response["success"]=true;
             $response["data_saved"]="few data assigned2...!!!";
             $response["success_true"]=1;
        }
    }
        
    
}

?>