<?php

include("db_with_function/assignment_function_with_db.php");
 $sup_code="sup123";
 $sector_code="sector01";
 $response = array();
 
 

        $stmt = $con->prepare("select * from sector_details where sup_code=?");
        $stmt->bind_param("s", $sup_code);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->fetch();
        
        
          
         
         $count=0;
            while ($row=mysqli_fetch_array($result)) 
            {
             //print $row['sector_code'];
              //print $row['sup_code'];
               foreach($row as  $value)
               { 
                   
                    echo json_encode($value['sector_code']);
               }
             
              
            }
            
               
            $stmt->close();
?>