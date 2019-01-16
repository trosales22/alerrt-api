<?php
header('Content-Type: application/json; charset=utf-8');

if($_SERVER["REQUEST_METHOD"] == "GET"){
	require 'database.php';
	showAllComments();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}


function showAllComments(){
	global $con;
	
	$postID = $_GET['postID'];

	$query="SELECT * FROM tblcomments WHERE PostID='$postID' ORDER BY CommentID DESC";
	$result = mysqli_query($con,$query);

	$numrows=mysqli_num_rows($result);

	$listOfComments = array();

	if($numrows > 0){
		while($row = mysqli_fetch_assoc($result)){
			$listOfComments[$row['CommentID']] = [
				'CommentID' => $row['CommentID'],
				'PostID' => $row['PostID'],
				'CommentBy' => $row['CommentBy'],
				'Comment' => $row['Comment'],
				'DateAndTimeCommented' => $row['DateAndTimeCommented'],
				'commenterInfo' => []
			];

			$commentID = $row['CommentID'];
			$userID = $row['CommentBy'];

			$queryForGettingInfoOfPoster="SELECT Fullname,Email FROM tblusers WHERE UserID='$userID'";

			$resultForGettingInfoOfPoster = mysqli_query($con,$queryForGettingInfoOfPoster);

			$numrowsForGettingInfoOfPoster=mysqli_num_rows($resultForGettingInfoOfPoster);

			if($numrowsForGettingInfoOfPoster > 0){
				while($rowForGettingInfoOfPoster = mysqli_fetch_assoc($resultForGettingInfoOfPoster)){
					$listOfComments[$commentID]['commenterInfo'][] = [
						'Fullname' => $rowForGettingInfoOfPoster['Fullname'],
						'Email' => $rowForGettingInfoOfPoster['Email'],
					];
				}
			}
		}

		// We want the final result to ignore the keys and to create a JSON array not a JSON object 
		$data = [];
		foreach ($listOfComments as $element) {
		    $data[] = $element;
		}
		
		echo json_encode(array("comments"=>$data));
	}else{
		echo "no_data";
	}

	mysqli_close($con);
}

?>