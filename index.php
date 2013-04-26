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
		echo"<div class='span12'><h2>Your Artwork!<br><br></h2></div>";

		echo'    
		<div class="row-fluid">
		<a href="#uploadModal" role="button" class="btn btn-inverse btn-small" data-toggle="modal" style = "float:left;margin-left:10px">Upload!</a></div><br>';                  
            


		$stmt = $db->stmt_init();

		if($stmt->prepare("select aID, title, year, medium, URL, thumbURL, first, last, genreID from artwork natural join users natural join artTags where uID=? order by timestamp desc") or die(mysqli_error($db))){
			$stmt->bind_param('s', $_SESSION['user']);
			$stmt->execute();
			$stmt->bind_result($artID, $title, $year, $medium, $imageURL, $thumbURL, $first, $last, $genreID);
			$number=0;
			while($stmt->fetch()){
				$number++;
				echo"<div class='span3' style='min-width:275px; border-width:1px; border-style:solid;'><br>
						<a href='$imageURL'><image src='$imageURL'>
						<h4>$title</h4></a>
						Artist: $first $last<br>
						Medium: $medium<br>
						Year: $year<br>
						#$genreID<br>
						</div>";
			}
			if($number == 0)
				echo "<h4>You haven't uploaded any of your work!</h4>";
		}
			$stmt->close();
			$db->close();
		break;
	
	case favorites:

		echo"<div class='span9'><h2>Your Favorite Artwork!<br><br></h2></div>";


		$stmt = $db->stmt_init();
		$stmt2 = $db->stmt_init();

		if($stmt->prepare("select aID from favorites where uID=?") or die(mysqli_error($db))){
						$stmt->bind_param('s', $_SESSION['user']);
						$stmt->execute();
						$stmt->store_result();
						$stmt->bind_result($artID);
						while($stmt->fetch()){
			if($stmt2->prepare("select title, year, medium, URL, first, last, genreID from artwork natural join users natural join artTags where aID=?") or die(mysqli_error($db))){

								$stmt2->bind_param('s', $artID);
								$stmt2->execute();
								$stmt2->store_result();
								$stmt2->bind_result($title, $year, $medium, $imageURL, $first, $last, $genreID);
								$stmt2->fetch();
										echo"<div class='span3' style='min-width:275px; border-width:1px; border-style:solid;'>
										<a href='$imageURL'><image src='$imageURL'></a>
										<h4>Title: <a href='$imageURL'>$title</h4></a><br>
										Artist: $first $last<br>
										Medium: $medium<br>
										Year: $year<br>
										#$genreID<br>
										</div>";
								
							}
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
<<<<<<< HEAD
		<form name="newPost" action="newPost.php" method="post">		Title:<input type="text" name="title" placeholder="New Post" required="required"><br>
=======
		<form name="newPost" action="newPost.php" method="post">		Title:<input type="text" name="title" placeholder="New Post"><br>
>>>>>>> 14892b5ae39660ab992173b840ab12fdbe25eca0
		<TEXTAREA NAME="blogpost" ROWS=11 COLS=50></TEXTAREA>

		<br><button class="btn btn-primary" type="submit">Submit</button>
		

<<<<<<< HEAD
=======
		</form>
		';
		break;
	case upload:
		echo'<p>
		<form action="imgUpload.php" method="post" enctype="multipart/form-data">
			<label for="file">Filename:</label>
			<input type="file" name="file" id="file"><br>
			<input type="submit" name="submit" value="Submit">
>>>>>>> 14892b5ae39660ab992173b840ab12fdbe25eca0
		</form>
		';
		break;
	
	case artists:

		echo"<div class='span9'><h2>Your Favorite Artists!<br><br></h2></div>";


		$stmt = $db->stmt_init();
		$stmt2 = $db->stmt_init();
		$stmt3 = $db->stmt_init();

		if($stmt->prepare("select targetID from following where uID=?") or die(mysqli_error($db))){
						$stmt->bind_param('s', $_SESSION['user']);
						$stmt->execute();
						$stmt->store_result();
						$stmt->bind_result($targetID);
						while($stmt->fetch()){
			if($stmt2->prepare("select first, last, genreID from users natural join userTags where uID=?") or die(mysqli_error($db))){

								$stmt2->bind_param('s', $targetID);
								$stmt2->execute();
								$stmt2->store_result();
								$stmt2->bind_result($first, $last, $genreID);
								$stmt2->fetch();

								if($stmt3->prepare("select URL from artwork where uID=?") or die(mysqli_error($db))){
										$stmt3->bind_param('s', $targetID);
									$stmt3->execute();
									$stmt3->store_result();
									$stmt3->bind_result($imageURL);
									$stmt3->fetch();
										
										echo"<div class='span3' style='min-width:275px; border-width:1px; border-style:solid;'>
										<h4>Artist: <a href='index.php?func=profile&uID=". $targetID . "'>
										$first $last</h4>
										<image src= $imageURL></a><br><br>
										#$genreID<br>

										</div>";
								}
							}
						}



		}





		break;
	case genreSearch:

	echo"<div class='span9'><h2>".$_GET['genreID']."!<br><br></h2></div>";


	$stmt = $db->stmt_init();
	$stmt2 = $db->stmt_init();


	if($stmt->prepare("select first, last, uID from users natural join userTags where genreID=?") or die(mysqli_error($db))){
		/*if($_GET['genreID']=="All")
			$stmt->bind_param("s", "*");
		else*/
			$stmt->bind_param("s", $_GET['genreID']);

		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($first, $last, $uID);
		while($stmt->fetch()){

			if($stmt2->prepare("select URL from artwork where uID=?") or die(mysqli_error($db))){
			
			$stmt2->bind_param("s", $uID);

			$stmt2->execute();
			$stmt2->store_result();
			$stmt2->bind_result($imageURL);
			$stmt2->fetch();

			echo"<div class='span3' style='min-width:275px; border-width:1px; border-style:solid;'>
				<h4>Artist: <a href='index.php?func=profile&uID=". $uID . "'>
				$first $last</h4></a><br>
				<image src =$imageURL>

				</div>";

			}
		}
	}

	break;

	case genre:


		echo'
		  <form class="form-horizontal" action="genreSearch.php" method="post">
			<div class="control-group">
                <label class="control-label" for="genre"></label>
                <div class="controls">
					<select name="genre">
					  <option value=""></option>
					  <option value="All">All</option>
					  <option value="Impressionism">Impressionism</option>
					  <option value="Cubism">Cubism</option>
					  <option value="Surrealism">Surrealism</option>
					  <option value="Photography">Photography</option>
					  <option value="Contemporary">Contemporary</option>
					  <option value="Dadaism">Dadaism</option>
					  <option value="Classical">Classical</option>
					  <option value="Neoclassical">Neoclassical</option>
					  <option value="Baroque">Baroque</option>
					  <option value="Rococo">Rococo</option>
					  <option value="Other">Other</option>
					</select>                </div>
             
           		 <button class="btn" type="submit">Go!</button></div>
		</form>
			  ';


		$stmt=$db->util_init();

		if($stmt->prepare("select first, last, uID from users natural join userTags where genreID=?") or die(mysqli_error($db))){
				$stmt->bind_param("s", $_GET['genreID']);
				$stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($first, $last, $uID);
				while($stmt->fetch()){

				echo"<div class='span3' style='min-width:275px; border-width:1px; border-style:solid;'>
					<h4>Artist: <a href='index.php?func=profile&uID=". $uID . "'>
					$first $last</h4></a><br>
					<image src= $imageURL><br><br>

					</div>";
				}
			}

			
	


			  
		break;

	case printByState:
echo'
<form class="form-horizontal" action="stateDump.php" method="post">

	<div class="control-group">
                <label class="control-label" for="inputState">State</label>
                <div class="controls">
                <select name="State"> 
<option value="" selected="selected">Select a State</option> 
<option value="AL">Alabama</option> 
<option value="AK">Alaska</option> 
<option value="AZ">Arizona</option> 
<option value="AR">Arkansas</option> 
<option value="CA">California</option> 
<option value="CO">Colorado</option> 
<option value="CT">Connecticut</option> 
<option value="DE">Delaware</option> 
<option value="DC">District Of Columbia</option> 
<option value="FL">Florida</option> 
<option value="GA">Georgia</option> 
<option value="HI">Hawaii</option> 
<option value="ID">Idaho</option> 
<option value="IL">Illinois</option> 
<option value="IN">Indiana</option> 
<option value="IA">Iowa</option> 
<option value="KS">Kansas</option> 
<option value="KY">Kentucky</option> 
<option value="LA">Louisiana</option> 
<option value="ME">Maine</option> 
<option value="MD">Maryland</option> 
<option value="MA">Massachusetts</option> 
<option value="MI">Michigan</option> 
<option value="MN">Minnesota</option> 
<option value="MS">Mississippi</option> 
<option value="MO">Missouri</option> 
<option value="MT">Montana</option> 
<option value="NE">Nebraska</option> 
<option value="NV">Nevada</option> 
<option value="NH">New Hampshire</option> 
<option value="NJ">New Jersey</option> 
<option value="NM">New Mexico</option> 
<option value="NY">New York</option> 
<option value="NC">North Carolina</option> 
<option value="ND">North Dakota</option> 
<option value="OH">Ohio</option> 
<option value="OK">Oklahoma</option> 
<option value="OR">Oregon</option> 
<option value="PA">Pennsylvania</option> 
<option value="RI">Rhode Island</option> 
<option value="SC">South Carolina</option> 
<option value="SD">South Dakota</option> 
<option value="TN">Tennessee</option> 
<option value="TX">Texas</option> 
<option value="UT">Utah</option> 
<option value="VT">Vermont</option> 
<option value="VA">Virginia</option> 
<option value="WA">Washington</option> 
<option value="WV">West Virginia</option> 
<option value="WI">Wisconsin</option> 
<option value="WY">Wyoming</option>
</select>
    <button class="btn" type="submit">Go!</button></div>
</form>
                </div>
              </div>
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
                <select name="State"> 
<option value="" selected="selected">Select a State</option> 
<option value="AL">Alabama</option> 
<option value="AK">Alaska</option> 
<option value="AZ">Arizona</option> 
<option value="AR">Arkansas</option> 
<option value="CA">California</option> 
<option value="CO">Colorado</option> 
<option value="CT">Connecticut</option> 
<option value="DE">Delaware</option> 
<option value="DC">District Of Columbia</option> 
<option value="FL">Florida</option> 
<option value="GA">Georgia</option> 
<option value="HI">Hawaii</option> 
<option value="ID">Idaho</option> 
<option value="IL">Illinois</option> 
<option value="IN">Indiana</option> 
<option value="IA">Iowa</option> 
<option value="KS">Kansas</option> 
<option value="KY">Kentucky</option> 
<option value="LA">Louisiana</option> 
<option value="ME">Maine</option> 
<option value="MD">Maryland</option> 
<option value="MA">Massachusetts</option> 
<option value="MI">Michigan</option> 
<option value="MN">Minnesota</option> 
<option value="MS">Mississippi</option> 
<option value="MO">Missouri</option> 
<option value="MT">Montana</option> 
<option value="NE">Nebraska</option> 
<option value="NV">Nevada</option> 
<option value="NH">New Hampshire</option> 
<option value="NJ">New Jersey</option> 
<option value="NM">New Mexico</option> 
<option value="NY">New York</option> 
<option value="NC">North Carolina</option> 
<option value="ND">North Dakota</option> 
<option value="OH">Ohio</option> 
<option value="OK">Oklahoma</option> 
<option value="OR">Oregon</option> 
<option value="PA">Pennsylvania</option> 
<option value="RI">Rhode Island</option> 
<option value="SC">South Carolina</option> 
<option value="SD">South Dakota</option> 
<option value="TN">Tennessee</option> 
<option value="TX">Texas</option> 
<option value="UT">Utah</option> 
<option value="VT">Vermont</option> 
<option value="VA">Virginia</option> 
<option value="WA">Washington</option> 
<option value="WV">West Virginia</option> 
<option value="WI">Wisconsin</option> 
<option value="WY">Wyoming</option>
</select>
                  
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputCountry">Country</label>
                <div class="controls">
<<<<<<< HEAD
                  <input type="text" name="country" value="'.$country.'">
                  </div></div>

                  <div class="control-group">
                <label class="control-label" for="genre">Genre</label>
                <div class="controls">
					<select name="genre">
						<option value=""></option>
					  <option value="Impressionism">Impressionism</option>
					  <option value="Cubism">Cubism</option>
					  <option value="Surrealism">Surrealism</option>
					  <option value="Photography">Photography</option>
					  <option value="Contemporary">Contemporary</option>
					  <option value="Dadaism">Dadaism</option>
					  <option value="Classical">Classical</option>
					  <option value="Neoclassical">Neoclassical</option>
					  <option value="Baroque">Baroque</option>
					  <option value="Rococo">Rococo</option>
					  <option value="Other">Other</option>
					</select>          
                  </div></div>

                  <div class="control-group">
                <label class="control-label" for="textarea">Artist Statement</label>
                <div class="controls">
                  <textarea class="input-xlarge" id="statement" rows="10"  name="statement" >'.$statement.'</textarea>
                  <br><br>
=======
                  <input type="text" name="country" placeholder="'.$country.'"><br><br>
>>>>>>> 14892b5ae39660ab992173b840ab12fdbe25eca0
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
		$uID = $_GET['uID'];
		if($stmt->prepare("select first, last, city, state, country, statement from users where uID=?") or die(mysqli_error($db))){
			$stmt->bind_param('s', $uID);
			$stmt->execute();
			$stmt->bind_result($first, $last, $city, $state, $country, $statement);
			$stmt->fetch();
				echo"<div class='row-fluid'><form action='follow.php' method='post'>
						<input type='hidden' value='".$uID."' name='uID'>
						<button class='btn btn-inverse btn-small' type='submit'>Follow!</button></div>
						</form>
						<div style='text-align: center'><h1>$first $last</h1></div>";
						
				
				
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

		if($stmt->prepare("select aID, title, year, medium, URL, thumbURL, first, last, genreID from artwork natural join users natural join artTags where uID=? order by timestamp desc") or die(mysqli_error($db))){
			$stmt->bind_param('s', $uID);
			$stmt->execute();
			$stmt->bind_result($artID, $title, $year, $medium, $imageURL, $thumbURL, $first, $last, $genreID);
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

					/*$stmt2 = $db->stmt_init();
					if($stmt2->prepare("select genreID from artTags where aID=?") or die(mysqli_error($db))){
						$stmt2->bind_param('s', $artID);
						$stmt2->execute();
						$stmt2->bind_result($genreID);
					}
					$stmt2->close;*/
				
				echo"<div class='span3' style='min-width:275px; border-width:1px; border-style:solid;'><br>
						<a href='$imageURL'><image src='$imageURL'>
						<h4>$title</h4></a>
						Artist: $first $last<br>
						Medium: $medium<br>
						Year: $year<br>
						<form action='favorite.php' method='post'>
						<input type='hidden' value='".$artID."' name='aID'>
						<input type='hidden' value='".$uID."' name='uID'>
						<button class='btn btn-inverse btn-small' type='submit' style = 'margin-left:10px; margin-bottom:0px; margin-top:10px'>Favorite!</button></div>
						</form>
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
		    $strank = $db->stmt_init();
		    if($strank->prepare("select count(*) from artwork where uID=?")or die(mysqli_error($db))){
		    	$strank->bind_param('s', $uID);
		    	$strank->execute();
		    	$strank->bind_result($usercount);
		    	$strank->fetch();
		    }
		    if($strank->prepare("select * from v")or die(mysqli_error($db))){
		    	$strank->execute();
		    	$strank->store_result();
		    	$strank->bind_result($totalcount);
		    	$strank->fetch();
		    }
		    //says cs4750zya6yu.percentageQQ does not exist, but it definitely shows up in SQL workbench
		    if($strank->prepare("call percentageQQ(?, ?)")or die(mysqli_error($db))){
		    	$strank->bind_param('ss', $usercount, $totalcount);
		    	$strank->execute();
		    	$strank->store_result();
		    	$strank->bind_result($percent);
		    	$strank->fetch();

		    }
		    $percent = substr($usercount / $totalcount * 100, 0, 4).'%';
		    $stmt5 = $db->stmt_init();
		    if($stmt5->prepare("insert into metrics (uID, count) values (?, ?)")or die(mysqli_error($db))){
		    	$stmt5->bind_param('ss', $uID, $percent);
		    	$stmt5->execute();

		    }
		    $strank->close();
		    //manual calculation because stored procedure didn't work
		    
		    echo'Uploaded '.$percent.' of the artwork on Arteca<br>';
		     if($city&&$state&&$country){
					echo"Location: $city, $state, $country<br>";
				}
				elseif($city&&$state){
					echo"Location: $city, $state";
				}
				elseif($state&&$country){
					echo"Location: $state, $country";
				}
				elseif($country){
					echo"Location: $country";
				}

				if($statement){
					echo"<br><p>Statement: $statement<p><br>";	
				}

				$stmt2 = $db->stmt_init();
				$uID = $_GET['uID'];

				if($stmt2->prepare("select genreID from userTags where uID=?") or die(mysqli_error($db))){
					$stmt2->bind_param('s', $uID);
					$stmt2->execute();
					$stmt2->store_result();
					$stmt2->bind_result($userGenre);
					$stmt2->fetch();
					echo "<br>#$userGenre";
				}

				echo'</div>';
		 echo'
		    <div class="tab-pane fade" id="tab3">';
		      $stmt3 = $db->stmt_init();
			if($stmt3->prepare("select uID, posted, text, first, last from comments natural join users where bID=? order by posted") or die(mysqli_error($db))){
							
					
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
						<form action='postComment.php' method='post'><textarea name='comment' 
						rows='2'>Write a comment</textarea><button type='submit' class='btn btn-link'>Post</button>
						<input type='hidden' name='bID' value='".$bID."'><input type='hidden' name = 'postUID' value ='".$uID."'></form></div>";

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

		echo'Professor Sherriff, please proceed as if this were a normal website and you were new to it.  Once you register, it will bring 
		you back to the home screen and you must log in with the information you registered with.  For searching by genre, choose Neoclassical.  Enjoy.

		';
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
                <label class="control-label" for="genre"></label>
                <div class="controls">
					<select name="genre">
					  <option value=""></option>
					  <option value="Impressionism">Impressionism</option>
					  <option value="Cubism">Cubism</option>
					  <option value="Surrealism">Surrealism</option>
					  <option value="Photography">Photography</option>
					  <option value="Contemporary">Contemporary</option>
					  <option value="Dadaism">Dadaism</option>
					  <option value="Classical">Classical</option>
					  <option value="Neoclassical">Neoclassical</option>
					  <option value="Baroque">Baroque</option>
					  <option value="Rococo">Rococo</option>
					  <option value="Other">Other</option>
					</select>                </div>
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