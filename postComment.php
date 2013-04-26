<?php
require "dbutil.php";
session_start();

$db = DbUtil::loginConnection();

$stmt = $db->stmt_init();
$text = $_POST['comment'];
$bID = $_POST['bID'];
$uID = $_SESSION['user'];
$cID = substr($uID, 0, 10). 'C'.substr(md5($text),0,9);
echo $text . '<br>' . $bID;
if($stmt->prepare("insert into comments (uID, bID, cID, text) values (?, ?, ?, ?) ")or die(mysqlie_error($db))){
	$stmt->bind_param("ssss", $uID, $bID, $cID, $text);
	$stmt->execute();
	$stmt->close();
}
/*
if($stmt->prepare("select uID from blogPosts where bID = ?")or die(mysqli_error($db))){
	$stmt->bind_param("s", $bID);
	$stmt->execute();
	$stmt->bind_result($postUID);
	$stmt->fetch();
}*/

$db->close();
$postUID = $_POST['postUID'];
header("Location: http://plato.cs.virginia.edu/~zya6yu/index.php?func=profile&uID=".$postUID, TRUE, 303);
?>