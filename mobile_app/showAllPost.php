<?php
header('Content-Type: application/json; charset=utf-8');

if($_SERVER["REQUEST_METHOD"] == "GET"){
	require 'database.php';
	showAllPost();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function showAllPost(){
	global $con;
	global $appUrl;

	$loggedInUser = $_GET['loggedInUser'];

	$query="SELECT A.*, B.AgencyCaption FROM tblposts A LEFT JOIN tblagency B ON A.TopicAgencyID = B.AgencyID WHERE A.TopicPostedBy='$loggedInUser' ORDER BY A.TopicID DESC";
	$result = mysqli_query($con,$query);

	$numrows=mysqli_num_rows($result);

	$listOfPosts = array();

	if($numrows > 0){
		while($row = mysqli_fetch_assoc($result)){
			$listOfPosts[$row['TopicID']] = [
				'TopicID' => $row['TopicID'],
				'TopicSeverity' => $row['TopicSeverity'],
				'TopicTitle' => $row['TopicTitle'],
				'TopicImage' => $appUrl . $row['TopicImage'],
				'TopicLocationID' => $row['TopicLocationID'],
				'TopicLocationName' => $row['TopicLocationName'],
				'TopicLocationAddress' => str_replace("Address: ","", $row['TopicLocationAddress']),
				'TopicAgency' => $row['AgencyCaption'],
				'TopicStatus' => $row['TopicStatus'],
				'TopicPostedBy' => $row['TopicPostedBy'],
				'TopicDateAndTimePosted' => $row['TopicDateAndTimePosted'],
				'posterInfo' => []
			];

			$topicID = $row['TopicID'];
			$userID = $row['TopicPostedBy'];

			$queryForGettingInfoOfPoster="SELECT Fullname FROM tblusers WHERE UserID='$userID'";

			$resultForGettingInfoOfPoster = mysqli_query($con,$queryForGettingInfoOfPoster);

			$numrowsForGettingInfoOfPoster=mysqli_num_rows($resultForGettingInfoOfPoster);

			if($numrowsForGettingInfoOfPoster > 0){
				while($rowForGettingInfoOfPoster = mysqli_fetch_assoc($resultForGettingInfoOfPoster)){
					$listOfPosts[$topicID]['posterInfo'][] = [
						'Fullname' => $rowForGettingInfoOfPoster['Fullname']
					];
				}
			}
		}

		// We want the final result to ignore the keys and to create a JSON array not a JSON object 
		$data = [];
		foreach ($listOfPosts as $element) {
		    $data[] = $element;
		}
		
		echo json_encode(array("posts"=>$data));
	}else{
		echo "no_data";
	}

	mysqli_close($con);
}

?>