<?php
include 'main/init.php';
protect_page();

/*
mysql_connect("localhost", "root", "") or
    die("Could not connect: " . mysql_error());
mysql_select_db("mydatabase");
*/




if(!empty($_POST["p_code2"]))
{
	 
    $project_code=$_POST["p_code2"];
	echo $project_code;
    $result = mysql_query("select sector_name,sector_code from sector_details where project_code=$project_code");
 
 ?>
 
 
  <option value='s_code'> select sector </option>
  
  
 <?php
  while ($row = mysql_fetch_array($result, MYSQL_NUM)) 
  {
?> <option value=" <?php echo $row[1]; ?>" > <?php  echo $row[0]; ?></option>
 <?php
}
 mysql_free_result($result);
}


?>