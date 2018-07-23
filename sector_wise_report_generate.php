 <style>
@media print {
  #printPageButton {display: none;}
  #hidebacksectorwise{display:none;}
}
</style>

<?php  
session_start();
include 'main/init.php';
protect_page();


/*
mysql_connect("localhost", "root", "") or
    die("Could not connect: " . mysql_error());
mysql_select_db("mydatabase");
*/



 


//$block_name=$_SESSION['BlockName'];
 $block_code=trim($_POST['block_codeSector']);     
 $from=trim($_POST['from_date']); 
 $to=trim($_POST['to_date']);
 $project_code=trim($_POST['pro_code']);
 $sector_code=trim($_POST['sector_code']);
 $visit_unvisit=trim($_POST['visit_unvisit']);

 //$sector_code=trim($s_code);
// $project_code=trim($p_code);
//echo $block_name.$from.$to.$visit_unvisit;
//echo $sector_code;
//echo $project_code;
//echo $block_code;


//...............................................Block Name...............................
                $result1 = mysql_query("select block_name from block_details where block_code='$block_code'");  
				while ($row = mysql_fetch_array($result1, MYSQL_NUM)) 
				{
					$block_name=$row[0];
					//echo $block_name;
				}
				 mysql_free_result($result1);
				 
				 



 //.........................Project Name ............................................................
               $result1 = mysql_query("select project_name from project_details where project_code=$project_code");  
				while ($row = mysql_fetch_array($result1, MYSQL_NUM)) 
				{
					$project_name=$row[0];
				}
				 mysql_free_result($result1);
				 
	//.............................Sector Name..................................................
			   $result2 = mysql_query("select sector_name from sector_details where sector_code=$sector_code");   
				while ($row2 = mysql_fetch_array($result2, MYSQL_NUM)) 
				{
					$sector_name=$row2[0];
				}
				 mysql_free_result($result2);
				 
				 
				 
				// echo $project_name.$sector_name;
				 
 
if($visit_unvisit=="visit")
{
?> 	
<h2><b><label><p align="center">ICDS, Jalpaiguri District ,West Bengal<br>
                                Centre Visited</p></label></b></h2>
   
  
   <table align="center">
    <table align="left">
       <tr>
		   <td><?php echo "Report From: <b>".$from ."</b>   To: <b>".$to."</b>"?></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Block Name :<?php echo $block_name;?></td>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td>Project Name : <?php echo $project_name;?></td>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td>Sector Name :<?php echo $sector_name;?></td>
            
         </tr>
    </table>
    <table align="center">
      <tr>
      <td><a  href="index.php" id="hidebacksectorwise">Go Back</td>
        <td><button id="printPageButton" onClick="window.print();">Print Report</button></td>
        
      </tr>
    </table>
 
 </table>             

<br />

 
<table align="center" border="1">
                                         <!--  table details -->
        <tr> 
            <th align="center"><label>Sl No. &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>GP/Ward Name &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Centre Code &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Centre Name &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Centre Address &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Lati/Longi centre &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Lati/Longi Visited &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Data send distance &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Data send Address &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Data send Date & Time &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
        </tr>
        
        <?php
		$serialno=0;
		$c=0;
		$d=0;
             $result3=mysql_query("select centre_code from centre_detailss where sector_code='$sector_code' and project_code=$project_code");
			 while($row=mysql_fetch_array($result3,MYSQL_NUM))
			 {
				// echo $row[0];
				 $c++;
				 while($c>0)
				 {
					$result4=mysql_query("SELECT centre_code,centre_name,centre_address,centre_latitude,centre_longitude,gp_ward_name 
												 FROM centre_detailss  
                                                   INNER JOIN gp_ward_details
												      ON centre_detailss.gp_ward_code=gp_ward_details.gp_ward_code                                                           
													WHERE centre_code=$row[0]");
					while($row2=mysql_fetch_array($result4,MYSQL_NUM))
					{
						//echo $row2[1];
			  			$d++;
				         while($d>0)
						 {
	$result5=mysql_query("select * from assignment_data where date(assignment_date_time) >='$from' and date(assignment_date_time) <='$to' and  centre_code='$row2[0]'");
					  while($row5=mysql_fetch_array($result5,MYSQL_NUM))
					  {
						  //$distance=get_meters_between_points($row2[3],$row2[4],$row5[6],$row5[7]). " Meters<br>";
						  $distance=number_format (get_meters_between_points($row2[3],$row2[4],$row5[6],$row5[7]),3,'.',''). " Meters<br>";
						 // echo $row5[1];
						  $a++;
						  while($a>0)
						  {
							  
							  $result6=mysql_query("select * from supervisor where sup_code='$row5[3]'");
							  while($row6=mysql_fetch_array($result6,MYSQL_NUM))  //supervisor details table
							  {
								 // echo $row6[2];
								  $serialno++;
								  ?>
                                     <tr>
                                           <td align="center"><?php echo $serialno;?></td>
                                           <td><?php echo $row2[5];?></td>
                                           <td><?php echo $row2[0];?></td>
                                           <td><?php echo $row2[1];?></td>
                                           <td><?php echo $row2[2];?></td>
                                           <td><?php echo $row2[3]." / ".$row2[4];?></td>
                                          
                                           <td><?php echo $row5[6]." / ".$row5[7];?></td> 
                                           <td><?php echo $distance;?></td>
                                           <td><?php echo $row5[8];?></td>
                                           <td><?php echo $row5[1];?></td> 
                                    </tr>                   
                                                       
                                  <?php
							  }
							  mysql_free_result($result6);
							$a--;  
						  }
					  }
							 $d--;
						 }
					}
				  $c--;
				 }
			 }
			   
				 mysql_free_result($result5);
				 mysql_free_result($result4);
				 mysql_free_result($result3);
				  
		?>
        
</table>

	
    <br /><br /><br /><br />
<table align="center" border="1">
                                         <!-- assignment data details 2 number table  -->
        <tr> 
            <th align="center"><label>Uploaded image </label></th>
            <th align="center"><label>AWC building exists </label></th>
            <th align="center"><label>AWC found </label></th>
            <th align="center"><label>Total SNP Benefi.. </label></th>
            <th align="center"><label>Benefi served wth SNP </label></th>
            <th align="center"><label>Total child(7mnth to 6yr) </label></th>
            <th align="center"><label>Child served(7mnth to 6yr) </label></th>
            <th align="center"><label>Total child(3yr to 6yr) </label></th>
            <th align="center"><label>Child in PSE(3yr to 6yr) </label></th>
            <th align="center"><label>Regis prsnt assi</label></th>
            <th align="center"><label>Mothers meeting </label></th>
            
        </tr>
                 <?php
		$serialno=0;
		$c=0;
		$d=0;
             $result3=mysql_query("select centre_code from centre_detailss where sector_code='$sector_code' and project_code=$project_code");
			 while($row=mysql_fetch_array($result3,MYSQL_NUM))
			 {
				 //echo $row[0];
				 $c++;
				 while($c>0)
				 {
					$result4=mysql_query("SELECT centre_code,centre_name,centre_address,centre_latitude,centre_longitude,gp_ward_name 
												 FROM centre_detailss    
                                                   INNER JOIN gp_ward_details
												      ON centre_detailss.gp_ward_code=gp_ward_details.gp_ward_code                                                           
													WHERE centre_code=$row[0]");
					while($row2=mysql_fetch_array($result4,MYSQL_NUM))
					{
						//echo $row2[1];
			  			$d++;
				         while($d>0)
						 {
	$result5=mysql_query("select * from assignment_data where date(assignment_date_time) >='$from' and date(assignment_date_time) <='$to' and  centre_code='$row2[0]'");
					  while($row5=mysql_fetch_array($result5,MYSQL_NUM))
					  {
						  $distance=get_meters_between_points($row2[3],$row2[4],$row5[6],$row5[7]). " Meters<br>";
						//  echo $row5[1];
						  $a++;
						  while($a>0)
						  {
							  
							  $reqult6=mysql_query("select * from supervisor where sup_code='$row5[3]'");
							  while($row6=mysql_fetch_array($reqult6,MYSQL_NUM))  //supervisor details table
							  {
								 // echo $row6[2];
								  $serialno++;
								  ?>
                                     <tr>  
                                       <td align="center"><img src="VisitedImage/<?php echo $row5[9];?>" height="50" width="120"/></td>
                                       <td align="center"><?php echo $row5[10];?></td>
                                       <td align="center"><?php echo $row5[11];?></td>
                                       <td align="center"><?php echo $row5[12];?></td>
                                       <td align="center"><?php echo $row5[13];?></td>
                                       <td align="center"><?php echo $row5[14];?></td> 
                                       <td align="center"><?php echo $row5[15];?></td>
                                       <td align="center"><?php echo $row5[16];?></td>
                                       <td align="center"><?php echo $row5[17];?></td>
                                       <td align="center"><?php echo $row5[18];?></td>
                                       <td align="center"><?php echo $row5[19];?></td>
                                          
                                 </tr>             
                                                       
                                  <?php
							  }
							  mysql_free_result($reqult6);
							$a--;  
						  }
					  }
							 $d--;
						 }
					}
				  $c--;
				 }
			 }
			     
				 mysql_free_result($result5);
				 mysql_free_result($result4);
				 mysql_free_result($result3);
		?>     
    
</table>



<br /><br /><br /><br />
<table align="center" border="1">
                                         <!-- assignment data details -->
        <tr> 
            
            
            <th align="center"><label>child below 5yr weighed</label></th>
            <th align="center"><label>total child below 5yr</label></th>
            <th align="center"><label>malnourished child moderate</label></th>
            <th align="center"><label>malno_child_severe</label></th>
            <th align="center"><label>eece curriculom followed</label></th>
            
             <th align="center"><label>Supervisor Name</label></th>
            <th align="center"><label>Supervisor  Email</label></th>
            <th align="center"><label>Supervisor Mobile No.</label></th>
            <th align="center"><label>Image of Supervisor</label></th>
        </tr>
                     <?php
		$serialno=0;
		$c=0;
		$d=0;
             $result3=mysql_query("select centre_code from centre_detailss where sector_code='$sector_code' and project_code=$project_code");
			 while($row=mysql_fetch_array($result3,MYSQL_NUM))
			 {
				 //echo $row[0];
				 $c++;
				 while($c>0)
				 {
					$result4=mysql_query("SELECT centre_code,centre_name,centre_address,centre_latitude,centre_longitude,gp_ward_name 
												 FROM centre_detailss    
                                                   INNER JOIN gp_ward_details
												      ON centre_detailss.gp_ward_code=gp_ward_details.gp_ward_code                                                           
													WHERE centre_code=$row[0]");
					while($row2=mysql_fetch_array($result4,MYSQL_NUM))
					{
						//echo $row2[1];
			  			$d++;
				         while($d>0)
						 {
	$result5=mysql_query("select * from assignment_data where date(assignment_date_time) >='$from' and date(assignment_date_time) <='$to' and  centre_code='$row2[0]'");
					  while($row5=mysql_fetch_array($result5,MYSQL_NUM))
					  {
						  $distance=get_meters_between_points($row2[3],$row2[4],$row5[6],$row5[7]). " Meters<br>";
						//  echo $row5[1];
						  $a++;
						  while($a>0)
						  {
							  
							  $reqult6=mysql_query("select * from supervisor where sup_code='$row5[3]'");
							  while($row6=mysql_fetch_array($reqult6,MYSQL_NUM))  //supervisor details table
							  {
								 // echo $row6[2];
								  $serialno++;
								  ?>
                                     <tr>  
                                       <td align="center"><?php echo $row5[20];?></td>
                                       <td align="center"><?php echo $row5[21];?></td>
                                       <td align="center"><?php echo $row5[22];?></td> 
                                       <td align="center"><?php echo $row5[23];?></td>
                                       <td align="center"><?php echo $row5[24];?></td>
                                       
                                       <td align="center"><?php echo $row6[2]?></td>
                                       <td align="center"><?php echo $row6[5]?></td>
                                       <td align="center"><?php echo $row6[6]?></td>
                                      <td align="center"><img src="nic_icds_app/<?php echo $row6[8];?>" height="50" width="50"/></td>
                                   </tr>    
                                                       
                                  <?php
							  }
							  mysql_free_result($reqult6);
							$a--;  
						  }
					  }
							 $d--;
						 }
					}
				  $c--;
				 }
			 }
			     
				 mysql_free_result($result5);
				 mysql_free_result($result4);
				 mysql_free_result($result3);
		?>   
         
</table>              
    		 
<?php
}
else
{
?>
<h2><b><label><p align="center">ICDS, Jalpaiguri District ,West Bengal<br>
                                Centre Notvisited</p></label></b></h2>
	 

<table align="center">
    <table align="left">
       <tr>
		   <td><?php echo "Report From: <b>".$from ."</b>   To: <b>".$to."</b>"?></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Block Name :<?php echo $block_name;?></td>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td>Project Name : <?php echo $project_name;?></td>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td>Sector Name :<?php echo $sector_name;?></td>
            
         </tr>
    </table>
    <table align="center">
      <tr>
      <td><a href="index.php">Go Back</td>
        <td><button id="printPageButton" onClick="window.print();">Print Report</button></td>
        
      </tr>
    </table>
 
 </table>             


<br />
<table align="center" border="1">                                         <!--  table details -->
        <tr>
            <th align="center"><label>Sl No. &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Gp/Ward Name &nbsp;&nbsp;&nbsp;&nbsp;</label></th> 
            <th align="center"><label>Centre Code &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Centre Name &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Centre Address &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Lati/Longi centre &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Supervisor Name &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Supervisor Emamil &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Supervisor Mobile No. &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Image of Supervisor  &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
           </tr>
           <?php
             $c=0;
			 $d=0;
			 $serialNo=0;
			 $centre_details_centre_code=array();
			 $assign_data_centre_code=array();
			 
			 $result11=mysql_query("select centre_code from centre_detailss where sector_code='$sector_code' and project_code=$project_code");
			 while($row=mysql_fetch_array($result11,MYSQL_NUM))
			 {
			   	 //echo $row[0];
				  $c++;
				 while($c>0)
				 {
					$result4=mysql_query("SELECT centre_code,centre_name,centre_address,centre_latitude,centre_longitude,gp_ward_name,sup_code  
												 FROM centre_detailss    
                                                   INNER JOIN gp_ward_details
												      ON centre_detailss.gp_ward_code=gp_ward_details.gp_ward_code                                                           
													WHERE centre_code=$row[0]");
					while($row2=mysql_fetch_array($result4,MYSQL_NUM))
					{
						//echo "cen code".$row2[1];
						$centre_details_centre_code=$row2[0];
						$d++;
						while($d>0)
						{
	$assign_data_cCode=mysql_query("select centre_code from assignment_data where date(assignment_date_time) >='$from' and date(assignment_date_time) <='$to' and  centre_code='$row2[0]'");
                     while($row3=mysql_fetch_array($assign_data_cCode,MYSQL_NUM))
					 {
						 //echo "ass code".$row3[0];
						 $assign_data_centre_code=$row3[0]; 
					 }
					 if($centre_details_centre_code!=$assign_data_centre_code)
		             {
						$sup_details=mysql_query("select * from supervisor where sup_code='$row2[6]'");
  	    				while($row4=mysql_fetch_array($sup_details,MYSQL_NUM))  //supervisor details table
					    {
							//echo $row4[2];
								$serialNo++;
							?>
                            <tr>
                                 <td align="center"><?php echo $serialNo;?></td>
                                 <td align="center"><?php echo $row2[5];?></td>
                                 
                                 <td align="center"><?php echo $row2[0];?></td>
                                 
                                  <td align="center"><?php echo $row2[1];?></td>
                                 <td align="center"><?php echo $row2[2];?></td>
                                 
                                 
                                 <td><?php echo $row2[3]." / ".$row2[3];?></td>
                                 
                                 <td align="center"><?php echo $row4[2];?></td> 
                                 <td align="center"><?php echo $row4[5];?></td> 
                                 <td align="center"><?php echo $row4[6];?></td> 
                                 <td align="center"><img src="nic_icds_app/<?php echo $row4[8];?>" height="50" width="50"/></td>
                            </tr>
                        <?php
							
						}
					 }
						  $d--;	
						}
					}
				 $c--;
				 }
			 }
		   
		   ?> 
           
            
         
<?php	
}
?>