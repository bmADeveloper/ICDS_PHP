 <?php
include 'main/init.php';
protect_page();

/*
mysql_connect("localhost", "root", "") or
    die("Could not connect: " . mysql_error());
mysql_select_db("mydatabase");
*/



if(!empty($_POST["block_code"]))
{
	 
    $block_code=trim($_POST["block_code"]); // space remove using this method
	echo $block_code;
    $result = mysql_query("select project_name,project_code from project_details where block_code='$block_code'");
 
 ?>
 
 
 
    <option value=''> select project name </option>
  
 <?php
  while ($row = mysql_fetch_array($result, MYSQL_NUM)) 
  {
?> <option value="<?php echo $row[1]; ?>"> <?php  echo $row[0]; ?></option>
 <?php
}
 mysql_free_result($result);
}


?>