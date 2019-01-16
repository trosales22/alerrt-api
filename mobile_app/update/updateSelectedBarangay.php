<?php
header('Content-Type: Bitmap; charset-utf-8');

if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	updateSelectedBarangay();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function updateSelectedBarangay(){
	global $con;
	global $barangayExtendUrl;

	$barangayID = $_GET['barangayID'];
	$barangayName = $_POST['barangayName'];
	$barangayDescription = $_POST['barangayDescription'];
	$barangayLogo = base64_decode($_POST['barangayLogo']);

	$sql ="SELECT BarangayID FROM tblbarangay ORDER BY BarangayID ASC";
 
	$res = mysqli_query($con,$sql);
	 
	$id = 0;
	 
	while($row = mysqli_fetch_array($res)){
	 	$id = $row['BarangayID'];
	}

	$path = "../images/barangay_logo/$id.jpg";
	
	$actualPath = $barangayExtendUrl . "images/barangay_logo/$id.jpg";

	$file = fopen($path, 'wb');

	$isWritten = fwrite($file, $barangayLogo);
	fclose($file);

	if($isWritten > 0){
		$query = "UPDATE tblbarangay SET BarangayName=?,BarangayDescription=?,BarangayLogo=? WHERE BarangayID=?";

		$stmt = mysqli_prepare($con,$query);

		mysqli_stmt_bind_param($stmt,"ssss",$barangayName,$barangayDescription,$actualPath,$barangayID);

		mysqli_stmt_execute($stmt);

		$check = mysqli_stmt_affected_rows($stmt);

		if($check == 1){
			echo "Barangay was successfully updated!";
		}else{
			echo "No changes can be made!";
		}
		mysqli_stmt_close($stmt); 
		mysqli_close($con);
	}
}
?>