<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);
	require "dbutil.php";
	require "PasswordHash.php";
	require "session.php";
	
	$db = DbUtil::loginConnection();

	$stmt = $db->stmt_init();

	$email = $_POST['email'];
	$pass = $_POST['pass'];






	//run on authentication priveledges
	if($stmt->prepare("select uID, permissions, password from users where email=?") or die(mysqli_error($db)))
	{
		$pwdHasher = new PasswordHash(8, FALSE);
		
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->bind_result($uID, $permission, $hash);
		//echo'<html><body>';
		//echo'<table border=1><th>email</th><th>password</th><th>uID</th><th>permissions</th>';
		$stmt->fetch();
		$checked = $pwdHasher->CheckPassword($pass, $hash);
		
		/*
		echo $email.'<br>';
		echo $hash.'<br>';
		if($checked == true){
		echo 'true'.'<br>';
		
		}
		echo $uID . '<br>';
		while($stmt->fetch()){
			echo "<tr>
			<td>$email</td>
			<td>$pass</td>
			<td>$uID</td>
			<td>$permission</td>
			</tr>";
		}
		echo'</table></body></html>';*/

		//run on user priveledges?
		if($checked == true){
			if($stmt->prepare("select first, last from users where uID= ?") or die(mysqli_error($db)))
			{
				$stmt->bind_param("s", $uID);
				$stmt->execute();
				$stmt->bind_result($first, $last);
				$stmt->fetch();
			}
			open_session();
			$_SESSION['user'] = $uID;
			$_SESSION['first'] = $first;
			$_SESSION['last'] = $last;
			echo $_SESSION['user'];
			}

	}
	$db->close();
	header("Location: http://plato.cs.virginia.edu/~zya6yu/index.php", TRUE, 303);
?>