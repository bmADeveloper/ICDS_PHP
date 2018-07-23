<?php

	

	 

// $ph_num="9679662070";
//$code="abc44AAS22";
//echo $ph_num.$code;
	// Data for text message. This is the text message data.  
    
	$sender = "MTICDS"; // This is who the message appears to be from.
	$numbers =$ph_num; // A single number or a comma-seperated list of numbers
	$message =$code." is your One Time Password (OTP) for verification,please OTP to proceed MTMICDS,Jalpaiguri.";  
    
	// 612 chars or less
	// A single number or a comma-seperated list of numbers  
    
	$message = urlencode($message);
	//$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;   
    
$data = "username=ICDSOTP&api_key=97bcdb2e220ef8819ab0399e39c725d9&sender=MTICDS&to=$numbers&message=$message";


	$ch = curl_init('http://msg.infoskysolutions.com/API/WebSMS/Http/v2.3.6/api.php?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); // This is the result from the API
	
	echo $result;
	curl_close($ch);
?>