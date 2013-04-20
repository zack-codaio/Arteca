<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);
	
	require "PasswordHash.php";
	require "dbutil.php";

	$db = DbUtil::loginConnection();

	$stmt = $db->stmt_init();

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$pass1 = $_POST['pass1'];
	$pass2 = $_POST['pass2'];

	if($firstname != NULL || $lastname != NULL || $email != NULL || $pass1 != NULL || $pass2 != NULL){
	

	$uID = substr($firstname, 0, 5) . substr($lastname, 0, 5) . substr(md5($email), 0, 10);
	//uID = first 5 letters of first name + first 5 letters of last name + first 10 characters of md5 hash of email

	if ($pass1 != $pass2) 	//compare passwords
	{
	//echo 'Passwords do not match.';
	}

	//need check for email already in database

	elseif($stmt->prepare("insert into users (uID, first, last, email, password) values (?, ?, ?, ?, ?)") or die(mysqli_error($db)))
	{

	//crypt passwords
	$pwdHasher = new PasswordHash(8, FALSE);
	$hash = $pwdHasher->HashPassword($pass1);
	//echo $hash . ' <br>';
	$stmt->bind_param("sssss", $uID, $firstname, $lastname, $email, $hash);
	$stmt->execute();
	//echo 'inserted ' . $uID;
	}
}
$db->close();
header("Location: http://plato.cs.virginia.edu/~zya6yu/index.php", TRUE, 303);
?>
<html><body>cat</body></html>