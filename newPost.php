<?php
	require_once "dbutil.php";

	session_start();

	$title = $_POST['title'];
	$text = $_POST['blogpost'];
	$uID = $_SESSION['user'];
	$bID = substr($uID, 0, 10) . 'B' . substr(md5($title), 0, 9);//bID = first 10 of uID + B + first 9 of md5 of title

	
	$db = DbUtil::loginConnection();
	$stmt = $db->stmt_init();

	if($stmt->prepare("insert into blogPosts (text, title, uID, bID) values (?, ?, ?, ?)") or die(mysqli_error($db))){
		$stmt->bind_param("ssss", $text, $title, $uID, $bID);
		$stmt->execute();
		echo'inserted<br>$text';

	}
	else {
		echo'insert failed';
	}
	$db->close();

header("Location: http://plato.cs.virginia.edu/~zya6yu/index.php?func=profile&uID=".$_SESSION['user'], TRUE, 303);


?>