<?php
header('Content-Type: application/json; charset=utf-8');

if($_SERVER["REQUEST_METHOD"] == "GET"){
	require 'database.php';
	showAllNotifReportStatus();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function showAllNotifReportStatus(){
	global $con;
	
	$loggedInUser = $_GET['loggedInUser'];

	$query="SELECT B.TopicTitle as StatusTopicTitle,C.AgencyCaption as StatusAgencyCaption, A.* FROM tblstatus A LEFT JOIN tblposts B ON A.StatusPostID = B.TopicID LEFT JOIN tblagency C ON B.TopicAgencyID = C.AgencyID WHERE B.TopicPostedBy='$loggedInUser' ORDER BY A.StatusID DESC";

	$result = mysqli_query($con,$query);

	$numrows=mysqli_num_rows($result);

	$listOfReportStatus = array();

	if($numrows > 0){
		while($row = mysqli_fetch_assoc($result)){
			$listOfReportStatus[$row['StatusID']] = [
				'StatusID' => $row['StatusID'],
				'StatusPostID' => $row['StatusPostID'],
				'StatusTopicTitle' => $row['StatusTopicTitle'],
				'StatusAgencyCaption' => $row['StatusAgencyCaption'],
				'StatusType' => $row['StatusType'],
				'StatusDateAndTime' => $row['StatusDateAndTime'],
				'updaterInfo' => []
			];

			$statusID = $row['StatusID'];
			$updateBy = $row['StatusBy'];

			$queryForGettingInfoOfPoster="SELECT UserID,Fullname,Email,ProfilePicture FROM tblusers WHERE UserID='$updateBy'";

			$resultForGettingInfoOfPoster = mysqli_query($con,$queryForGettingInfoOfPoster);

			$numrowsForGettingInfoOfPoster=mysqli_num_rows($resultForGettingInfoOfPoster);

			if($numrowsForGettingInfoOfPoster > 0){
				while($rowForGettingInfoOfPoster = mysqli_fetch_assoc($resultForGettingInfoOfPoster)){
					$listOfReportStatus[$statusID]['updaterInfo'][] = [
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
		foreach ($listOfReportStatus as $element) {
		    $data[] = $element;
		}
		
		echo json_encode(array("notif_report_status"=>$data));
	}else{
		echo "no_data";
	}

	mysqli_close($con);
}

?>