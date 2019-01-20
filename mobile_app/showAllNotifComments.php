<?php
header('Content-Type: application/json; charset=utf-8');

if($_SERVER["REQUEST_METHOD"] == "GET"){
	require 'database.php';
	showAllNotifComments();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}


function showAllNotifComments(){
	global $con;
	
	$loggedInUser = $_GET['loggedInUser'];

	$query="SELECT posts.TopicTitle as TopicTitle, posts.TopicStatus as TopicStatus, comments.* FROM tblcomments comments LEFT JOIN tblposts posts ON comments.PostID = posts.TopicID WHERE posts.TopicPostedBy='$loggedInUser' ORDER BY comments.CommentID DESC";

	$result = mysqli_query($con,$query);

	$numrows=mysqli_num_rows($result);

	$listOfComments = array();

	if($numrows > 0){
		while($row = mysqli_fetch_assoc($result)){
			$listOfComments[$row['CommentID']] = [
				'CommentID' => $row['CommentID'],
				'PostID' => $row['PostID'],
				'TopicTitle' => $row['TopicTitle'],
				'TopicStatus' => $row['TopicStatus'],
				'Message' => $row['Comment'],
				'DateAndTimeCommented' => $row['DateAndTimeCommented'],
				'commenterInfo' => []
			];

			$commentID = $row['CommentID'];
			$commentBy = $row['CommentBy'];

			$queryForGettingInfoOfPoster="SELECT UserID,Fullname,Email,ProfilePicture FROM tblusers WHERE UserID='$commentBy'";

			$resultForGettingInfoOfPoster = mysqli_query($con,$queryForGettingInfoOfPoster);

			$numrowsForGettingInfoOfPoster=mysqli_num_rows($resultForGettingInfoOfPoster);

			if($numrowsForGettingInfoOfPoster > 0){
				while($rowForGettingInfoOfPoster = mysqli_fetch_assoc($resultForGettingInfoOfPoster)){
					$listOfComments[$commentID]['commenterInfo'][] = [
						'UserID' => $rowForGettingInfoOfPoster['UserID'],
						'Fullname' => $rowForGettingInfoOfPoster['Fullname'],
						'Email' => $rowForGettingInfoOfPoster['Email'],
						'ProfilePicture' => $rowForGettingInfoOfPoster['ProfilePicture']
					];
				}
			}
		}

		// We want the final result to ignore the keys and to create a JSON array not a JSON object 
		$data = [];
		foreach ($listOfComments as $element) {
		    $data[] = $element;
		}
		
		echo json_encode(array("notif_comments"=>$data));
	}else{
		echo "no_data";
	}

	mysqli_close($con);
}

?>