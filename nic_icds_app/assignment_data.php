<?php
 
include("db_with_function/assignment_function_with_db.php");
$code=$_POST['centre_code'];             //............20

	$state_dist="19328";
	$centre_code=$state_dist.$code;

$p_c=str_split($centre_code,11-4);
$project_code=$p_c[0];    //..............project_code

 $s_c=str_split($centre_code,11-2);
 $sector_code=$s_c[0];   //..............sector_code


$sup_code=$_POST['sup_code'];                      //............19
$gp_ward_name=$_POST['gp_ward_name'];                      //............sp_ward_name
$block_name=$_POST['block_name'];                      //........... block_name


$location_address=$_POST['fullAddress'];       //............18
$lati2=$_POST['lati2'];                            //............17
$longi2=$_POST['longi2'];                         //............16
$location_image=$_POST['location_image'];                   //.............21

$date = date('Y-m-d');
//echo $date;        
if($location_image!="no imagen")
{
			$path  = "../VisitedImage/$date$centre_code.jpg"; 
			$url_location_image = "$date$centre_code.jpg";// image aly allow jpeg files
			file_put_contents($path,base64_decode($location_image));
}
else
{
	$url_location_image = "empty";
}   



$awc_building_yesno=$_POST['awc_building_yesno'];     //............1
$awc_found_close=$_POST['awc_found_close'];          //............2
$awc_found_open=$_POST['awc_found_open'];          //............2

$total_snp_benefeceries=$_POST['total_snp_benefeceries'];  //............ 3
$benefeceries_served_with_snp=$_POST['benefeceries_served_with_snp']; //.........4
$total_child_7mnth_6yr=$_POST['total_child_7mnth_6yr'];    //.................... 5
$child_served_7mnth_6yr=$_POST['child_served_7mnth_6yr'];  //.................... 6
$total_child_3yr_6yr=$_POST['total_child_3yr_6yr'];      //....................... 7
$child_in_pse_3yr_6yr=$_POST['child_in_pse_3yr_6yr'];    //....................... 8
$reg_present_fro_assign=$_POST['register_present_for_assessment']; //...................... 9
$mothers_meeting=$_POST['mothers_meeting'];         //.....................10
$child_below_5yr_weighed=$_POST['child_below_5yr_weighed'];       //.....................11

$total_child_below_5yr=$_POST['total_child_below_5yr'];       //.....................12
$malnourished_child_moderate=$_POST['malnourished_child_moderate'];       //.....................13
$malnourished_child_severe=$_POST['malnourished_child_severe'];       //.....................14
$eece_curriculom_followed=$_POST['eece_curriculom_followed'];       //.....................15
 



 $response=array();
 $no="No";
 $yes="Yes";
 $close="close";
 $open="open";
//..........................................building not exists  /  awcentre close  insert assignment data....................................................

if(!empty($centre_code) || !empty($awc_building_yesno)  || !empty($location_address) || !empty($lati2) || !empty($longi2))
{
    if($yes==$awc_building_yesno && $close==$awc_found_close || $no==$awc_building_yesno && $close==$awc_found_close)
    {
       
        if(assignment_data_insert_centre_close($centre_code,$sup_code,$gp_ward_name,$block_name,$awc_building_yesno,$awc_found_close,$location_address,$lati2,$longi2)===true)  // 7+3 data
        {
        $response["success"]=true;
        $response["assignment_data"]="Data submitted Successfully....";
        $response["change"]=1;
        }
    }
   
    else if( $no==$awc_building_yesno)
    {
        
           //if(assignment_data_insert_buliding_exists_no($centre_code,$sup_code,$gp_ward_name,$block_name,$awc_building_yesno,$location_address,$lati2,$longi2)===true)
if(assignment_data_insert_all($centre_code,$sup_code,$gp_ward_name,$block_name,$awc_building_yesno,$awc_found_open,$location_address,$lati2,$longi2,$url_location_image,$total_snp_benefeceries,$benefeceries_served_with_snp,$total_child_7mnth_6yr,$child_served_7mnth_6yr,$total_child_3yr_6yr,$child_in_pse_3yr_6yr,$reg_present_fro_assign,$mothers_meeting,$child_below_5yr_weighed,$total_child_below_5yr,$malnourished_child_moderate,$malnourished_child_severe,$eece_curriculom_followed)===true)		
            {
                $response["success"]=true;
                $response["assignment_data"]="Data submitted Successfully...";
                $response["change"]=1;
            } 
    }
     else if( $open==$awc_found_open)
    {
		if(check_same_date_data_send($date,$centre_code)===true)
		{
			    $response["success"]=true;
                $response["assignment_data"]="Already send assignment data...";
                $response["change"]=1;
		}
  else if(assignment_data_insert_all($centre_code,$sup_code,$gp_ward_name,$block_name,$awc_building_yesno,$awc_found_open,$location_address,$lati2,$longi2,$url_location_image,$total_snp_benefeceries,$benefeceries_served_with_snp,$total_child_7mnth_6yr,$child_served_7mnth_6yr,$total_child_3yr_6yr,$child_in_pse_3yr_6yr,$reg_present_fro_assign,$mothers_meeting,$child_below_5yr_weighed,$total_child_below_5yr,$malnourished_child_moderate,$malnourished_child_severe,$eece_curriculom_followed)===true)
        {
            $response["success"]=true;
            $response["assignment_data"]="Data submitted Successfully....!!!";
            $response["change"]=1;
        }
            
 
    }
   
}
else
{
   
   
    $response["success"]=true;
   $response["assignment_data"]="field required....!!!";
}

//.......................................................full assignment data.........................................................





echo json_encode($response);
?>