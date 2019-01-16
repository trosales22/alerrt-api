<?php
require 'database.php';
addCommentToPost();

function addCommentToPost(){
	global $con;

	$postID = $_GET['postID'];
	$commentBy = $_GET['loggedInUser'];
	$comment = $_POST['comment'];
	$dateAndTimeCommented = date('F d, Y | h:i A');

	$query = "INSERT INTO tblcomments(PostID,CommentBy,Comment,DateAndTimeCommented) VALUES (?,?,?,?)";

	$stmt = mysqli_prepare($con,$query);

	mysqli_stmt_bind_param($stmt,"ssss",$postID,$commentBy,$comment,$dateAndTimeCommented);

	mysqli_stmt_execute($stmt);

	$check = mysqli_stmt_affected_rows($stmt);

	if($check == 1){
		echo "<script type='text/javascript'>alert('Comment posted successfully!'); window.location='homepage/newsfeed.php';</script>";
	}else{
		echo "<script type='text/javascript'>alert('Failed to add comment. Please try again!');</script>";
	}

	mysqli_stmt_close($stmt);

	mysqli_close($con);
}

?>