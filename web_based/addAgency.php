<?php
require 'database.php';
addAgency();

function addAgency(){
	global $con;

	$agency_caption = $_POST['agency_caption'];
	$agency_firstname = $_POST['agency_firstname'];
	$agency_lastname = $_POST['agency_lastname'];
	$agency_position = $_POST['agency_position'];
	$agency_contactNumber = $_POST['agency_contactNumber'];
	$agency_status = $_POST['agency_status'];

	$queryToDetectIfExisting=mysqli_query($con,"SELECT * FROM tblagency WHERE AgencyCaption='$agency_caption'");
    $numrows=mysqli_num_rows($queryToDetectIfExisting);

    if($numrows==0){
		$query = "INSERT INTO tblagency(AgencyCaption,AgencyFirstname,AgencyLastname,AgencyPosition,AgencyContactNumber,AgencyStatus) 
		VALUES (?,?,?,?,?,?)";

		$stmt = mysqli_prepare($con,$query);

		mysqli_stmt_bind_param($stmt,"ssssss",$agency_caption,$agency_firstname,$agency_lastname,$agency_position,$agency_contactNumber,$agency_status);

		mysqli_stmt_execute($stmt);

		$check = mysqli_stmt_affected_rows($stmt);

		if($check == 1){
			echo "<script type='text/javascript'>alert('Agency has been successfully added!'); window.location='homepage/agency.php';</script>";

		}else{
			echo "<script type='text/javascript'>alert('Failed to add agency!'); window.location='homepage/agency.php';</script>";
		}

		mysqli_stmt_close($stmt); 
    }else{
    	echo "<script type='text/javascript'>alert('Agency already exists. Please try another!'); window.location='homepage/agency.php';</script>";
    }

	mysqli_close($con);
}

?>