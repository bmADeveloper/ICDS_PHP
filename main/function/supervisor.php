<?php
include "search.php";
if (isset($_POST['search'])) {
    $Name = $_POST['search'];
    $Query = "SELECT name FROM name_tab WHERE name LIKE '%$Name%' LIMIT 5"; 
    $ExecQuery = MySQLi_query($con, $Query);
    	//echo '<ul>'; 
              while ($Result = MySQLi_fetch_array($ExecQuery)) {
                ?><div onclick='fill("<?php echo $Result['name']; ?>")'> 
                        <?php echo $Result['name']; ?>
                   </div> 
                   <?php
               }
} 
?>

   