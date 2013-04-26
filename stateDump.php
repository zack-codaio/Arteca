<?php

session_start();
require "dbutil.php";
	
$db = DbUtil::loginConnection();

$stmt = $db->stmt_init();

$state = $_POST['State'];

echo "<table border=1><th>First</th><th>Last</th><th>Email</th><th>City, State</th>\n";


if($stmt->prepare("select first, last, email, city from users where state=?") or die(mysqli_error($db))){
		$stmt->bind_param("s", $state);
		$stmt->execute();
		$stmt->bind_result($first, $last, $email, $city);
		while($stmt->fetch()){

		echo "<tr><td>$first</td><td>$last</td><td>$email</td><td>$city, $state</td></tr>";
		}
	
}

$stmt->close();
$db->close();
?>
