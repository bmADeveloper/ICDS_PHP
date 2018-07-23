 <style>
@media print {
	
  #printPageButton {
    display: none;
  }
  #hideback{display:none;}
}
</style>
 <?php
 session_start();
include 'main/init.php';
protect_page();

 
   $block_code=trim($_POST['block_code']);       
   $from=trim($_POST['from_date']); 
   $to=trim($_POST['to_date']);
   $visit_unvisit=trim($_POST['visit_unvisit']);
  // echo $block_code.$from.$to.$visit_unvisit; 
   
   
    //...............................................Block Name...............................
                $result1 = mysql_query("select block_name from block_details where block_code='$block_code'");  
				while ($row = mysql_fetch_array($result1, MYSQL_NUM)) 
				{
					$block_name=$row[0];
					//echo $block_name;
				}
				 mysql_free_result($result1);
 ?>
 
<?php
if($visit_unvisit=="visit")
{
	 
?>   

<h2><b><label><p align="center">ICDS, Jalpaiguri District ,West Bengal<br>
                                Centre Visited</p></label></b></h2>
 <table align="center">
    <table align="left">
       <tr>

		   <td><?php echo "Report From: <b>".$from ."</b>   To: <b>".$to."</b>"?></td>

            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         Block Name :<strong><?php echo $block_name;?></strong></td>
           
            
         </tr>
    </table>
    <table align="center">
      <tr>
      <td><a  href="index.php" id="hideback">Go Back</td>
        <td><button id="printPageButton" onClick="window.print();">Print Report</button></td>
        
      </tr>
    </table>
 
 </table>             

<br />


<table align="center" border="1">
<tr> 
            <th align="center"><label>Sl No. &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            
            <th align="center"><label>Pro Name &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Gp/Ward Name &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            
            <th align="center"><label>Sector Name &nbsp;&nbsp;&nbsp;&nbsp;</label></th> 
            <th align="center"><label>Centre Code &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Centre Name &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Centre Address &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Lat/Long of centre &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Lat/Long uploaded &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Distance &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Uploaded Address &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Upload Date-Time &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
        </tr>
        <?php
		$c=0;
		$d=0;
		$e=0;
		$f=0;
		$serialno=0;
        $project_list=mysql_query("select * from project_details where block_code='$block_code'");
		while($row=mysql_fetch_array($project_list,MYSQL_NUM))
		{
			//echo $row[4];  // project name
			//echo $row[0];   // project code
			$c++;
			while($c>0)
			{
			   $centre_list=mysql_query("select centre_code from centre_detailss where project_code=$row[0]");
			  while ($row2 = mysql_fetch_array($centre_list, MYSQL_NUM)) 
				{
				   //echo $row2[0];   //centre code   
				   $d++;
				   while($d>0)
				   {
					 $centre_list_details=mysql_query("SELECT centre_code,centre_name,centre_address,centre_latitude,centre_longitude,gp_ward_name,sector_name 
												 FROM  centre_detailss
												   INNER JOIN gp_ward_details
												      ON centre_detailss.gp_ward_code=gp_ward_details.gp_ward_code       
                                                   INNER JOIN sector_details
												      ON  centre_detailss.sector_code=sector_details.sector_code       
                                                    
													WHERE centre_code=$row2[0]");
							
							
							  while($row3=mysql_fetch_array($centre_list_details,MYSQL_NUM))
							  {
								//echo "centre name is ".$row3[5];  
								
								$e++;
								while($e>0)
								{
									
					$assign_list=mysql_query("select * from assignment_data where date(assignment_date_time) >='$from' and date(assignment_date_time) <='$to' and  centre_code=$row3[0]");
									 while($row4=mysql_fetch_array($assign_list,MYSQL_NUM))
									 {
										 //echo $row3[0];
										 //echo $row4[3];// all ok just display here
										// $distance=get_meters_between_points($row3[3],$row3[4],$row4[6],$row4[7]). " Meters<br>";
										 //echo "sda ".$distance;
							$distance=number_format (get_meters_between_points($row3[3],$row3[4],$row4[6],$row4[7]),3,'.',''). " Meters<br>";

										 $f++;
										 while($f>0)
										 {
											 $sup_details=mysql_query("select * from supervisor where sup_code='$row4[3]'");
											  while($row5=mysql_fetch_array($sup_details,MYSQL_NUM))  //supervisor details table
							                  { 
											    //echo $row5[2];  //sup name
											      $serialno++;
												  
												  ?>
													<tr>
                                                       <td align="center"><?php echo $serialno;?></td>
													   <td><?php echo $row[4];?></td>
                                                       
                                                          <td><?php echo $row3[5];?></td>
                                                          
                                                        <td><?php echo $row3[6];?></td>
													   <td><?php echo $row3[0];?></td>
													   <td><?php echo $row3[1];?></td>
													   <td><?php echo $row3[2];?></td>      
                                                       <td><?php echo $row3[3]." / ".$row3[4];?></td>
                                                       
                                                       <td><?php echo $row4[6]." / ".$row4[7];?></td> 
														<td><?php echo $distance;?></td>
													   <td><?php echo $row4[8];?></td>
													   <td><?php echo $row4[1];?></td> 
															
													</tr>
												<?php
											  }
											  mysql_free_result($sup_details);
											 $f--;
										 }
									 }
									$e--;
							     }
							  }
					$d--;
					}
			   }
			$c--;	
			}
			
		}
		          mysql_free_result($assign_list);
				  mysql_free_result($centre_list_details);
				 mysql_free_result($centre_list);
				 mysql_free_result($project_list);
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
		$c=0;
		$d=0;
		$e=0;
		$f=0;
		$serialno=0;
        $project_list=mysql_query("select * from project_details where block_code='$block_code'");
		while($row=mysql_fetch_array($project_list,MYSQL_NUM))
		{
			//echo $row[4];  // project name
			//echo $row[0];   // project code
			$c++;
			while($c>0)
			{
			   $centre_list=mysql_query("select centre_code from centre_detailss where project_code=$row[0]");
			  while ($row2 = mysql_fetch_array($centre_list, MYSQL_NUM)) 
				{
				   //echo $row2[0];   //centre code   
				   $d++;
				   while($d>0)
				   {
					 $centre_list_details=mysql_query("SELECT centre_code,centre_name,centre_address,centre_latitude,centre_longitude,gp_ward_name,sector_name 
												 FROM  centre_detailss
												   INNER JOIN gp_ward_details
												      ON centre_detailss.gp_ward_code=gp_ward_details.gp_ward_code       
                                                   INNER JOIN sector_details
												      ON  centre_detailss.sector_code=sector_details.sector_code       
                                                    
													WHERE centre_code=$row2[0]");
							
							
							  while($row3=mysql_fetch_array($centre_list_details,MYSQL_NUM))
							  {
								//echo "centre name is ".$row3[5];  
								
								$e++;
								while($e>0)
								{
									
					$assign_list=mysql_query("select * from assignment_data where date(assignment_date_time) >='$from' and date(assignment_date_time) <='$to' and  centre_code=$row3[0]");
									 while($row4=mysql_fetch_array($assign_list,MYSQL_NUM))
									 {
										 //echo $row3[0];
										 //echo $row4[3];// all ok just display here
										 $distance=get_meters_between_points($row3[3],$row3[4],$row4[6],$row4[7]). " Meters<br>";
										 //echo "sda ".$distance;
										 $f++;
										 while($f>0)
										 {
											 $sup_details=mysql_query("select * from supervisor where sup_code='$row4[3]'");
											  while($row5=mysql_fetch_array($sup_details,MYSQL_NUM))  //supervisor details table
							                  { 
											    //echo $row5[2];  //sup name
											      $serialno++;
												  
											
												
												?>
													<tr>  
                                                           <td align="center"><img src="VisitedImage/<?php echo $row4[9];?>" height="50" width="120"/></td>
                                                           <td align="center"><?php echo $row4[10];?></td>
                                                           <td align="center"><?php echo $row4[11];?></td>
                                                           <td align="center"><?php echo $row4[12];?></td>
                                                           <td align="center"><?php echo $row4[13];?></td>
                                                           <td align="center"><?php echo $row4[14];?></td> 
                                                           <td align="center"><?php echo $row4[15];?></td>
                                                           <td align="center"><?php echo $row4[16];?></td>
                                                           <td align="center"><?php echo $row4[17];?></td>
                                                           <td align="center"><?php echo $row4[18];?></td>
                                                           <td align="center"><?php echo $row4[19];?></td>
                                                              
                                                     </tr>
												<?php
											  }
											  mysql_free_result($sup_details);
											 $f--;
										 }
									 }
									$e--;
							     }
							  }
					$d--;
					}
			   }
			$c--;	
			}
			
		}
		          mysql_free_result($assign_list);
				  mysql_free_result($centre_list_details);
				 mysql_free_result($centre_list);
				 mysql_free_result($project_list);
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
            <th align="center"><label>Image of Supervisor </label></th>
         </tr>
         
         <?php
		$c=0;
		$d=0;
		$e=0;
		$f=0;
		$serialno=0;
        $project_list=mysql_query("select * from project_details where block_code='$block_code'");
		while($row=mysql_fetch_array($project_list,MYSQL_NUM))
		{
			//echo $row[4];  // project name
			//echo $row[0];   // project code
			$c++;
			while($c>0)
			{
			   $centre_list=mysql_query("select centre_code from centre_detailss where project_code=$row[0]");
			  while ($row2 = mysql_fetch_array($centre_list, MYSQL_NUM)) 
				{
				   //echo $row2[0];   //centre code   
				   $d++;
				   while($d>0)
				   {
					 $centre_list_details=mysql_query("SELECT centre_code,centre_name,centre_address,centre_latitude,centre_longitude,gp_ward_name,sector_name 
												 FROM  centre_detailss
												   INNER JOIN gp_ward_details
												      ON centre_detailss.gp_ward_code=gp_ward_details.gp_ward_code       
                                                   INNER JOIN sector_details
												      ON  centre_detailss.sector_code=sector_details.sector_code       
                                                    
													WHERE centre_code=$row2[0]");
							
							
							  while($row3=mysql_fetch_array($centre_list_details,MYSQL_NUM))
							  {
								//echo "centre name is ".$row3[5];  
								
								$e++;
								while($e>0)
								{
									
					$assign_list=mysql_query("select * from assignment_data where date(assignment_date_time) >='$from' and date(assignment_date_time) <='$to' and  centre_code=$row3[0]");
									 while($row4=mysql_fetch_array($assign_list,MYSQL_NUM))
									 {
										 //echo $row3[0];
										 //echo $row4[3];// all ok just display here
										 $distance=get_meters_between_points($row3[3],$row3[4],$row4[6],$row4[7]). " Meters<br>";
										 //echo "sda ".$distance;
										 $f++;
										 while($f>0)
										 {
											 $sup_details=mysql_query("select * from supervisor where sup_code='$row4[3]'");
											  while($row5=mysql_fetch_array($sup_details,MYSQL_NUM))  //supervisor details table
							                  { 
											    //echo $row5[2];  //sup name
											      $serialno++;
												  
											
												
												?>
													 <tr>  
				   
                                                           <td align="center"><?php echo $row4[20];?></td>
                                                           <td align="center"><?php echo $row4[21];?></td>
                                                            <td align="center"><?php echo $row4[22];?></td> 
                                                           <td align="center"><?php echo $row4[23];?></td>
                                                           <td align="center"><?php echo $row4[24];?></td>
                                                           
                                                           <td align="center"><?php echo $row5[2]?></td>
                                                           <td align="center"><?php echo $row5[5]?></td>
                                                           <td align="center"><?php echo $row5[6]?></td>
                                                           <td align="center"><img src="nic_icds_app/<?php echo $row5[8];?>" height="50" width="50"/></td>
                                                     </tr>
                                                <?php
											  }
											  mysql_free_result($sup_details);
											 $f--;
										 }
									 }
									$e--;
							     }
							  }
					$d--;
					}
			   }
			$c--;	
			}
			
		}
		          mysql_free_result($assign_list);
				  mysql_free_result($centre_list_details);
				 mysql_free_result($centre_list);
				 mysql_free_result($project_list);
		?>
        
  </table>


 

<?php
}
else
{
	// $from=trim($_POST['from_date']); 
   //$to=trim($_POST['to_date']);
  // echo $from;
   //echo $to;
?>
<h2><b><label><p align="center">ICDS, Jalpaiguri District ,West Bengal<br>
                                Centre Notvisited</p></label></b></h2>


<table align="center">
    <table align="left">
       <tr>
        <td><?php echo "Report From: <b>".$from ."</b>   To: <b>".$to."</b>"?></td>
		   
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         Block Name :<strong><?php echo $block_name;?></strong></td>
           
            
         </tr>
    </table>
    <table align="center">
      <tr>
      <td><a  href="index.php" id="hideback">Go Back</td>
        <td><button id="printPageButton" onClick="window.print();">Print Report</button></td>
        
      </tr>
    </table>
 
 </table>  
 
   
   <table align="center" border="1">
<tr> 
            <th align="center"><label>Sl No. &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            
            <th align="center"><label>Pro Name &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Gp/Ward Name &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            
              <th align="center"><label>Sector Name &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Centre Code &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Centre Name &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Centre Address &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Lati/Longi centre &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Supervisor Name &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Supervisor Emamil &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Supervisor Mobile No. &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
            <th align="center"><label>Supervisor Image &nbsp;&nbsp;&nbsp;&nbsp;</label></th>
        </tr>
         <?php
		$c=0;
		$d=0;
		$e=0;
		$f=0;
		 
		$serial=0;
		$centre_details_centre_code=array();
		 $assign_data_centre_code=array();
        $project_list=mysql_query("select * from project_details where block_code='$block_code'");
		while($row=mysql_fetch_array($project_list,MYSQL_NUM))
		{
			//echo $row[4];  // project name
			//echo $row[0];   // project code
			$c++;
			while($c>0)
			{
			   $centre_list=mysql_query("select centre_code from centre_detailss where project_code=$row[0]");
			  while ($row2 = mysql_fetch_array($centre_list, MYSQL_NUM)) 
				{
				   //echo $row2[0];   //centre code   
				   $d++;
				   while($d>0)
				   {
					 $centre_list_details=mysql_query("SELECT centre_code,centre_name,centre_address,centre_latitude,centre_longitude,sup_code,gp_ward_name,sector_name 
												 FROM  centre_detailss
												   INNER JOIN gp_ward_details
												      ON  centre_detailss.gp_ward_code=gp_ward_details.gp_ward_code       
                                                   INNER JOIN sector_details
												      ON  centre_detailss.sector_code=sector_details.sector_code       
                                                    
													WHERE centre_code=$row2[0]");
							
							
							  while($row3=mysql_fetch_array($centre_list_details,MYSQL_NUM))
							  { 
								 $e++;
								  $centre_details_centre_code=$row3[0];
										// echo $row2[5];  //sector_details centre_details and gp_ward_details show data
										 //echo "centre er :".$centre_details_centre_code;
								   while($e>0)
								   {
									  
$assignmentdata=mysql_query("select centre_code from assignment_data where assignment_date_time >='$from' and assignment_date_time <='$to' and centre_code=$row3[0]");
											while($row4=mysql_fetch_array($assignmentdata,MYSQL_NUM))
											{
											    $assign_data_centre_code=$row4[0];
												//echo $arr2."  "; //visit centre
												//echo "Assignment er :".$assign_data_centre_code;
												
											}
											 if($centre_details_centre_code!=$assign_data_centre_code)
											 {
												//echo  $row3[0];
												$sup_details=mysql_query("select * from supervisor where sup_code='$row3[5]'");
												  while($row5=mysql_fetch_array($sup_details,MYSQL_NUM))  //supervisor details table
												  {
													 //echo $row4[2];
													 $serial++;
													  ?>
                                                        <tr>
                                                             <td align="center"><?php echo $serial;?></td>
                                                             <td align="center"><?php echo $row[4];?></td>
                                                             
                                                             <td align="center"><?php echo $row3[6];?></td>
                                                             <td align="center"><?php echo $row3[7];?></td>
                                                             <td align="center"><?php echo $row3[0];?></td>
                                                             <td align="center"><?php echo $row3[1];?></td>
                                                             <td align="center"><?php echo $row3[2];?></td>
                                                             <td><?php echo $row3[3]." / ".$row3[4];?></td>
                                                             
                                                             <td align="center"><?php echo $row5[2];?></td> 
                                                             <td align="center"><?php echo $row5[5];?></td> 
                                                             <td align="center"><?php echo $row5[6];?></td> 
                                                     <td align="center"><img src="nic_icds_app/<?php echo $row5[8];?>" height="50" width="50"/></td>
                                                        </tr>
                                                    <?php
												  }
												 mysql_free_result($sup_details);  
											 }//end if
									  
									  $e--;
									}
							  }
					$d--;
					}
			   }
			$c--;	
			}
			
		}
		   
				       
		?>
        
        
        
        
        
        </table>
   
           
<?php
}
?>