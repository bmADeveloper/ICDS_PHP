<?php
include("db_with_function/assignment_function_with_db.php");
$centre_code="centre123";

if(empty($centre_code))
{
    echo "require field";
}
else
{
    if(check_centre_code_exists($centre_code)===true)
    {
        $arr=array();
        $arr= centre_details_search($centre_code);
        $c_name=$arr['centre_name'];
        $c_address=$arr['centre_address'];
        echo $c_name.$c_address;
    }
}





?>