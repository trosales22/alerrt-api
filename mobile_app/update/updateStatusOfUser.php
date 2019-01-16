<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	updateStatusOfUser();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function updateStatusOfUser(){
	global $con;

	$requestedBy = $_GET['requestedBy'];
	$requestStatus = $_POST['requestStatus'];
	$requestDateAndTimeConfirmed = $_POST['requestDateAndTimeConfirmed'];
	$userType = $_POST['userType'];

	$query = "UPDATE tblrequests,tblusers SET tblrequests.RequestStatus=?,tblrequests.RequestDateAndTimeConfirmed=?,tblusers.UserType=? WHERE tblrequests.RequestedBy=? AND HEX(tblusers.UserID)=?";

	$stmt = mysqli_prepare($con,$query);

	mysqli_stmt_bind_param($stmt,"sssss",$requestStatus,$requestDateAndTimeConfirmed,$userType,$requestedBy,$requestedBy);

	mysqli_stmt_execute($stmt);

	$check = mysqli_stmt_affected_rows($stmt);

	if($check == 1){
		echo "Successfully updated status of user!";
	}else{
		echo "No changes can be made!";
	}

	mysqli_stmt_close($stmt); 
	mysqli_close($con);
}
?>