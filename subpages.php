<?php
session_start();
/*ini_set('display_errors', 'On');
error_reporting(E_ALL);*/

require_once "dbutil.php";

$db = DbUtil::loginConnection();
mysqli_report(MYSQLI_REPORT_ALL);


function profile(){
	$uID = $_GET['uID'];
//		echo $uID;

		$stmt = $db->stmt_init();

		if($stmt->prepare("select first, last from users where uID=?") or die(mysqli_error($db))){
			$stmt->bind_param('s', $_GET['uID']);
			$stmt->execute();
			$stmt->bind_result($first, $last);
			while($stmt->fetch()){
				echo "$first $last";}	
			}

			
			$stmt->close();
			$db->close();
	}
	




?>
