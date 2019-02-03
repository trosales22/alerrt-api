<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	require 'database.php';
	registerUser();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function registerUser(){
	global $con;
	require_once('geoplugin.php');
	$geoplugin = new geoPlugin();
	
	// If we wanted to change the base currency, we would uncomment the following line
	$geoplugin->currency = 'PHP';
	$geoplugin->locate();
	
	$id = md5(time() . rand());
	$fullname = $_POST['fullname'];
	$email = $_POST['emailAddress'];
	$password = $_POST['password'];
	$mobileNumber = $_POST['mobileNumber'];
	$gender = $_POST['gender'];
	$dateAndTimeRegistered = $_POST['dateAndTimeRegistered'];

	$ipAddress = $geoplugin->ip;
	$city = $geoplugin->city;
	$region = $geoplugin->region;
	$latLong = $geoplugin->latitude . ',' . $geoplugin->longitude;
	
	$countryName = $geoplugin->countryName;

	$birthdate = $_POST['birthdate'];
	$userRole = 'USER';

	if($countryName != "Philippines"){
		echo "You are not from the Philippines! Please try again!";
		return;
	}else{
		$queryToDetectIfExisting=mysqli_query($con,"SELECT * FROM tblusers WHERE Email='$email'");
	    $numrows=mysqli_num_rows($queryToDetectIfExisting);

	    if($numrows==0){
			$query = "INSERT INTO tblusers(UserID,Fullname,Email,MobileNumber,Gender,Password,DateAndTimeRegistered,Birthdate,UserRole,IP_ADDRESS,City,Region,LatLong) 
			VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";

			$stmt = mysqli_prepare($con,$query);

			mysqli_stmt_bind_param($stmt,"sssssssssssss",$id,$fullname,$email,$mobileNumber,$gender,$password,$dateAndTimeRegistered,$birthdate,$userRole,$ipAddress,$city,$region,$latLong);

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
    }

	mysqli_close($con);
}

?>