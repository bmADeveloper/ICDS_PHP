<html>
<?php
include 'main/init.php';
protect_page();
include 'includes/overall/header.php' ; 
session_start();

$block_dist_code=trim($user_data['dpo_cdpo_code']);
$from=trim($_POST['from_date']); 
$to=trim($_POST['to_date']);
 
$serialno=0;
$query="";
 
?>
<br><br><br><br>
  <h1><p align="center">::<u>Total No.of AWCs open out of the total visit made by a visitor DPO/CDPO/Supervisor particular date or month</u>::</p></h1>

<?php
	if($block_dist_code="19328")
	{
		$query="
		SELECT supervisor.`name`,supervisor.ph_number,Count(assignment_data.centre_code) AS awc_visited,SUM(CASE WHEN assignment_data.awc_found='open' THEN 1 ELSE 0 END) AS awc_open FROM assignment_data INNER JOIN supervisor ON supervisor.sup_code=assignment_data.sup_code WHERE (DATE(assignment_date_time) BETWEEN '$from' AND '$to') GROUP BY supervisor.`name`,supervisor.ph_number";
	}
	else
	{
		$query="
		SELECT supervisor.`name`,supervisor.ph_number,Count(assignment_data.centre_code) AS awc_visited,SUM(CASE WHEN assignment_data.awc_found='open' THEN 1 ELSE 0 END) AS awc_open FROM assignment_data INNER JOIN supervisor ON supervisor.sup_code=assignment_data.sup_code WHERE (DATE(assignment_date_time) BETWEEN '$from' AND '$to') AND assignment_data.sup_code IN (SELECT centre_detailss.sup_code FROM centre_detailss WHERE block_code='$block_dist_code') GROUP BY supervisor.`name`,supervisor.ph_number";
	}
         $html='<table align="center" border="1"><tr><th>Name</th><th>Ph. Num.</th><th>Total visit</th><th>Found Open</th></tr>';
			$result1 = mysql_query($query);
	            while ($row = mysql_fetch_array($result1, MYSQL_NUM)) 
				{
					$serialno++;
					// echo $row[0];
					//echo $row[1];
					//echo $row[2];
					 $html=$html."<tr><td>". $row[0]."</td><td>". $row[1]."</td><td>". $row[2]."</td><td>". $row[3]."</td></tr>";
						
				 } 
             mysql_free_result($result1);
			$html = $html."</table>";
			echo $html;
			?>
</html>
<?php include 'includes/overall/footer.php'  ?>  
	

		 
	   			
	
	

