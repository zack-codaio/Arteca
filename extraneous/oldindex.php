<?php

echo'
<!DOCTYPE html>
<html lang="en">
<head>
<title>Public Facing Log-In & Register</title>
</head>
<body>';

//check cookie, if set, redirect to user homepage, else display landing page + log-in and register
session_start();
if(isset($_SESSION['user'])){
	echo'Logged in as ' . $_SESSION['first'].' '. $_SESSION['last'];

//img upload form:
echo'<p>
<form action="http://labunix01.cs.virginia.edu/cslab/home/zya6yu/public_html/imgUpload.php" method="post" enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Submit">
</form>

</p>';


}





//log-in form
echo'<p>
<form action="login.php" method ="post">
Email: <input type="text" name="email"><br>
Password: <input type="password" name="pass"><br>
<input type="submit" value="Sign-In">
</form>
</p>';

//register form
echo'<h4>Register</h4>
<form action="newUser.php" method="post">
First Name: <input type="text" name="firstname"><br>
Last Name: <input type="text" name="lastname"><br>
Email Address: <input type="text" name="email"><br>
Password: <input type="password" name="pass1"><br>
Confirm Password: <input type="password" name="pass2"><br>
<input type="submit" value="Submit">
</form>';


echo'
<script src="assets/js/jquery-1.9.1.js"></script>
<script src="assets/js/bootstrap.js"></script>
</body>
</html>';

?>