<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	require 'database.php';
	registerUser();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function registerUser(){
	global $con;

	$id = md5(time() . rand());
	$fullname = $_POST['fullname'];
	$email = $_POST['emailAddress'];
	$password = $_POST['password'];
	$mobileNumber = $_POST['mobileNumber'];
	$gender = $_POST['gender'];
	$dateAndTimeRegistered = $_POST['dateAndTimeRegistered'];
	$address = $_POST['address'];
	$birthdate = $_POST['birthdate'];
	$userRole = 'USER';

	$queryToDetectIfExisting=mysqli_query($con,"SELECT * FROM tblusers WHERE Email='$email'");
    $numrows=mysqli_num_rows($queryToDetectIfExisting);

    if($numrows==0){
		$query = "INSERT INTO tblusers(UserID,Fullname,Email,MobileNumber,Gender,Password,DateAndTimeRegistered,Address,Birthdate,UserRole) 
		VALUES (?,?,?,?,?,?,?,?,?,?)";

		$stmt = mysqli_prepare($con,$query);

		mysqli_stmt_bind_param($stmt,"ssssssssss",$id,$fullname,$email,$mobileNumber,$gender,$password,$dateAndTimeRegistered,$address,$birthdate,$userRole);

		mysqli_stmt_execute($stmt);

		$check = mysqli_stmt_affected_rows($stmt);

		if($check == 1){
			echo "Your account has been successfully created!";
		}else{
			echo "Failed to create your account!";
		}

		mysqli_stmt_close($stmt); 
    }else{
    	echo "Email Address already exists. Please try another!";
    }

	mysqli_close($con);
}

?>