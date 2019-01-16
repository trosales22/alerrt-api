<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	deletePost();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function deletePost(){
	global $con;

	$id = $_GET['post_id'];

	$query = "DELETE FROM tblposts WHERE ID=?";

	$stmt = mysqli_prepare($con,$query);

	mysqli_stmt_bind_param($stmt,"s",$id);

	mysqli_stmt_execute($stmt);

	$check = mysqli_stmt_affected_rows($stmt);

	if($check == 1){
		echo "Post successfully deleted!";
	}else{
		echo "No changes can be made!";
	}

	mysqli_stmt_close($stmt); 
	mysqli_close($con);
}
?>