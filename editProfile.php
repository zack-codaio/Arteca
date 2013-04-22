<?php
	session_start();
	require_once "dbutil.php";

	$uID = $_SESSION['user'];

	$db = DbUtil::loginConnection();

	$stmt = $db-.stmt_init();

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$country = $_POSt['country'];

	if($firstname != NULL && $lastname != NULL){

		if($stmt->prepare("update users set first=?, last=?, city=?, state=?, country=? where uID=?") or die(mysqli_error($db))){
			$stmt->bind_param("ssssss", $firstname, $lastname, $city, $state, $country, $uID);
			$stmt->execute();


		}
	




	}
	$db->close();
	header("Location: http://plato.cs.virginia.edu/~zya6yu/index.php", TRUE, 303);
?>