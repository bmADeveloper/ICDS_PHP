<?php
 
include 'main/init.php';
protect_page();
include 'includes/overall/header.php' ; 
session_start();
/*
mysql_connect("localhost", "root", "") or
    die("Could not connect: " . mysql_error());
mysql_select_db("mydatabase");
*/
   
				$block_dist_code=trim($user_data['dpo_cdpo_code']);
                      
					     $check_block_code=mysql_query("select block_code from block_details where block_code='$block_dist_code'");//block code
						 $count=mysql_fetch_array($check_block_code,MYSQL_NUM);
						 $c=$count[0];
						  
					  $check_dist_code=mysql_query("select block_code from block_details where dist_code='$block_dist_code'");//dist code
						 $count2=mysql_fetch_array($check_dist_code,MYSQL_NUM);
					      $c2=$count2[0];
						  //echo $count2[0];
					  
					  
					 
					 
					 
					 
					 
					 
					 
				  
			
?>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
 <script>
           //gp_ward_wise report generate
function clearform()
{
    document.getElementById("form").value=""; //don't forget to set the textbox id
    document.getElementById("to").value="";
}		   
		   
		   
 function valid_empty()
{
	     var p_code= fm.p_code.value; 
		 
         if(p_code.length==0)
		 {
			  alert("must be enter your name !!!");
		      fm.p_code.focus();
			  return(false);
		 }
	 		  
}

					 function getSector(val)
					 {
						 $.ajax({
							 type:"POST",
							 url:"getSector.php",
							 data:'p_code2='+val,
							 success:function(data)
							 {
								 $("#sectorlist").html(data);
							 }
						 });
					 }
					   function getGpWard(val)
					 {
						 $.ajax({
							 type:"POST",
							 url:"gp_ward.php",
							 data:'p_code='+val,
							 success:function(data)
							 {
								 $("#gpwardlist").html(data);
							 }
						 });
					 }
					 
					 function getProjectList(val)
					 {
						$.ajax({type:"POST",
							     url:"projectlist.php",
								 data:'block_code='+val,
								 success:function(data)
								 {
									 $("#projectlist").html(data);
								  }
								}); 
					  }
					  
					  
					  function getProjectList_Sectorwise(val)
					 {
						$.ajax({type:"POST",
							     url:"projectlist.php",
								 data:'block_code='+val,
								 success:function(data)
								 {
									 $("#projectlist_sec").html(data);
								  }
								}); 
					  }
					 
					  function  getProjectList_gpwardwise(val)
					 {
						$.ajax({type:"POST",
							     url:"projectlist.php",
								 data:'block_code='+val,
								 success:function(data)
								 {
									 $("#projectlist_gpword").html(data);
								  }
								}); 
					  }
  
     function visible_gone(x)
     {
       if(x==1)
	   {
		     document.getElementById("visible_gpword").style.display='block';
		     document.getElementById("visible_sector").style.display='none'; 
		     document.getElementById("visible_project").style.display='none';
			 document.getElementById("visible_block").style.display='none';
		     return;
	   }
	   else if(x==2)
	   {
		     document.getElementById("visible_gpword").style.display='none';
		     document.getElementById("visible_sector").style.display='block'; 
		     document.getElementById("visible_project").style.display='none'; 
			  document.getElementById("visible_block").style.display='none';
		   return;
	   }
	  
	 else if(x==3)
	 {
	   	    
			document.getElementById("visible_gpword").style.display='none';
		     document.getElementById("visible_sector").style.display='none'; 
		     document.getElementById("visible_project").style.display='none';
			  document.getElementById("visible_block").style.display='block';
	 }
	   else
	   {
		     document.getElementById("visible_gpword").style.display='none';
		     document.getElementById("visible_sector").style.display='none'; 
		     document.getElementById("visible_project").style.display='block'; 
			  document.getElementById("visible_block").style.display='none';
			 return;
	   }
     }
     
	 
 </script>
 
 <br>
<h1><p align="center">::<u>Report</u>::</p></h1>
 

<table align="center">
  <tr>
     <?php 
	   if($block_dist_code=="19328")
	   {
	?>
         <td><input type="button" value="Block wise report" id="block_wise" onclick="visible_gone(3)"/> </td>   
	<?php
	   } 
	 ?>

     
     <td><input type="button" value="Project wise report" id="project_wise" onclick="visible_gone(0)"/> </td>
     <td><input type="button" value="Project & gp/ward wise report" id="gp_ward_wise" onclick="visible_gone(1)"/> </td>
     <td><input type="button" value="Project & Sector wise report " id="sector_wise" onclick="visible_gone(2)"/> </td>
     
    
  </tr>
</table>


<br><br>

                                           <!--Project & Gp/Ward wise report  -->
 <form name="fm"  action="gp_ward_wise_report_generate.php" method="post" onSubmit="valid_empty();">
 
<div id="visible_gpword" style="display:none">

    <h1><p align="center">
      <label>Block Name:</label>
                               <select name="block_codegpward" id="block_code" onChange="getProjectList_gpwardwise(this.value);" required>
										  <option value=""></option> 	
                                          								   
												<?php               // only one block name show here
												 if($c>'0')
					 							 { 
					                            	$result23 = mysql_query("select block_name,block_code from block_details where block_code='$block_dist_code'"); 
													while ($row23 = mysql_fetch_array($result23, MYSQL_NUM)) {
												?>
										    <option value=" <?php echo $row23[1];?>"><?php  echo $row23[0];?></option> 
												  <?php 
													 }
													 }
													 mysql_free_result($result23);
													
												   
												
												?>	
                                                
                                                
													<?php              //DPO only allow this list ...all block name list
												 	if($c2>'0')
												    {
					                                    $result22 = mysql_query("select block_name,block_code from block_details where dist_code='$block_dist_code'");  
														while ($row22 = mysql_fetch_array($result22, MYSQL_NUM)) {
														//$blocklist_name=$row22[0];  
							                            //$_SESSION['BlockName'] =$blocklist_name;
									                ?>
										    <option value=" <?php echo $row22[1];?>"><?php  echo $row22[0];?></option> 
												  <?php 
													 }
													 }
													 mysql_free_result($result22);
													
												  ?>
									  </select>
    </p></h1>
    <br> 
    
       <table align="center">
             
            <tr><td></td></tr>
            <tr><td></td></tr>
            <tr>
               
               <td>Report From*: 
              
               <input style="width:169px;" type="date" id="from" name="from_date" placeholder="From" required></td>
                
            
             
               <td>To*: <input style="width:169px;" type="date" id="to" name="to_date" placeholder="To" required></td>
            </tr> 
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr>
                    <td><label>Project Name:</label> 
                 <select name="proj_code" id="projectlist_gpword" onchange="getGpWard(this.value);" required>
                      <option value="">Project Name</option>
                         
                  </select>
                </td>
                </td>
           <td><label>GP/Ward Name:</label> 
               
                       <select name="gpward_code" id="gpwardlist" required>
                         <option value="">select gp/ward</option>
                        </select> 
                 </td>
                
             </tr>
            
            <tr></tr>
            <tr></tr>
            
            <tr>
            <td><input type="radio" name="visit_unvisit" value="visit" checked="checked"/>Visited <input type="radio" name="visit_unvisit" value="unvisit" />Notvisited</td>
            </tr>
            <tr></tr>
            <tr></tr>
            
            <tr>
                <td></td>
                <td><input type="submit" onClick="clearform();" name="submit" value="Report" >
                      <input type="reset" value="Clean"/></td>
             </tr>
       </table>
   
     </form>
</div>


                                        <!--Project & Sector wise report -->
    <form name="fm"  action="sector_wise_report_generate.php" method="post" onSubmit="valid_empty();">                                      
                                        
<div id="visible_sector" style="display:none">

<h1><p align="center">

                 
                               <label>Block Name:</label>
                               <select name="block_codeSector" id="block_code" onChange="getProjectList_Sectorwise(this.value);" required>
										  <option value=""></option> 	
                                          								   
												<?php               // only one block name show here
												 if($c>'0')
					 							 { 
					                            	$result23 = mysql_query("select block_name,block_code from block_details where block_code='$block_dist_code'"); 
													while ($row23 = mysql_fetch_array($result23, MYSQL_NUM)) {
												?>
										    <option value=" <?php echo $row23[1];?>"><?php  echo $row23[0];?></option> 
												  <?php 
													 }
													 }
													 mysql_free_result($result23);
													
												   
												
												?>	
                                                
                                                
													<?php              //DPO only allow this list ...all block name list
												 	if($c2>'0')
												    {
					                                    $result22 = mysql_query("select block_name,block_code from block_details where dist_code='$block_dist_code'");  
														while ($row22 = mysql_fetch_array($result22, MYSQL_NUM)) {
														//$blocklist_name=$row22[0];  
							                            //$_SESSION['BlockName'] =$blocklist_name;
									                ?>
										    <option value=" <?php echo $row22[1];?>"><?php  echo $row22[0];?></option> 
												  <?php 
													 }
													 }
													 mysql_free_result($result22);
													
												  ?>
									  </select>
								 


</p></h1>
    <br> 
  
       <table align="center">
             
            <tr><td></td></tr>
            <tr><td></td></tr>
            <tr>
               
               <td>Report From*: 
              
               <input style="width:169px;" type="date" name="from_date" placeholder="From" required></td>
                
            
             
               <td>To*: <input style="width:169px;" type="date" name="to_date" placeholder="To" required></td>
            </tr> 
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr>
               <td><label>Project Name:</label> 
                 <select name="pro_code" id="projectlist_sec" onchange="getSector(this.value);" required>
                      <option value="">Project Name</option>
                         
                  </select>
                </td>
           
               <td><label>Sector Name:</label> 
                       <select name="sector_code" id="sectorlist">
                         <option value="">select sector</option>
                        </select> 
                 </td> 
             </tr>
             
            <tr></tr>
            <tr></tr>
            
            <tr>
            
            <td><input type="radio" name="visit_unvisit" value="visit" checked="checked"/>Visited <input type="radio" name="visit_unvisit" value="unvisit" />Notvisited</td>
            </tr>
            <tr></tr>
            <tr></tr>
            
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Report">
                      <input type="reset" value="Clean"/></td>
             </tr>
       </table>
   
     </form>


</div>




                                             <!-- Project wise report generate -->

<form name="fm"  action="project_wise_report_generate.php" method="post" onSubmit="valid_empty();">
<div id="visible_project" style="display:none">

         <h1><p align="center">
                        <label>Block Name:</label>
                               <select name="block_code" id="block_code" onChange="getProjectList(this.value);" required>
										  <option value="">Your Block</option> 	
                                          								   
												<?php               // only one block name show here
												 if($c>'0')
					 							 { 
					                            	$result23 = mysql_query("select block_name,block_code from block_details where block_code='$block_dist_code'"); 
													while ($row23 = mysql_fetch_array($result23, MYSQL_NUM)) {
														//$blocklist_name=$row22[0];  //report generate call this block name
							                            //$_SESSION['BlockName'] =$blocklist_name;
												?>
										    <option value=" <?php echo $row23[1];?>"><?php  echo $row23[0];?></option> 
												  <?php 
													 }
													 }
													 mysql_free_result($result23);
													
												   
												
												?>	
                                                
                                                
													<?php              //DPO only allow this list ...all block name list
												 	if($c2>'0')
												    {
					                                    $result22 = mysql_query("select block_name,block_code from block_details where dist_code='$block_dist_code'");  
														while ($row22 = mysql_fetch_array($result22, MYSQL_NUM)) {
														//$blocklist_name=$row22[0];  //report generate call this block name
							                            //$_SESSION['BlockName'] =$blocklist_name;
									                ?>
										    <option value=" <?php echo $row22[1];?>"><?php  echo $row22[0];?></option> 
												  <?php 
													 }
													 }
													 mysql_free_result($result22);
													
												  ?>
									  </select>
								 
      
        
        
        </p></h1>
            
        

    <br> 
    
       <table align="center">
             
            <tr><td></td></tr>
            <tr><td></td></tr>
            <tr>
               
               <td>Report From*: 
              
               <input style="width:169px;" type="date" name="from_date" placeholder="From" required></td>
                
            
             
               <td>To*: <input style="width:169px;" type="date" name="to_date" placeholder="To" required></td>
            </tr> 
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr>
                <td><label>Project Name:</label> 
                 <select name="p_code3" id="projectlist" required>
                      <option value="">Your Project Name</option>
                         
                  </select>
                </td>
             </tr>
             
            <tr></tr>
            <tr></tr>
            
            <tr>
            
            <td><input type="radio" name="visit_unvisit" value="visit" checked="checked"/>Visited <input type="radio" name="visit_unvisit" value="unvisit" />Notvisited</td>
            </tr>
            <tr></tr>
            <tr></tr>
            
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Report">
                      <input type="reset" value="Clean"/></td>
             </tr>
       </table>
   
     </form>

</div>







                                                         <!-- Block wise report generate -->
  <form name="fm"  action="block_wise_report_generate.php" method="post" onSubmit="valid_empty();">                                                 
        <div id="visible_block" style="display:none">

         <h1><p align="center">
                        <label>Block Name:</label>
                               <select name="block_code" id="block_code" onChange="getProjectList(this.value);" required>
										  <option value="">Your Block</option> 	
                                          								   
												<?php               // only one block name show here
												 if($c>'0')
					 							 { 
					                            	$result23 = mysql_query("select block_name,block_code from block_details where block_code='$block_dist_code'"); 
													while ($row23 = mysql_fetch_array($result23, MYSQL_NUM)) {
												?>
										    <option value=" <?php echo $row23[1];?>"><?php  echo $row23[0];?></option> 
												  <?php 
													 }
													 }
													 mysql_free_result($result23);
													
												   
												
												?>	
                                                
                                                
													<?php              //DPO only allow this list ...all block name list
												 	if($c2>'0')
												    {
					                                    $result22 = mysql_query("select block_name,block_code from block_details where dist_code='$block_dist_code'");  
														while ($row22 = mysql_fetch_array($result22, MYSQL_NUM)) {
														//$blocklist_name=$row22[0];  
							                            //$_SESSION['BlockName'] =$blocklist_name;
									                ?>
										    <option value=" <?php echo $row22[1];?>"><?php  echo $row22[0];?></option> 
												  <?php 
													 }
													 }
													 mysql_free_result($result22);
													
												  ?>
									  </select>
								 
      
        
        
        </p></h1>
            
        

    <br> 
    
       <table align="center">
             
            <tr><td></td></tr>
            <tr><td></td></tr>
            <tr>
               
               <td>Report From*: 
              
               <input style="width:169px;" type="date" name="from_date" placeholder="From" required></td>
                
            
             
               <td>To*: <input style="width:169px;" type="date" name="to_date" placeholder="To" required></td>
            </tr> 
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            
            
            <tr>
            
            <td><input type="radio" name="visit_unvisit" value="visit" checked="checked"/>Visited <input type="radio" name="visit_unvisit" value="unvisit" />Notvisited</td>
            </tr>
            <tr></tr>
            <tr></tr>
            
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Report">
                      <input type="reset" value="Clean"/></td>
             </tr>
       </table>
   
     </form>

</div>






<?php include 'includes/overall/footer.php'  ?>    