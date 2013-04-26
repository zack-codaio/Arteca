<?php
	//require_once "session.php";
	session_start();
	require_once "dbutil.php";

	$uID = $_SESSION['user'];

	$db = DbUtil::loginConnection();

	$stmt = $db->stmt_init();

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$city = $_POST['city'];
	$state = $_POST['State'];
	$country = $_POST['country'];
	$text = $_POST['statement'];
	$genreID = $_POST['genre'];
	echo $text;

	if($firstname != NULL && $lastname != NULL){

		if($stmt->prepare("update users set first=?, last=?, city=?, state=?, country=?, statement=? where uID=?") or die(mysqli_error($db))){
			$stmt->bind_param("sssssss", $firstname, $lastname, $city, $state, $country, $text, $uID);
			$stmt->execute();


		}
	}

	if($genreID!=""){
		if($stmt->prepare("update userTags set genreID=? where uID=?") or die(mysqli_error($db))){
			$stmt->bind_param("ss", $genreID, $uID);
			$stmt->execute();

		}
	}
	$stmt->close();
	$db->close();
	header("Location: http://plato.cs.virginia.edu/~zya6yu/index.php?func=profile&uID=".$_SESSION['user'], TRUE, 303);
?>