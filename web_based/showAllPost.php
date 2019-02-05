<?php
	date_default_timezone_set("Asia/Manila");
	showAllPost();

	function showAllPost(){
		global $con;
		global $session_id;
		global $session_agency;

		require_once('geoplugin.php');
		$geoplugin = new geoPlugin();

		if($session_agency == ''){
			$query="SELECT posts.*,users.ProfilePicture AS TopicPostedBy_ProfilePicture, users.Fullname AS TopicPostedBy_Fullname, users.Email AS TopicPostedBy_Email FROM tblposts posts LEFT JOIN tblusers users ON posts.TopicPostedBy=users.UserID ORDER BY posts.TopicID DESC";
		}else{
			$query="SELECT posts.*,users.ProfilePicture AS TopicPostedBy_ProfilePicture, users.Fullname AS TopicPostedBy_Fullname, users.Email AS TopicPostedBy_Email FROM tblposts posts LEFT JOIN tblusers users ON posts.TopicPostedBy=users.UserID WHERE posts.TopicAgencyID='$session_agency' ORDER BY posts.TopicID DESC";
		}
		
		$result = mysqli_query($con,$query);

		$numrows=mysqli_num_rows($result);

		if($numrows > 0){
			$values = '';
			$valuesComments = '';
			$topicImageUrl = '';
			$topicPosterByProfilePicUrl = '';
			$commentByProfilePicUrl = '';

			while($row = mysqli_fetch_assoc($result)){
				$postID = $row['TopicID'];
				$geoplugin->locate($row['PosterLocationIPAddress']);

				$city = $geoplugin->city;
				$region = $geoplugin->region;

				//comments
				$queryComments="SELECT comments.*,users.ProfilePicture AS CommentBy_ProfilePicture, users.Fullname AS CommentBy_Fullname, users.Email AS CommentBy_Email FROM tblcomments comments LEFT JOIN tblusers users ON comments.CommentBy=users.UserID WHERE comments.PostID='$postID' ORDER BY comments.CommentID DESC";

				$resultComments = mysqli_query($con,$queryComments);

				$numrowsComments=mysqli_num_rows($resultComments);

				if($numrowsComments > 0){
					while($rowComments = mysqli_fetch_assoc($resultComments)){

						if($rowComments['CommentBy_ProfilePicture'] == ""){
							$commentByProfilePicUrl = "assets/img/no-profile-pic-available.jpg";
						}else{
							$commentByProfilePicUrl = $rowComments['CommentBy_ProfilePicture'];
						}

						$valuesComments .= 	'<div class="col-md-12" style="margin-bottom: 25px;">' .
						              '<div class="media">' .

						                '<div class="media-left">' .
						                  '<img src="' . $commentByProfilePicUrl . '" class="media-object" style="width:60px; padding-right: 10px;">' .
						                '</div>' .

						                '<div class="media-body">' .
						                  '<h4 class="media-heading">' . $rowComments['CommentBy_Fullname'] . '<br><span style="font-size: 15px;">' . $rowComments['DateAndTimeCommented'] . '</span></h4>' .
						                  '<hr width="100%">' .
						                   $rowComments['Comment'] . '<br>' .
						                '</div>' .
						                
						              '</div>' .
						            '</div>';
					}
				}else{
					$valuesComments = '';
				}


				//posts
				if($row['TopicImage'] == ""){
					$topicImageUrl = "assets/img/no-image-available.jpg";
				}else{
					$topicImageUrl = $row['TopicImage'];
				}

				if($row['TopicPostedBy_ProfilePicture'] == ""){
					$topicPosterByProfilePicUrl = "assets/img/no-profile-pic-available.jpg";
				}else{
					$topicPosterByProfilePicUrl = $row['TopicPostedBy_ProfilePicture'];
				}

				$statusButtons;
				$btnOngoingStatus = '<button type="button" class="btn btn-info pull-left"> <i class="material-icons">edit</i> <a href="../changeStatusOfReport.php?postID=' . $row['TopicID'] . '&statusType=Ongoing&loggedInUser=' . $session_id . '" style="color: white;">Change Status (Ongoing)</a></button>';

				$btnResolvedStatus = '<button type="button" class="btn btn-warning pull-left"> <i class="material-icons">edit</i> <a href="../changeStatusOfReport.php?postID=' . $row['TopicID'] . '&statusType=Resolved&loggedInUser=' . $session_id . '" style="color: white;">Change Status (Resolved)</a></button>';

				$selectAllAgencyExceptLoggedInAgency = '<select class="form-control" name="agency_id" required>';

				$selectAllAgencyExceptLoggedInAgency .= '<option disabled selected>--CHOOSE AGENCY TO REASSIGN--</option>';

				$queryAgencies="SELECT * FROM tblagency WHERE AgencyID != '$session_agency' ORDER BY AgencyCaption ASC";

	      		$resultAgencies = mysqli_query($con,$queryAgencies);

				$numrowsAgencies = mysqli_num_rows($resultAgencies);

				if($numrowsAgencies > 0){
					while($rowAgencies = mysqli_fetch_assoc($resultAgencies)){
						$selectAllAgencyExceptLoggedInAgency .=  '<option value="' . $rowAgencies['AgencyID'] . '">' . $rowAgencies['AgencyCaption'] . '</option>';
					}
				}

				$selectAllAgencyExceptLoggedInAgency .= '</select>';


				$frmReassignToOtherAgency = '<form method="POST" action="../reassignTask.php?postID=' . $row['TopicID'] . '&loggedInUser=' . $session_id . '">' . 
				                  '<div class="row">' . 
				                  '<div class="col-md-5">' . 
				                    '<div class="form-group">' . $selectAllAgencyExceptLoggedInAgency . 
				                    '<button type="submit" class="btn btn-warning pull-left"> <i class="material-icons">edit</i> Reassign</button>' .
				                    '</div>' . 
				                  '</div>' . 
				                '</div>' .

				                '<hr width="100%">' .
				                '</form>';

				if($row['TopicStatus'] == 'Pending'){
					$statusButtons = '&nbsp;&nbsp;' . $btnOngoingStatus . '&nbsp;&nbsp;' . $btnResolvedStatus . '<br><br>' . $frmReassignToOtherAgency;
				} else if($row['TopicStatus'] == 'Ongoing'){
					$statusButtons = '&nbsp;&nbsp;' . $btnResolvedStatus;
				} else if($row['TopicStatus'] == 'Resolved'){
					$statusButtons = '';
				}
				
				$locationName;

	            if($row['TopicLocationName'] == ""){
	            	$locationName = $city . ', ' . $region;
	            }else{
	              	$locationName = $row['TopicLocationName'];
	            }

	            if($locationName == ""){
	            	$locationName = "N/A";
	            }

				$values .= 	'<div class="col-md-12" style="margin-bottom: 25px;">' .
				              '<div class="media">' .

				                '<div class="media-left">' .
				                  '<img src="' . $topicPosterByProfilePicUrl . '" class="media-object" style="width:60px; padding-right: 10px;">' .
				                '</div>' .

				                '<div class="media-body">' .
				                  '<h4 class="media-heading">' . $row['TopicPostedBy_Fullname'] . '<br><span style="font-size: 15px;"><i style="vertical-align: middle;" class="material-icons">date_range</i> ' . $row['TopicDateAndTimePosted'] . '</span></h4>' . 
				                  '<span style="vertical-align: middle;"><i style="vertical-align: middle;" class="material-icons">my_location</i> ' . $locationName . '</span>' .
				                  '<hr width="100%">' .
				                  '<p>' .
				                    '<b>Status: </b> ' . $row['TopicStatus'] . '<br>' .
				                    $statusButtons . 
				                  '</p><br><br>' .

				                  '<hr width="100%">' .
				                   $row['TopicTitle'] . '<br>' .
				                   
				                  
				                  '<img src="' . $topicImageUrl .'" class="img-thumbnail" width="400" height="300" style="max-height: 300px; max-width: 400px;"><br><br>' .

				                  '<form method="POST" action="../addCommentToPost.php?postID=' . $row['TopicID'] . '&loggedInUser=' . $session_id . '">' . 
				                  '<div class="row">' . 
				                  '<div class="col-md-12">' . 
				                    '<div class="form-group">' . 
				                      '<label class="bmd-label-floating">Whats on your mind?</label>' . 
				                      '<textarea class="form-control" name="comment" cols="50" rows="10" required maxlength="1000"></textarea>' . 
				                    '</div>' . 
				                  '</div>' . 
				                '</div>' .

				                '<button type="submit" class="btn btn-warning pull-left"> <i class="material-icons">edit</i> Submit</button><br><br><hr width="100%">' .

				                '</form><br>' .


				                  $valuesComments . 
				                '</div>' .
				                
				              '</div>' .
				            '</div>';
			}

			echo $values;
		}else{
			echo 	
					'<div class="col-md-12">' .
						'<div class="alert alert-danger">' .
		                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' .
		                      '<i class="material-icons">close</i>' .
		                    '</button>' .
		                    '<span>' .
		                    '<b> No post available.</b> Please try again!</span>' .
		                '</div>' .
	                '</div>';
		}

		mysqli_close($con);
	}
?>