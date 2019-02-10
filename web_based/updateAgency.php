<?php
require 'database.php';
date_default_timezone_set("Asia/Manila");
updateAgency();

function updateAgency(){
	global $con;
	
	$agencyID = $_GET['agencyID'];
	$agencyCaption = $_POST['agency_name'];
	$agencyDescription = $_POST['agency_description'];
	$agencyContactNumber = $_POST['agency_contact_number'];
	$agencyAddress = $_POST['agency_address'];
	$agencyStatus = $_POST['agency_status'];

	$query = "UPDATE tblagency SET AgencyCaption=?,AgencyDescription=?,AgencyContactNumber=?,AgencyLocation=?,AgencyStatus=? WHERE AgencyID=?";

	$stmt = mysqli_prepare($con,$query);

	if($stmt === FALSE){
		die(mysqli_error($con));
	}

	mysqli_stmt_bind_param($stmt,"ssssss",$agencyCaption,$agencyDescription,$agencyContactNumber,$agencyAddress,$agencyStatus,$agencyID);

	mysqli_stmt_execute($stmt);

	$check = mysqli_stmt_affected_rows($stmt);

	if($check == 1){
		echo "<script type='text/javascript'>alert('Successfully updated agency!'); window.location='homepage/agency.php';</script>";
	}else{
		echo "<script type='text/javascript'>alert('No changes can be made!'); window.location='homepage/agency.php';</script>";
	}

	mysqli_stmt_close($stmt); 
	mysqli_close($con);
}
?>