<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	require 'database.php';
	addPost();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function addPost(){
	global $con;
	global $appUrl;

	$actualPath = '';
	$topicTitle = $_POST['topicTitle'];

	if($_POST['topicImage'] != null){
		$topicImage = base64_decode($_POST['topicImage']);
	}else{
		$topicImage = "";
	}
	
	$topicLocationID = $_POST['topicLocationID'];
	$topicLocationName = $_POST['topicLocationName'];
	$topicLocationAddress = $_POST['topicLocationAddress'];

	if($topicLocationID == "" || $topicLocationName == "" || $topicLocationAddress == ""){
		$topicPosterIpAddress = $_SERVER['REMOTE_ADDR'];
	}

	$topicAgencyID = $_POST['topicAgencyID'];
	$topicStatus = 'Pending';
	$topicPostedBy = $_POST['topicPostedBy'];
	$topicDateAndTimePosted = $_POST['topicDateAndTimePosted'];

	$id = md5(time() . rand());

	if($topicImage != null){
		$path = "images/posts/$id.jpg";

		$actualPath = $appUrl . "images/posts/$id.jpg";

		$file = fopen($path, 'wb');

		$isWritten = fwrite($file, $topicImage);
		fclose($file);
	}

	$query = "INSERT INTO tblposts(TopicTitle,TopicImage,TopicLocationID,TopicLocationName,TopicLocationAddress,TopicAgencyID,TopicStatus,TopicPostedBy,TopicDateAndTimePosted,PosterLocationIPAddress) 
		VALUES (?,?,?,?,?,?,?,?,?,?)";

	$stmt = mysqli_prepare($con,$query);

	mysqli_stmt_bind_param($stmt,"ssssssssss",$topicTitle,$actualPath,$topicLocationID,$topicLocationName,$topicLocationAddress,$topicAgencyID,$topicStatus,$topicPostedBy,$topicDateAndTimePosted,$topicPosterIpAddress);

	mysqli_stmt_execute($stmt);

	$check = mysqli_stmt_affected_rows($stmt);

	if($check == 1){
		echo "Topic posted successfully!";
	}else{
		echo "Failed to post your topic!";
	}

	mysqli_stmt_close($stmt); 
	mysqli_close($con);
}

?>