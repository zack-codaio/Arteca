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
		//echo hello;
		break;
	case collection:
		break;
	case favorites:
		break;
	case newpost:
		break;
	case upload:
		break;
	case trades:
		break;
	case genre:
		break;
	case profile:
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
		break;
	default:
		break;
}



templateend();
?>