<?php
	
	include "connection.php";      // Not compalsory....

	session_start();
	$log = $_SESSION['log'];
		
		$sql = "SELECT * FROM tbl_login WHERE email_id='$log'";
		$result = mysqli_query($con,$sql);
		$value = mysqli_fetch_array($result);
		
		$type = $value['type'];
	unset($_SESSION['log']);
	
	
	session_destroy();
	
	header("location:index.php");
	


?>