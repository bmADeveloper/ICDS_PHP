<?php
include 'main/init.php';
protect_page();

/*
mysql_connect("localhost", "root", "") or
    die("Could not connect: " . mysql_error());
mysql_select_db("mydatabase");
*/



if(!empty($_POST["p_code"]))
{
	 
    $p_code=$_POST["p_code"];
	echo $p_code;
    $result = mysql_query("select gp_ward_name,gp_ward_code from gp_ward_details where project_code=$p_code ORDER BY gp_ward_name DESC");
 
 ?>
 
 
 
    <option value=''> select gp/wward name </option>
  
 <?php
  while ($row = mysql_fetch_array($result, MYSQL_NUM)) 
  {
?> <option value="<?php echo $row[1]; ?>"> <?php  echo $row[0]; ?></option>
 <?php
}
 mysql_free_result($result);
}


?>