<?php
header('Content-Type: application/json; charset=utf-8');

if($_SERVER["REQUEST_METHOD"] == "GET"){
	require 'database.php';
	showAllAgency();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}


function showAllAgency(){
	global $con;
	
	$query="SELECT * FROM tblagency ORDER BY AgencyID DESC";
	$result = mysqli_query($con,$query);

	$numrows=mysqli_num_rows($result);

	$listOfAgency = array();

	if($numrows > 0){
		while($row = mysqli_fetch_assoc($result)){
			$listOfAgency[$row['AgencyID']] = [
				'AgencyID' => $row['AgencyID'],
				'AgencyCaption' => $row['AgencyCaption'],
				'AgencyDescription' => $row['AgencyDescription'],
				'AgencyFirstname' => $row['AgencyFirstname'],
				'AgencyLastname' => $row['AgencyLastname'],
				'AgencyPosition' => $row['AgencyPosition'],
				'AgencyContactNumber' => $row['AgencyContactNumber'],
				'AgencyStatus' => $row['AgencyStatus'],
				'AgencyImage' => $row['AgencyImage']
			];
		}

		// We want the final result to ignore the keys and to create a JSON array not a JSON object 
		$data = [];
		foreach ($listOfAgency as $element) {
		    $data[] = $element;
		}
		
		echo json_encode(array("agency"=>$data));
	}else{
		echo "no_data";
	}

	mysqli_close($con);
}

?>