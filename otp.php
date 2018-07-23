<?php

	$username = "barun8m@gmail.com";
	$hash = "34de841059872d97a77d6ca0e77351d801090343454006244f0496be1d7c761c";

	 

 $ph_num="9679662070";
$code="abc44AAS";
echo $ph_num.$code;
	// Data for text message. This is the text message data.  
    
	$sender = "MTICDS"; // This is who the message appears to be from.
	$numbers =$ph_num; // A single number or a comma-seperated list of numbers
	$message =$code."is your One Time Password (OTP) for verification,please OTP to proced ICDS,Jalpaiguri".$numbers.".";  
    
	// 612 chars or less
	// A single number or a comma-seperated list of numbers  
    
	$message = urlencode($message);
	//$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;   
    
	$data = "username=DEMOTRANS1&api_key=e8462b3bcd81b2f9f52b9454f312cd3b&sender=INFORM&to=".$numbers."&message=".$message;


	$ch = curl_init('http://msg.infoskysolutions.com/API/WebSMS/Http/v2.3.6/api.php?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); // This is the result from the API
	
	echo $result;
	curl_close($ch);
?>