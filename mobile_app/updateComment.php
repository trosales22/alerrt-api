<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	require 'database.php';
	updateComment();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function updateComment(){
	global $con;

	$commentID = $_GET['commentID'];
	$comment = $_POST['comment'];

	$query = "UPDATE tblcomments SET Comment=? WHERE CommentID=?";

	$stmt = mysqli_prepare($con,$query);

	mysqli_stmt_bind_param($stmt,"ss",$comment,$commentID);

	mysqli_stmt_execute($stmt);

	$check = mysqli_stmt_affected_rows($stmt);

	if($check == 1){
		echo "Successfully updated your comment!";
	}else{
		echo "No changes can be made!";
	}

	mysqli_stmt_close($stmt); 
	mysqli_close($con);
}
?>