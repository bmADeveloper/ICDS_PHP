<?php 
   $error="connection problem check database connection";
   mysql_connect('localhost','icdsjalp','Icds@jal18') or die($error);
   mysql_select_db('icdsjalp_mtms') or die($error);
    
	 
?>