<?php
require 'database.php';
include 'session.php';
addAgency();

function addAgency(){
	global $con;
	global $session_agency;

	$agencyName = $_POST['agency_name'];
	$agencyDescription = $_POST['agency_description'];
	$agencyContactNumber = $_POST['agency_contact_number'];
	$agencyAddress = $_POST['agency_address'];
	$agencyStatus = $_POST['agency_status'];
	$agencyAvailability = $_POST['agency_availability'];

	$queryToDetectIfExisting=mysqli_query($con,"SELECT * FROM tblagency WHERE AgencyCaption='$agencyName'");
    $numrows=mysqli_num_rows($queryToDetectIfExisting);

    if($numrows==0){
		$query = "INSERT INTO tblagency(AgencyCaption,AgencyDescription,AgencyContactNumber,AgencyLocation,AgencyStatus,AgencyMain,AgencyAvailability) 
		VALUES (?,?,?,?,?,?,?)";

		$stmt = mysqli_prepare($con,$query);

		mysqli_stmt_bind_param($stmt,"sssssss",$agencyName,$agencyDescription,$agencyContactNumber,$agencyAddress,$agencyStatus,$session_agency,$agencyAvailability);

		mysqli_stmt_execute($stmt);

		$check = mysqli_stmt_affected_rows($stmt);

		if($check == 1){
			echo "<script type='text/javascript'>alert('Sub-Agency has been successfully added!'); window.location='homepage/agency.php';</script>";

		}else{
			echo "<script type='text/javascript'>alert('Failed to add sub-agency!'); window.location='homepage/agency.php';</script>";
		}

		mysqli_stmt_close($stmt); 
    }else{
    	echo "<script type='text/javascript'>alert('Agency already exists. Please try another!'); window.location='homepage/agency.php';</script>";
    }

	mysqli_close($con);
}

?>