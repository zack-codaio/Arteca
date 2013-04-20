<?php
	require "dbutil.php";
	$db = DbUtil::loginConnection();
	
	$stmt = $db->stmt_init();
	
	if($stmt->prepare("select courseID, deptID, courseName from sisdata where deptID like ?") or die(mysqli_error($db))) {
		$searchString = '%' . $_GET['searchIP'] . '%';
		$stmt->bind_param(s, $searchString);
		$stmt->execute();
		$stmt->bind_result($ip, $user, $datetime);
		echo "<table border=1><th>Course ID</th><th>Mnemonic</th><th>Course Name</th>\n";
		while($stmt->fetch()) {
			echo "<tr><td>$ip</td><td>$user</td><td>$datetime</td></tr>";
		}
		echo "</table>";
	
		$stmt->close();
	}
	
	$db->close();


?>