<div class="widget">
 <h2>Project Report</h2>
 <div class="inner">




 
<script type="text/javascript">
function handleSelect(elm){
    window.location = elm.value+".php"; /* .html if html file */
}
</script>	 
	 
   <ul>
	   <li>
			Visited details for ICDS centre
	  
			<select name="sample" onchange="javascript:handleSelect(this)">
			<option>select</option>
			<!--<option value="report_generate_form">DPO/CDPO/Superv.. on a particular date</option>-->
			<option value="report_generate_form">DPO/CDPO/Supervisor by date range</option>
			</select>
       </li>
	   
	   
	   
	    <li>
			Total No.of visit made by a visitor:
	  
			<select name="sample" onchange="javascript:handleSelect(this)">
			<option>select</option>
			<option value="total_visit_made_by_visitor">DPO/CDPO/Supervisor by date range</option>
			<!--<option value="total_visit_made_by_visitor">DPO/CDPO/Supervisor particular month</option>-->
			
			</select>
       </li>

	   
		 <li>
		     Total No.of AWCs open out of the total visit made by a visitor
	    
		   <select name="sample" onchange="javascript:handleSelect(this)">
			<option>select</option>
			<option value=" awc_open_out_of_total_visit">DPO/CDPO/Supervisor by date range</option>
			<!-- <option value=" awc_open_out_of_total_visit">DPO/CDPO/Supervisor particular month</option> -->
			
			</select>
       </li>

		 
	   <li>
		     Total No.of child 
	       <select name="sample" onchange="javascript:handleSelect(this)">
		 	    <option>select</option>
		    	<option value="morning_snaks">Morning snaks(7mn-6yr) by date range</option>
			    <!--<option value="morning_snaks">Morning snaks(7mn-6yr)particular month</option>-->

			   <option value="pse_3yr_6yr">PSE(3yrs-6yrs) by date range</option>
			    <!--<option value="pse_3yr_6yr">PSE(3yrs-6yrs)particular month</option>-->

			   <option value="child_weight">Weighed(below 5years)</option>

			   <option value="malnute_child">Malnourished(below 5years)</option>
		   </select>
       </li>
	   <li>
		     Total No.of
	       <select name="sample" onchange="javascript:handleSelect(this)">
		 	    <option>select</option>
		    	<option value="mothers_meeting">Mothers meeting last month </option>

			    <option value="ecce_centre">AWCs following ECCE curriculum</option>
		   </select>
       </li>
	   <li>
		     Total No.of Benef..served with SNP
	       <select name="sample" onchange="javascript:handleSelect(this)">
		 	    <option>select</option>
		    	<option value="benef_served_with_snp">By date range</option>
			   <!-- <option value="benef_served_with_snp">On a particular month</option>-->
		   </select>
       </li>

 </ul>	 
	 
  </div>
</div>
