<?php 
 function writeLog($userID,$action){
	include("session.php");
	$userIP = $_SERVER['REMOTE_ADDR'];
	
	date_default_timezone_set("Europe/Stockholm");
	$timestamp = date("Y-m-d H:i:s");
	$sql ="INSERT INTO logging ( userID,userIP,timestamp,action) VALUES ($userID,'$userIP','$timestamp','$action')";
	 mysqli_query($con,$sql); 
 }
?>