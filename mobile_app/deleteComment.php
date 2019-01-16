<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	require 'database.php';
	deleteComment();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function deleteComment(){
	global $con;

	$commentID = $_GET['commentID'];

	$query = "DELETE FROM tblcomments WHERE CommentID=?";

	$stmt = mysqli_prepare($con,$query);

	mysqli_stmt_bind_param($stmt,"s",$commentID);

	mysqli_stmt_execute($stmt);

	$check = mysqli_stmt_affected_rows($stmt);

	if($check == 1){
		echo "Comment successfully deleted!";
	}else{
		echo "No changes can be made!";
	}

	mysqli_stmt_close($stmt); 
	mysqli_close($con);
}
?>