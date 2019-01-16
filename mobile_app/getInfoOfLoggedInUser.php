<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	require 'database.php';
	showInfoOfLoggedInUser();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function showInfoOfLoggedInUser(){
	global $con;

	$emailAddress = $_GET['emailAddress'];

	$query="SELECT * FROM tblusers WHERE Email='$emailAddress'";
	$result = mysqli_query($con,$query);

	$numrows=mysqli_num_rows($result);

	$listOfUsers = array();

	if($numrows > 0){
		while($row = mysqli_fetch_assoc($result)){
			$row['UserID'] = $row['UserID'];
			$listOfUsers[] = $row;
		}

		header('Content-Type: application/json');
		echo json_encode(array("userInfo"=>$listOfUsers));
	}else{
		echo "No record found!";
	}

	mysqli_close($con);
}

?>