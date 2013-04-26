<?php
	require "dbutil.php";
	$db = DbUtil::loginConnection();

	$stmt = $db->stmt_init();
	if($stmt->prepare("select uID, first, last, city, state, country, statement from users where first like ? or last like ?") or die(mysqli_error($db))){
		//echo $_POST['searchArtist'].'<br>';
		$searchString = '%' . $_GET['searchArtist'].'%';
		//echo $searchString;
		$stmt->bind_param('ss', $searchString, $searchString);
		$stmt->execute();
		$stmt->bind_result($uID, $first, $last, $city, $state, $country, $statement);
		echo"<table border=1><th>First</th><th>Last</th>\n";
		while($stmt->fetch()){
			echo"<tr><td>$first</td><td>$last</td></tr>";
		}
		echo"</table>";
		$stmt->close();

	}

	$db->close();

?>