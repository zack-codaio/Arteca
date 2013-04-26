<?php

session_start();
require "dbutil.php";
	
$db = DbUtil::loginConnection();

$stmt = $db->stmt_init();

$genreID = $_POST['genre'];

	


$stmt->close();
$db->close();
header("Location: http://plato.cs.virginia.edu/~zya6yu/index.php?func=genreSearch&genreID=".$genreID, TRUE, 303);
?>
<html><body>cat</body></html>