<?php
require "template.php"; //includes navtemplate() and templateend(), which produce the top navbar + sidebar, and an empty size 9 span
require_once "dbutil.php";

$db = DbUtil::loginConnection();


session_start();

navtemplate();

//require "subpages.php";

//populate inner 9 span
$i = $_GET["func"];
switch($i){
	case myart:
		//$uID = $_GET['uID'];
//		echo $uID;

		echo'    
		<div class="row-fluid">
		<a href="#uploadModal" role="button" class="btn btn-inverse btn-small" data-toggle="modal" style = "float:left;margin-left:10px">Upload!</a></div><br>';                  
            


		$stmt = $db->stmt_init();

		if($stmt->prepare("select aID, title, year, medium, URL, thumbURL, first, last from artwork natural join users where uID=? order by timestamp desc") or die(mysqli_error($db))){
			$stmt->bind_param('s', $_SESSION['user']);
			$stmt->execute();
			$stmt->bind_result($artID, $title, $year, $medium, $imageURL, $thumbURL, $first, $last);
			$number=0;
			while($stmt->fetch()){
				$number++;
				echo"<div class='span3' style='min-width:275px; border-width:1px; border-style:solid;'><br>
						<a href='$imageURL'><image src='$imageURL'>
						<h4>$title</h4></a>
						$first $last<br>
						$medium<br>
						$year<br>
						need a favorite/unfavorite button</div>";
			}
			if($number == 0)
				echo "<h4>You haven't uploaded any of your work!</h4>";
		}
			$stmt->close();
			$db->close();
		break;
	case collection:
		$stmt = $db->stmt_init();

		echo"<div class='span9'><h4>Your Collection</h4><br></div>";


		if($stmt->prepare("select aID, title, uID, year, medium, ownerID, URL, thumbURL, first, last from artwork natural join users where ownerID=? order by timestamp desc") or die(mysqli_error($db))){
			$stmt->bind_param('s', $_SESSION['user']);
			$stmt->execute();
			$stmt->bind_result($artID, $title, $artistID, $year, $medium, $ownerID, $imageURL, $thumbURL, $first, $last);
			while($stmt->fetch()){
				echo"<div class='span3' style='min-width:275px; border-width:1px; border-style:solid;'>
						<a href='$imageURL'><image src='$imageURL'>
						<h4>Title: $title</h4><br>
						Artist: $first $last<br>
						Medium: $medium<br>
						Year: $year<br></div>";
			}
		}
			$stmt->close();
			$db->close();
			break;
	case favorites:
		$stmt = $db->stmt_init();

		if($stmt->prepare("select title, year, medium, ownerID, URL, thumbURL, first, last from users natural join favorites join artwork where uID=?") or die(mysqli_error($db))){
						$stmt->bind_param('s', $_SESSION['user']);
						$stmt->execute();
						$stmt->bind_result($artID);
						while($stmt->fetch()){
							echo"<div class='span3' style='min-width:275px; border-width:1px; border-style:solid;'>
							<a href='$imageURL'><image src='$imageURL'>
							<h4>Title: $title</h4><br>
							Artist: $first $last<br>
							Medium: $medium<br>
							Year: $year<br></div>";

						}



		}

		/*if($stmt->prepare("select aID from favorites where uID=?") or die(mysqli_error($db))){
						$stmt->bind_param('s', $_SESSION['user']);
						$stmt->execute();
						$stmt->bind_result($artID);
						while($stmt->fetch()){
							$stmt2 = $db->stmt_init();
							if($stmt2->prepare("select aID, title, year, medium, ownerID, URL, thumbURL from artwork natural join users where aID=?") or die(mysqli_error($db))){
								$stmt2->bind_param('s', $artID);
								$stmt2->execute();
								$stmt2->bind_result($artID, $title, $artistID, $year, $medium, $ownerID, $imageURL, $thumbURL);
								while($stmt2->fetch()){
									echo'<h4>Title: $title</h4><br>
											Artist: $first $last<br>
											Medium: $medium<br>
											Year: $year<br><br>
											<img src= " '.$imageURL.' ">' ;
								}


							}
						}



		}*/


		/*if($stmt->prepare("select aID, title, artistname, artistID, year, medium, ownerID, URL, thumbURL from artwork where ownerID=?") or die(mysqli_error($db))){
			$stmt->bind_param('s', $_SESSION['user']);
			$stmt->execute();
			$stmt->bind_result($artID, $title, $artistName, $artistID, $year, $medium, $ownerID, $imageURL, $thumbURL);
			while($stmt->fetch()){
				echo"<h4>Title: $title</h4><br>
						Artist: $artistName<br>
						Medium: $medium<br>
						Year: $year<br>";
			}
		}
			$stmt->close();
			$db->close();*/
		break;
	case blogs:

		echo'
		<form name="newPost" action="newPost.php" method="post">		Title:<input type="text" name="title" placeholder="New Post" required="required"><br>
		<TEXTAREA NAME="blogpost" ROWS=11 COLS=50></TEXTAREA>

		<br><button class="btn btn-primary" type="submit">Submit</button>
		

		</form>
		';
		break;
	
	case artists:

	echo'
	<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script> 
	<script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
		<script>
	$(document).ready(function() {
		$( "#searchIPinput" ).change(function() {
		
			$.ajax({
				url:';
		echo"
				'searchArtists.php',";
				echo' 
				data: {searchArtist: $( "#searchArtistinput" ).val()},';
		echo"		success: function(data){
					$('#searchIPresult').html(data);	
				
				}
			});
		});
		
	});
	</script>";
	echo'
	<input class="xlarge" id="searchArtistinput" type="search" size="30" placeholder="IP Address"/>

	<div id="searchIPresult">IP Search Result</div>';

	echo'<form method="post" action="searchArtists.php"><input type="text" name="searchArtist"><input type="submit" value="search"></form>';

		$uID = $_GET['uID'];
//		echo $uID;

		$stmt = $db->stmt_init();

		if($stmt->prepare("select first, last, city, state, country, statement, uID from users order by first") or die(mysqli_error($db))){
			$stmt->execute();
			$stmt->bind_result($first, $last, $city, $state, $country, $statement, $artistID);
			while($stmt->fetch()){
				echo'<div class="row-fluid"><div style="text-align: left">
				<a href="index.php?func=profile&uID='. $artistID . '">';
				echo"<h2>$Name: $first $last</h2></a><br>
				Location: $city, $state, $country<br>
				Statement: $statement<br>";

				echo '</div>';
						
				}
				
			}

			
			$stmt->close();




		break;
	case genre:
		//create new
		echo'<div class="row-fluid">Tags</div>
			    <div class="span3" style="min-width: 275px; border-width:1px; border-style:solid;">1</div>
			    <div class="span3" style="min-width: 275px; border-width:1px; border-style:solid">2</div>
			    <div class="span3" style="min-width: 275px; border-width:1px; border-style:solid;">3</div>
			    <div class="span3" style="min-width: 275px;
			    border-width:1px; border-style:solid;">4</div>
			  ';
		break;
	case editProfile:
		
		$stmt = $db->stmt_init();

		if($stmt->prepare("select first, last, city, state, country, statement from users where uID=?") or die(mysqli_error($db))){
			$stmt->bind_param('s', $_SESSION['user']);
			$stmt->execute();
			$stmt->bind_result($first, $last, $city, $state, $country, $statement);
			$stmt->fetch();
						
			$stmt->close();
			$db->close();
		}
		echo'                      
            <form class="form-horizontal" action="editProfile.php" method="post">
              <div class="control-group">
                <label class="control-label" for="inputFirst">First Name</label>
                <div class="controls">
                  <input type="text" name="firstname" value="'.$first.'">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputLast">Last Name</label>
                <div class="controls">
                  <input type="text" name="lastname" value="'.$last.'">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputCity">City</label>
                <div class="controls">
                  <input type="text" name="city" value="'.$city.'">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputState">State</label>
                <div class="controls">
                  <input type="text" name="state" value="'.$state.'">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputCountry">Country</label>
                <div class="controls">
                  <input type="text" name="country" value="'.$country.'">
                  </div></div>
                  <div class="control-group">
                <label class="control-label" for="textarea">Artist Statement</label>
                <div class="controls">
                  <textarea class="input-xlarge" id="statement" rows="10"  name="statement" >'.$statement.'</textarea>
                  <br><br>
                	<button class="btn btn-primary" type="submit">Submit</button>
            </form>
                </div>
              	
              </div>
              
              </p>

            </div>
            
            ';
		break;
	case profile:
		$stmt = $db->stmt_init();

		if($stmt->prepare("select first, last, city, state, country, statement from users where uID=?") or die(mysqli_error($db))){
			$stmt->bind_param('s', $_GET['uID']);
			$stmt->execute();
			$stmt->bind_result($first, $last, $city, $state, $country, $statement);
			$stmt->fetch();
				echo"<div class='row-fluid'><div style='text-align: center'><h2>$first $last</h2></div>";
						
				
				
			}

			
			$stmt->close();
		                
    	/*$viewstmt = $db->stmt_init();
    	if($viewstmt->prepare("create view v as select * from favorites where uID = uFavs()")or die(mysqli_error($db))){
    		$viewstmt->execute();
    		if($viewstmt->prepare(select)or die(mysqli_error($db))){
    		$viewstmt->bind_param('s', $uID);
    		$viewstmt->execute();	
    		}
    		

     	} */    

 
		$stmt = $db->stmt_init();
		$uID = $_GET['uID'];

		if($stmt->prepare("select aID, title, year, medium, ownerID, URL, thumbURL, first, last from artwork natural join users where uID=? order by timestamp desc") or die(mysqli_error($db))){
			$stmt->bind_param('s', $uID);
			$stmt->execute();
			$stmt->bind_result($artID, $title, $year, $medium, $ownerID, $imageURL, $thumbURL, $first, $last);
			$number=0;
			
			echo'
		<div class="tabbable"> <!-- Only required for left/right tabs -->
		  <ul class="nav nav-tabs">
		    <li class="active"><a href="#tab1" data-toggle="tab">Artwork</a></li>
		    <li><a href="#tab2" data-toggle="tab">About</a></li>
		    <li><a href="#tab3" data-toggle="tab">Posts</a></li>
		  </ul>
		  <div class="tab-content">
		    <div class="tab-pane active fade in" id="tab1">';

		      while($stmt->fetch()){
				$number++;
				/*if($viewstmt->prepare("select exists(select aID from v where aID = ?") or die(mysqli_error($db))){
					$viewstmt->bind_param('s', $artID);
					$viewstmt->execute();
					$viewstmt->bind_result($favorited);
					$viewstmt->fetch();*/
				
				echo"<div class='span3' style='min-width:275px; border-width:1px; border-style:solid;'><br>
						<a href='$imageURL'><image src='$imageURL'>
						<h4>$title</h4></a>
						$first $last<br>
						$medium<br>
						$year<br></div>
						";}
				/*echo'
<html>
					 <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script> 
						<script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
						<script>
						$(document).ready(function() {
							$("#favoriteSub").change(function() {
							
								$.ajax({
									url: "favorite.php", 
									data: {uID: $uID; aID: $artID}								
									
									}
								});
							});
							
						});</script>

					<button class=btn btn-inverse btn-small" id= "favoriteSub" style = "margin-left:10px">h</button></div></html>';*/

			}
			if($number == 0){
				echo "<h4>This user hasn't uploaded any work yet.</h4>";}
				$stmt->close();
		   echo'</div>
		    <div class="tab-pane fade" id="tab2">';

		     if($city&&$state&&$country){
					echo"$city, $state, $country<br>";
				}
				elseif($city&&$state){
					echo"$city, $state";
				}
				elseif($state&&$country){
					echo"$state, $country";
				}
				elseif($country){
					echo"$country";
				}
				if($statement){
					echo"<br><p>$statement<p><br>";	
				}

				echo'</div>';
		 echo'
		    <div class="tab-pane fade" id="tab3">';
		    $stmt3 = $db->stmt_init();
			if($stmt3->prepare("select uID, posted, text, first, last from comments natural join users where bID=?") or die(mysqli_error($db))){
							
					
		     $stmt2 = $db->stmt_init();
		     if($stmt2->prepare("select bID, title, text, modified from blogPosts where uID=?")or die(mysqli_error($db))){
		     	$stmt2->bind_param('s', $uID);
		     	$stmt2->execute();
		     	$stmt2->store_result();
		     	$stmt2->bind_result($bID, $postTitle, $postText, $modified);

		     	$num = 0;
		     	while($stmt2->fetch()){
		     		$num++;
		     		echo"<div class='row-fluid'><div class='span9' style='min-width:275px; border-width:0px; border-style:solid; text-overflow:ellipses; word-wrap: break-word;'><br>
						<h4>$postTitle</h4>
						<i>$modified</i><br>
						$postText<br>";
						// echo'<a href="#commentModal" role="button" class="btn btn-link btn-mini" data-toggle="modal" style = "float:left;">Add Comment</a></div><br>';

						echo"
						<div class='row-fluid'>
						<form action='postComment.php' method='post'><textarea name='comment' rows='2'>Write a comment</textarea><button type='submit' class='btn btn-link'>Post</button><input type='hidden' name='bID' value='".$bID."'></form></div>";

						//echo $bID;
						$stmt3->bind_param('s', $bID);
							$stmt3->execute();
							$stmt3->store_result();
							$stmt3->bind_result($commentUID, $posted, $commenttext, $commentfirst, $commentlast);

							while($stmt3->fetch()){
								//echo $commenttext;
								//echo $commentfirst.' '.$commentlast;
								
								echo'<div class="media">

										<div class="media-body">
										<b>'. $commentfirst.' '.$commentlast.'</b><br>
											'.$commenttext.'
										</div>
									</div>';

							}
							
						

						echo"</div> </div>";
		     	}
				if($num==0)
					echo 'You havent posted anything yet!';

		     }}
				
		echo'</div>
		  </div>
		</div>'; 
$stmt3->close();
		$stmt2->close();
		$db->close();
		break;
	default:
		//home stream
		break;
}

echo'
            <div id="uploadModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">Upload your work</div>
            <div class="modal-body">
            <p>
                      
            <form class="form-horizontal" action="imgUpload.php" method="post" enctype="multipart/form-data">
              <div class="control-group">
                <label class="control-label" for="Title"></label>
                <div class="controls">
                  <input type="text" name="title" placeholder="Title">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="medium"></label>
                <div class="controls">
                  <input type="text" name="medium" placeholder="Medium">
                </div>
              </div>
           	<div class="control-group">
                <label class="control-label" for="year"></label>
                <div class="controls">
                  <input type="number" name="year" placeholder="Year" max="2020">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="file"></label>
                <div class="controls">
				<input type="file" name="file" id="file" ><br>
                </div>
              </div>
            


            </p>

            </div>
            <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button class="btn btn-primary" type="submit">Upload</button>
            </form>
            </div>

            </div>';

            


templateend();
?>