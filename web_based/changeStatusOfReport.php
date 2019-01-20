<?php
require 'database.php';
date_default_timezone_set("Asia/Manila");
changeStatusOfReport();

function changeStatusOfReport(){
	global $con;

	$postID = $_GET['postID'];
	$statusType = $_GET['statusType'];
	$statusBy = $_GET['loggedInUser'];
	$dateAndTimeChanged = date('F d, Y | h:i A');

	//add status for notification
	$query = "INSERT INTO tblstatus(StatusPostID, StatusType, StatusBy, StatusDateAndTime) VALUES (?,?,?,?)";

	$stmt = mysqli_prepare($con,$query);

	mysqli_stmt_bind_param($stmt,"ssss",$postID, $statusType, $statusBy, $dateAndTimeChanged);

	mysqli_stmt_execute($stmt);

	//update status of report
	$queryForUpdatingStatus = "UPDATE tblposts SET TopicStatus=? WHERE TopicID=?";
	$statementForUpdatingStatus = mysqli_prepare($con,$queryForUpdatingStatus);

	mysqli_stmt_bind_param($statementForUpdatingStatus, "ss", $statusType, $postID);

	mysqli_stmt_execute($statementForUpdatingStatus);

	//check add status for notification
	$check = mysqli_stmt_affected_rows($stmt);

	if($check == 1){
		echo "<script type='text/javascript'>alert('Report has been updated successfully!'); window.location='homepage/newsfeed.php';</script>";
	}else{
		echo "<script type='text/javascript'>alert('Failed to update status of report. Please try again!');</script>";
	}

	mysqli_stmt_close($stmt);

	mysqli_close($con);
}

?>