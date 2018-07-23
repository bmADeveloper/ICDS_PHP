<html>
<?php
include 'main/init.php';
protect_page();
include 'includes/overall/header.php' ; 
session_start();

$from=trim($_POST['from_date']); 
$to=trim($_POST['to_date']);
$sup_code=trim($_POST['sup_code']);
 //echo $sup_code;
$serialno=0;
$query="";
 
?>
<br><br><br><br>
  <h2><p align="center">::<u>Total No.of AWCs following ECCE Curiculum out of the total visit made by visitor/CDPO/DPO/Supervisor</u>::</p></h1>

<?php
	
	
		$query="SELECT distinct centre_detailss.centre_name FROM assignment_data INNER JOIN centre_detailss ON centre_detailss.centre_code=assignment_data.centre_code WHERE date(assignment_data.assignment_date_time) BETWEEN '$from' AND '$to' AND assignment_data.sup_code='$sup_code'AND eece_curriculom_followed ='YES'";
	
         $html='<table align="center" border="1"><tr><th>Serial</th><th>Centre Name</th></tr>';
			$result1 = mysql_query($query);
	            while ($row = mysql_fetch_array($result1, MYSQL_NUM)) 
				{
					$serialno++;
				
					 $html=$html."<tr><td>". $serialno."</td><td>". $row[0]."</td></tr>";
						
				 } 
             mysql_free_result($result1);
			$html = $html."</table>";
			echo $html;
			?>
</html>
<?php include 'includes/overall/footer.php'  ?>  
	

		 
	   			
	
	

