<?php
    function sanitize($data)
	{
		$data=trim($data);
		$data=stripslashes($data);
		$data=strip_tags($data);
		$data=mysql_real_escape_string($data);
		$data=htmlspecialchars($data);
		return $data;
	}
?>