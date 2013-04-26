<?php
session_start();
require "dbutil.php";

//$conn = ftp_connect('labunix03.cs.virginia.edu') or die("Coult not connect");
//$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);


echo $login_result . "<br>";
$year = $_POST['year'];


$allowedExts = array("gif", "jpeg", "jpg", "png", "JPG", "PNG", "JPEG", "GIF");
$extension = end(explode(".", $_FILES["file"]["name"]));
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/JPG")
|| ($_FILES["file"]["type"] == "image/JPEG")
|| ($_FILES["file"]["type"] == "image/GIF")
|| ($_FILES["file"]["type"] == "image/PNG"))

&& ($_FILES["file"]["size"] < 1000000000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0 )
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

    if(!is_dir("images/".$_SESSION['user']."/")){
      //echo "not directory";
      mkdir("images/".$_SESSION['user']."/");
    }

    if (file_exists(getcwd() . "/images/". $_SESSION['user']. "/". $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      $test = move_uploaded_file($_FILES["file"]["tmp_name"],
      "images/". $_SESSION['user']. "/" . $_FILES["file"]["name"]);
      if($test){
      echo "Stored in: " . getcwd() . "/images/". $_SESSION['user']. "/" . $_FILES["file"]["name"];
      
      $db = DbUtil::loginConnection();
      $stmt = $db->stmt_init();

      //columns
      $title = "Untitled";
      if($_POST['title'] != NULL){
        $title = $_POST['title'];
      }
      $artistID = $_SESSION['user'];
      $medium = $_POST['medium'];
      $ownerID = $_SESSION['user'];
      $URL = "http://plato.cs.virginia.edu/~zya6yu/images/".$_SESSION['user']."/".$_FILES["file"]["name"];
      $genreID = $_POST['genre'];
      $thumbURL;
      $aID = substr($_SESSION['user'], 0, 10) .'A'. substr(md5($title), 0, 9); //aID = same first10 as uID + first 10 characters of md5 of filename



      if($stmt->prepare("insert into artwork (title, uID, year, medium, ownerID, URL, aID) values (?, ?, ?, ?, ?, ?, ?)") or die(mysqli_error($db)))
      {
        $stmt->bind_param("sssssss", $title, $artistID, $year, $medium, $ownerID, $URL, $aID);
        $stmt->execute();
        echo'inserted into DB';
        //$stmt->close();
      }


      
      if($stmt->prepare("insert into artTags (aID, genreID) values (?, ?)") or die(mysqli_error($db)))
        {
          $stmt->bind_param("ss", $aID, $genreID);
          $stmt->execute();
          //echo'inserted into DB';
          $stmt->close();
        }
      


      $db->close();
      header("Location: http://plato.cs.virginia.edu/~zya6yu/index.php?func=myart", TRUE, 303);
      }
      
      }
    }
  }
else
  {
  echo "Invalid file";
  }

?>