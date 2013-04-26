<?php

session_start();
require "dbutil.php";
	
$db = DbUtil::loginConnection();

$stmt = $db->stmt_init();

$userID = $_POST['uID'];

if($userID!=$_SESSION['user']){
	if($stmt->prepare("insert into following (uID, targetID) values (?, ?)") or die(mysqli_error($db))){
		$stmt->bind_param("ss", $_SESSION['user'], $userID);
		$stmt->execute();
	}
}

$stmt->close();
$db->close();
header("Location: http://plato.cs.virginia.edu/~zya6yu/index.php?func=profile&uID=".$userID, TRUE, 303);
?>
<html><body>cat</body></html>