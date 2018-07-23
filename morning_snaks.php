<?php
 
include 'main/init.php';
protect_page();
include 'includes/overall/header.php' ; 
session_start();
$block_dist_code=trim($user_data['dpo_cdpo_code']);
?>

<html>
  <head>
    <title>Total No.of Morning snaks(7mn-6yr)particular  date or month</title>
  </head>
 <body>
      <h2><p align="center">Morning snaks(7mn-6yr)particular date or month</p> </h2>
	   <form name="fm"  action="morning_snaks_data.php" method="post" onSubmit="valid_empty();">
		 <br> 
		 <table align="center">
				  <tr><td></td></tr>
				<tr><td></td></tr>
				<tr>
				<td>
				<label>Supervisor Name:</label>
                               <select name="sup_code" required>
										   <option value="">Supervisor</option> 	
                                          		<?php             
												  $result23 = mysql_query("select name,sup_code from supervisor where supervisor.sup_code in(select distinct assignment_data.sup_code from assignment_data where assignment_data.block_code='$block_dist_code')"); 
													while ($row23 = mysql_fetch_array($result23, MYSQL_NUM)) {
												?>
										    <option value=" <?php echo $row23[1];?>"><?php  echo $row23[0];?></option> 
												  <?php 
													 }
													 mysql_free_result($result23);
												?>	
	                             </select> 
				
			 

				 Report From*: 
						 <input style="width:169px;" type="date" name="from_date" placeholder="From" required></td>
					<td>To*: <input style="width:169px;" type="date" name="to_date" placeholder="To" required></td>
				</tr> 
				<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
				<tr>
					<td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="submit" name="submit" value="Report">
						  <input type="reset" value="Clean"/></td>
				 </tr>
		   </table>
     </form>
                                                
								 
	  
	  
  </body>
</html>
<?php include 'includes/overall/footer.php'  ?>  