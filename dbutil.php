<?php
class DbUtil{
	public static $loginUser = "cs4750zya6yu"; 
	public static $loginPass = "xxxxxx";
	public static $host = "stardock.cs.virginia.edu"; // DB Host
	public static $schema = "cs4750zya6yu"; // DB Schema

	public static $ftp_server = "labunix01.cs.virginia.edu";
	public static $fpt_user_name = "zya6yu";
	public static $ftp_user_pass = "xxxxxx";
	
	public static function loginConnection(){
		$db = new mysqli(DbUtil::$host, DbUtil::$loginUser, DbUtil::$loginPass, DbUtil::$schema);
	
		if($db->connect_errno){
			echo("Could not connect to db");
			$db->close();
			exit();
		}
		
		return $db;
	}
	
}
?>