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

		$stmt = $db->stmt_init();

		if($stmt->prepare("select aID, title, artistname, artistID, year, medium, ownerID, URL, thumbURL from artwork where artistID=?") or die(mysqli_error($db))){
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
			$db->close();
		break;
	case collection:
		$stmt = $db->stmt_init();

		if($stmt->prepare("select aID, title, artistname, artistID, year, medium, ownerID, URL, thumbURL from artwork where ownerID=?") or die(mysqli_error($db))){
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
			$db->close();
			break;
	case favorites:
		$stmt = $db->stmt_init();

		if($stmt->prepare("select aID from favorites where uID=?") or die(mysqli_error($db))){
						$stmt->bind_param('s', $_SESSION['user']);
						$stmt->execute();
						$stmt->bind_result($artID);
						while($stmt->fetch()){
							$stmt2 = $db->stmt_init();
							if($stmt2->prepare("select aID, title, artistname, artistID, year, medium, ownerID, URL, thumbURL from artwork where aID=?") or die(mysqli_error($db))){
								$stmt2->bind_param('s', $artID);
								$stmt2->execute();
								$stmt2->bind_result($artID, $title, $artistName, $artistID, $year, $medium, $ownerID, $imageURL, $thumbURL);
								while($stmt2->fetch()){
									echo"<h4>Title: $title</h4><br>
											Artist: $artistName<br>
											Medium: $medium<br>
											Year: $year<br>";
								}


							}
						}



		}


		if($stmt->prepare("select aID, title, artistname, artistID, year, medium, ownerID, URL, thumbURL from artwork where ownerID=?") or die(mysqli_error($db))){
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
			$db->close();
		break;
	case newpost:

		echo'
		<form name="newPost" action="newPost.php" method="post">		Title:<input type="text" name="title" placeholder="New Post"><br>
		<TEXTAREA NAME="blogpost" ROWS=11 COLS=50></TEXTAREA>

		<br><button class="btn btn-primary" type="submit">Submit</button>
		

		</form>
		';
		break;
	case upload:
		echo'<p>
		<form action="imgUpload.php" method="post" enctype="multipart/form-data">
			<label for="file">Filename:</label>
			<input type="file" name="file" id="file"><br>
			<input type="submit" name="submit" value="Submit">
		</form>
		</p>';
		break;
	case artists:
		break;
	case genre:
		//create new

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
                  <input type="text" name="firstname" placeholder="'.$first.'">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputLast">Last Name</label>
                <div class="controls">
                  <input type="text" name="lastname" placeholder="'.$last.'">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputCity">City</label>
                <div class="controls">
                  <input type="text" name="city" placeholder="'.$city.'">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputState">State</label>
                <div class="controls">
                  <input type="text" name="state" placeholder="'.$state.'">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputCountry">Country</label>
                <div class="controls">
                  <input type="text" name="country" placeholder="'.$country.'"><br><br>
                	<button class="btn btn-primary" type="submit">Submit</button>
            </form>
                </div>
              	
              </div>
              
              </p>

            </div>
            
            ';
		break;
	case profile:
		$uID = $_GET['uID'];
//		echo $uID;

		$stmt = $db->stmt_init();

		if($stmt->prepare("select first, last, city, state, country, statement from users where uID=?") or die(mysqli_error($db))){
			$stmt->bind_param('s', $_GET['uID']);
			$stmt->execute();
			$stmt->bind_result($first, $last, $city, $state, $country, $statement);
			$stmt->fetch();
				echo"<h4>$first $last</h4><br>";
						
				if($city&&$state&&$country){
					echo"$city, $state, $country<br>";
				}
				if($statement){
					echo"<p>$statement<p>";	
				}
				
				
			}

			
			$stmt->close();
			$db->close();
		break;
	default:
		//home stream
		break;
}



templateend();
?>