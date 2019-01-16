<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	updatePassword();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function updatePassword(){
	global $con;

	$emailAddress = $_GET['emailAddress'];
	$userPassword = $_POST['userPassword'];

	$query = "UPDATE tblusers SET Password=? WHERE EmailAddress=?";

	$stmt = mysqli_prepare($con,$query);

	mysqli_stmt_bind_param($stmt,"ss",$userPassword,$emailAddress);

	mysqli_stmt_execute($stmt);

	$check = mysqli_stmt_affected_rows($stmt);

	if($check == 1){
		echo "Successfully updated your password!";
	}else{
		echo "No changes can be made!";
	}

	mysqli_stmt_close($stmt); 
	mysqli_close($con);
}
?>