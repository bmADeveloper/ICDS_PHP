<?php
 
include 'main/init.php';
protect_page();
include 'includes/overall/header.php' ; 
session_start();
?>

<html>
  <head>
    <title>Total No. of AWCs open out of total visitor made by visitor</title>
  </head>
 <body>
      <h2><p align="center">Total No. of AWCs open out of total visitor made by visitor</p> </h2>
	   <form name="fm"  action="awc_open_out_of_total_visit_data.php" method="post" onSubmit="valid_empty();">
		 <br> 
		 <table align="center">
				  <tr><td></td></tr>
				<tr><td></td></tr>
				<tr>
					<td>Report From*: 
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