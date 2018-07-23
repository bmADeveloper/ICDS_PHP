
						  
<?php
mysql_connect("localhost", "mysql_user", "mysql_password") or
    die("Could not connect: " . mysql_error());
mysql_select_db("mydb");

 $result3 = mysql_query("select gp_ward_name from gp_ward_details where gp_ward_code='ward-06'");  //..........dropdown list in project
				while ($row3 = mysql_fetch_array($result3, MYSQL_NUM)) 
				{
					$gpward_name=$row3[0];
				}
				 mysql_free_result($result3);
 
?>