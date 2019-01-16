<?php
showAllPost();

function showAllPost(){
	global $con;
	global $session_id;

	$query="SELECT posts.*,users.ProfilePicture AS TopicPostedBy_ProfilePicture, users.Fullname AS TopicPostedBy_Fullname, users.Email AS TopicPostedBy_Email FROM tblposts posts LEFT JOIN tblusers users ON posts.TopicPostedBy=users.UserID ORDER BY posts.TopicID DESC";
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

			$values .= 	'<div class="col-md-12" style="margin-bottom: 25px;">' .
			              '<div class="media">' .

			                '<div class="media-left">' .
			                  '<img src="' . $topicPosterByProfilePicUrl . '" class="media-object" style="width:60px; padding-right: 10px;">' .
			                '</div>' .

			                '<div class="media-body">' .
			                  '<h4 class="media-heading">' . $row['TopicPostedBy_Fullname'] . '<br><span style="font-size: 15px;">' . $row['TopicDateAndTimePosted'] . '</span></h4>' .
			                  '<hr width="100%">' .
			                  '<p>' .
			                    '<b>Attention: </b>' . $row['TopicAttention'] . '<br>' .
			                    '<b>Status: </b> ' . $row['TopicStatus'] . '<br>' .
			                  '</p>' .
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