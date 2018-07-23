<?php
require"database_connection/db_connect.php";


      //.................Center code search.....................................

 function check_centre_code_exists($centre_code)
{
     
           global $con;
           $stmt = $con->prepare("select * from centre_detailss where centre_code=?"); 
           $stmt->bind_param("s",$centre_code);
           $stmt->execute();
           $stmt->store_result();
           $count=$stmt->num_rows;
           return( $count>=1)? true:false;
           $stmt->close();
           $con->close();   
}
function centre_details_search($centre_code)
{
           $arrr=array();
           global $con;
           $stmt = $con->prepare("select centre_name,centre_address from centre_details where centre_code='?'"); 
           $stmt->bind_param("s",$centre_code);
           $stmt->execute();
           $stmt->store_result();
           $stmt->bind_result($arrr['centre_name'],$arrr['centre_address']);
           $stmt->fetch();
           $count=$stmt->num_rows;
           return( $count >= 1)? $arrr:false;
           $stmt->close();
           $con->close();
}

function check_same_date_data_send($date,$centre_code)
{
   	       global $con;
           $stmt = $con->prepare("select * from assignment_data where centre_code=? and assignment_date_time=?"); 
           $stmt->bind_param("ss",$centre_code,$date);
           $stmt->execute();
           $stmt->store_result();
           $count=$stmt->num_rows;
           return( $count>=1)? true:false;
           $stmt->close();
           $con->close();
}

                 //......................................END.............................
                 
                 
        //.............................few assignment data...............................
        
        function assignment_data_insert_centre_close($centre_code,$sup_code,$gp_ward_name,$block_name,$awc_building_yesno,$awc_found_close,$location_address,$lati2,$longi2)
        {
               global $con;  
              // $date1=date('Y-m-d');
               $stmt = $con->prepare("insert into assignment_data(assignment_date_time,centre_code,sup_code,gp_ward_code,block_code,awc_building_exists,awc_found,location_address,latitude,longitude)values(now(),?,?,?,?,?,?,?,?,?)"); 
               $stmt->bind_param("sssssssss",$centre_code,$sup_code,$gp_ward_name,$block_name,$awc_building_yesno,$awc_found_close,$location_address,$lati2,$longi2);
               $stmt->execute();
                return true;
               $stmt->close();
               $con->close(); 
        }
        function assignment_data_insert_buliding_exists_no($centre_code,$sup_code,$gp_ward_name,$block_name,$awc_building_yesno,$location_address,$lati2,$longi2)
        {
              global $con;
               //$date1=date('Y-m-d');
               $stmt = $con->prepare("insert into assignment_data(assignment_date_time,centre_code,sup_code,gp_ward_code,block_code,awc_building_exists,location_address,latitude,longitude)values(now(),?,?,?,?,?,?,?,?)"); 
               $stmt->bind_param("ssssssss",$centre_code,$sup_code,$gp_ward_name,$block_name,$awc_building_yesno,$location_address,$lati2,$longi2);
               $stmt->execute();
                return true;
               $stmt->close();
               $con->close(); 
        }
        function assignment_data_insert_all($centre_code,$sup_code,$gp_ward_name,$block_name,$awc_building_yesno,$awc_found_open,$location_address,$lati2,$longi2,$url_location_image,$total_snp_benefeceries,$benefeceries_served_with_snp,$total_child_7mnth_6yr,$child_served_7mnth_6yr,$total_child_3yr_6yr,$child_in_pse_3yr_6yr,$reg_present_fro_assign,$mothers_meeting,$child_below_5yr_weighed,$total_child_below_5yr,$malnourished_child_moderate,$malnourished_child_severe,$eece_curriculom_followed)
        {
               global $con; 
                //$date1=date('Y-m-d');
               $stmt = $con->prepare("insert into assignment_data(assignment_date_time,centre_code,sup_code,gp_ward_code,block_code,awc_building_exists,awc_found,location_address,latitude,longitude,location_image,total_snp_benefeceries,benefeceries_served_with_snp,total_child_7mnth_6yr,child_served_7mnth_6yr,total_child_3yr_6yr,child_in_pse_3yr_6yr,reg_present_fro_assign,mothers_meeting,child_below_5yr_weighed,total_child_below_5yr,malnourished_child_moderate,malnourished_child_severe,eece_curriculom_followed)values(now(),?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"); 
               $stmt->bind_param("sssssssssssssssssssssss",$centre_code,$sup_code,$gp_ward_name,$block_name,$awc_building_yesno,$awc_found_open,$location_address,$lati2,$longi2,$url_location_image,$total_snp_benefeceries,$benefeceries_served_with_snp,$total_child_7mnth_6yr,$child_served_7mnth_6yr,$total_child_3yr_6yr,$child_in_pse_3yr_6yr,$reg_present_fro_assign,$mothers_meeting,$child_below_5yr_weighed,$total_child_below_5yr,$malnourished_child_moderate,$malnourished_child_severe,$eece_curriculom_followed);
               $stmt->execute();
                return true;
               $stmt->close();
               $con->close(); 
        }
        
        
        //...................................END........................................
        
        
        
        
        
        //............................................Assignment Report Generate..............................
        function find_sector_code_from_sector_details($sup_code)
        {
           $arrr=array();
           global $con;
           $stmt = $con->prepare("select sector_code,sector_name from sector_details where sup_code=?"); 
           $stmt->bind_param("s",$sup_code);
           $stmt->execute();
           $stmt->store_result();
           $stmt->bind_result($arrr['sector_code'],$arrr['sector_name']);
           $stmt->fetch();
           $count=$stmt->num_rows;
           return( $count >= 1)? $arrr:false;
           $stmt->close();
           $con->close();
        }
        function find_one_sup_totale_sector_code($sup_code)
        {
           $arrr=array();
           global $con;
           $stmt = $con->prepare("select * from sector_details where sup_code=?"); 
           $stmt->bind_param("s",$sup_code);
           $stmt->execute();
           $stmt->store_result();
           $count=$stmt->num_rows;
           return( $count >= 1)? $count:false;
           $stmt->close();
           $con->close();
        }
        function find_centre_code_exists_from_assignment_table($centre_code)
        {
            $arrr=array();
           global $con;
           $stmt = $con->prepare("select * from assignment_data where centre_code=?"); 
           $stmt->bind_param("s",$centre_code);
           $stmt->execute();
           $stmt->store_result();
           $count=$stmt->num_rows;
           return( $count >= 1)? true:false;
           $stmt->close();
           $con->close();
        }
        
        
        function find_all_assignment_data_from_assignmentdata_table($centre_code)
        {
            $arrr=array();
           global $con;
           $stmt = $con->prepare("select * from assignment_data where centre_code=?"); 
           $stmt->bind_param("s",$centre_code);
           $stmt->execute();
          $contacts = $stmt->get_result();
          $stmt->close();
         return $contacts;
        }
        
         
        function fetch_sector_data_from_sector_details($sup_code)
{
           $arrr=array();
           global $con;
           $stmt = $con->prepare("select sector_code,sector_name from sector_details where sup_code=?"); 
           $stmt->bind_param("s",$sup_code);
           $stmt->execute();
           $stmt->store_result();
           $stmt->bind_result($arrr['sector_code'],$arrr['sector_name']);
           $stmt->fetch();
           $count=$stmt->num_rows;
           return( $count >= 1)? $arrr:false;
           $stmt->close();
           $con->close();
}
        
        //............................................End.......................................................
        
        
        
        
        
?>