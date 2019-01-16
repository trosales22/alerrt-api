<?php
header('Content-Type: Bitmap; charset-utf-8');

if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	updateInfoOfLoggedInUser();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function updateInfoOfLoggedInUser(){
	global $con;
	global $barangayExtendUrl;

	$userID = $_GET['userID'];
	$userFirstname = $_POST['userFirstname'];
	$userLastname = $_POST['userLastname'];
	$username = $_POST['username'];
	$userPhoneNumber = $_POST['userPhoneNumber'];
	$userPassword = $_POST['userPassword'];
	$userProfilePicture = base64_decode($_POST['userProfilePicture']);

	$sql ="SELECT ID FROM tblusers ORDER BY ID ASC";
 
	$res = mysqli_query($con,$sql);
	 
	$id = 0;
	 
	while($row = mysqli_fetch_array($res)){
	 	$id = $row['ID'];
	}

	$path = "../images/profile_picture/$id.jpg";

	$actualPath = $barangayExtendUrl . "images/profile_picture/$id.jpg";

	$file = fopen($path, 'wb');

	$isWritten = fwrite($file, $userProfilePicture);
	fclose($file);

	if($isWritten > 0){
		$query = "UPDATE tblusers SET ProfilePicture=?,Firstname=?,Lastname=?,Username=?,PhoneNumber=?,Password=? WHERE HEX(UserID)='$userID'";

		$stmt = mysqli_prepare($con,$query);

		mysqli_stmt_bind_param($stmt,"ssssss",$actualPath,$userFirstname,$userLastname,$username,$userPhoneNumber,$userPassword);

		mysqli_stmt_execute($stmt);

		$check = mysqli_stmt_affected_rows($stmt);

		if($check == 1){
			echo "Successfully updated your information!";
		}else{
			echo "No changes can be made!";
		}
		mysqli_stmt_close($stmt); 
		mysqli_close($con);
	}
}
?>