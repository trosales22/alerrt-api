<?php
require 'database.php';
date_default_timezone_set("Asia/Manila");
updateStatusOfUser();

function updateStatusOfUser(){
	global $con;
	
	$userID = $_GET['userID'];
	$status = $_GET['status'];

	$query = "UPDATE tblusers SET UserStatus=? WHERE ID=?";

	$stmt = mysqli_prepare($con,$query);

	mysqli_stmt_bind_param($stmt,"ss",$status,$userID);

	mysqli_stmt_execute($stmt);

	$check = mysqli_stmt_affected_rows($stmt);

	if($check == 1){
		echo "<script type='text/javascript'>alert('Successfully updated status of user!'); window.location='homepage/users.php';</script>";
	}else{
		echo "<script type='text/javascript'>alert('No changes can be made!'); window.location='homepage/users.php';</script>";
	}

	mysqli_stmt_close($stmt); 
	mysqli_close($con);
}
?>