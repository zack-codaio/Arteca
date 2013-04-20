<?php
session_start();
require "dbutil.php";

//$conn = ftp_connect('labunix03.cs.virginia.edu') or die("Coult not connect");
//$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);


echo $login_result . "<br>";



$allowedExts = array("gif", "jpeg", "jpg", "png");
$extension = end(explode(".", $_FILES["file"]["name"]));
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 10000000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    echo getcwd() . "<br>";
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists(getcwd() . "/images/". $_SESSION['user']. "/". $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      $test = move_uploaded_file($_FILES["file"]["tmp_name"],
      getcwd().  "/images/". $_SESSION['user']. "/" . $_FILES["file"]["name"]);
      if($test){
      echo "Stored in: " . getcwd() . "/images/". $_SESSION['user']. "/" . $_FILES["file"]["name"];  
      }
      
      }
    }
  }
else
  {
  echo "Invalid file";
  }
?>