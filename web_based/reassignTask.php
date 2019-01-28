<?php
require 'database.php';
date_default_timezone_set("Asia/Manila");
reassignTask();

function reassignTask(){
	global $con;

	$agencyID = $_POST['agency_id'];
	$postID = $_GET['postID'];
	$statusType = 'Reassigned';
	$statusBy = $_GET['loggedInUser'];
	$dateAndTimeReassigned = date('F d, Y | h:i A');

	//add status for notification
	$query = "INSERT INTO tblstatus(StatusPostID, StatusType, StatusBy, StatusDateAndTime) VALUES (?,?,?,?)";

	$stmt = mysqli_prepare($con,$query);

	mysqli_stmt_bind_param($stmt,"ssss",$postID, $statusType, $statusBy, $dateAndTimeReassigned);

	mysqli_stmt_execute($stmt);

	//reassign task to other agency
	$queryForReassignTask = "UPDATE tblposts SET TopicAgencyID=? WHERE TopicID=?";
	$statementForReassignTask = mysqli_prepare($con,$queryForReassignTask);

	mysqli_stmt_bind_param($statementForReassignTask, "ss", $agencyID, $postID);

	mysqli_stmt_execute($statementForReassignTask);

	//check add status for notification
	$check = mysqli_stmt_affected_rows($stmt);

	if($check == 1){
		echo "<script type='text/javascript'>alert('Report has been assigned to other agency successfully!'); window.location='homepage/newsfeed.php';</script>";
	}else{
		echo "<script type='text/javascript'>alert('Failed to assign task/report to other agency. Please try again!');</script>";
	}

	mysqli_stmt_close($stmt);

	mysqli_close($con);
}

?>