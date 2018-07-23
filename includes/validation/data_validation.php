
--------------FILTER_VALIDATE------------------


            ::Email Filter::
            
<?php
$email="sdasd@fg.fs";
if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
     //The email address is valid.
	 
} else{
     //The email address is invalid.
}
?>

          ::String Filter::
          
<?php
    $str = "<h1>Hello World!</h1>";
    if(filter_var($str, FILTER_SANITIZE_STRING))
	{
		//The String is valid.
	 
} else{
     //The string is invalid.
}
    
?>   

           ::Integer Filter::
     
<?php
$int = 0;//$int=100;

if (filter_var($int, FILTER_VALIDATE_INT) === 0 || !filter_var($int, FILTER_VALIDATE_INT) === false) {
    echo("Integer is valid");
} else {
    echo("Integer is not valid");
}
?>


               ::IP Address Filter::

<?php
$ip = "127.0.0.1";

if (!filter_var($ip, FILTER_VALIDATE_IP) === false) {
    echo("$ip is a valid IP address");
} else {
    echo("$ip is not a valid IP address");
}
?>

           ::URL Filter::
           
           <?php
$url = "https://www.w3schools.com";

// Remove all illegal characters from a url
$url = filter_var($url, FILTER_SANITIZE_URL);

// Validate url
if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
    echo("$url is a valid URL");
} else {
    echo("$url is not a valid URL");
}
?>


             ::FILTER_VALIDATE_FLOAT::
             
             ::::



