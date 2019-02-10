<?php
require 'database.php';
date_default_timezone_set("Asia/Manila");
registerUser();

function registerUser(){
	global $con;

	$id = md5(time() . rand());
	$fullname = $_POST['user_fullname'];
	$email = $_POST['user_email'];
	$contactNumber = $_POST['user_contact_number'];
	$password = $_POST['user_password'];
	$address = $_POST['user_address'];
	$agency = $_POST['agency_id'];
	$userRole = 'ADMIN';
	$dateAndTimeAdded = date('F d, Y | h:i A');
	$userStatus = 'Approved';

	$queryToDetectIfExisting=mysqli_query($con,"SELECT * FROM tblusers WHERE Email='$email'");
    $numrows=mysqli_num_rows($queryToDetectIfExisting);

    if($numrows==0){
		$query = "INSERT INTO tblusers(UserID,Fullname,Email,MobileNumber,Password,LatLong,UserRole,DateAndTimeRegistered,Agency,UserStatus) VALUES (?,?,?,?,?,?,?,?,?,?)";

		$stmt = mysqli_prepare($con,$query);

		if($stmt === FALSE){
			die(mysqli_error($con));
		}

		mysqli_stmt_bind_param($stmt,"ssssssssss",$id,$fullname,$email,$contactNumber,$password,$address,$userRole,$dateAndTimeAdded,$agency,$userStatus);

		mysqli_stmt_execute($stmt);

		$check = mysqli_stmt_affected_rows($stmt);

		if($check == 1){
			echo "<script type='text/javascript'>alert('Admin User has been successfully created!'); window.location='homepage/users.php';</script>";
		}else{
			echo "<script type='text/javascript'>alert('Failed to create an account!'); window.location='homepage/users.php';</script>";
		}

		mysqli_stmt_close($stmt); 
    }else{
    	echo "<script type='text/javascript'>alert('This user already exists. Please try another!'); window.location='homepage/users.php';</script>";
    }

	mysqli_close($con);
}

?>