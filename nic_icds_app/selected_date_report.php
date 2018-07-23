<?php
include("db_with_function/assignment_function_with_db.php");
$sup_code="sup123";

 
           
        $stmt = $con->prepare("select sector_name,sector_code from sector_details where sup_code=?");
        $stmt->bind_param("s", $sup_code);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->fetch();
        
        
          
         
         $count=0;
            while ($row=mysqli_fetch_array($result)) 
            {
                echo $row['sector_code'];
                echo  $row['sector_name']."<br>";
                echo count($row);
                 
              
            }
            



?>