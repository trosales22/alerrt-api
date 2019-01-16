<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	require 'database.php';
	addCommentToAPost();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function addCommentToAPost(){
	global $con;

	$postID = $_POST['postID'];
	$commentBy = $_POST['commentBy'];
	$comment = $_POST['comment'];
	$dateAndTimeCommented = $_POST['dateAndTimeCommented'];

	$query = "INSERT INTO tblcomments(PostID,CommentBy,Comment,DateAndTimeCommented) VALUES (?,?,?,?)";

	$stmt = mysqli_prepare($con,$query);

	mysqli_stmt_bind_param($stmt,"ssss",$postID,$commentBy,$comment,$dateAndTimeCommented);

	mysqli_stmt_execute($stmt);

	$check = mysqli_stmt_affected_rows($stmt);

	if($check == 1){
		echo "Comment posted successfully!";
	}else{
		echo "Failed to add comment. Please try again!";
	}

	mysqli_stmt_close($stmt);

	mysqli_close($con);
}

?>