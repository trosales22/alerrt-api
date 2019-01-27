<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	require 'database.php';
	loginUser();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function loginUser(){
	global $con;

	$email = $_POST['email'];
	$password = $_POST['password'];

	$query=mysqli_query($con,"SELECT * FROM tblusers WHERE Email='$email' AND Password='$password' AND UserRole='USER' AND UserStatus='Approved'");
  	$numrows=mysqli_num_rows($query);

  	if($numrows!=0){
    	while($row=mysqli_fetch_assoc($query)){
      		$dbEmail=$row['Email'];
      		$dbPassword=$row['Password'];
    	}

	  	if($email == $dbEmail && $password == $dbPassword){
	    	echo "success_login";
	   	}
  	}else{
  		echo "invalid";
  	}

	mysqli_close($con);
}

?>