<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	require 'database.php';
	updateAccount();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function updateAccount(){
	global $con;

	$loggedInUser = $_GET['loggedInUser'];
	$fullname = $_POST['fullname'];
	$emailAddress = $_POST['emailAddress'];
	$mobileNumber = $_POST['mobileNumber'];

	$query = "UPDATE tblusers SET Fullname=?,Email=?,MobileNumber=? WHERE UserID=?";

	$stmt = mysqli_prepare($con,$query);

	if($stmt === FALSE){
		die(mysqli_error($con));
	}

	mysqli_stmt_bind_param($stmt,"ssss",$fullname,$emailAddress,$mobileNumber,$loggedInUser);

	mysqli_stmt_execute($stmt);

	$check = mysqli_stmt_affected_rows($stmt);

	if($check == 1){
		echo "Successfully updated your account information!";
	}else{
		echo "No changes can be made!";
	}

	mysqli_stmt_close($stmt); 
	mysqli_close($con);
}
?>