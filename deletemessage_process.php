<?php
	include('includes/dbconn.php');
	$customer_id = $_POST['customer_id'];
	$sql=("DELETE FROM tbl_customer WHERE customer_id ='$customer_id'") or die(mysqli_error());
	$result=mysqli_query($con, $sql);
?>