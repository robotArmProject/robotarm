<?php
include ('session.php');
include('logging.php');
$robotID = $_POST['robotID'];
$userID = $login_session;
$robotInfo = mysqli_query($con,"SELECT * FROM adminSettings WHERE robotID = '$robotID'");
$row = mysqli_fetch_array($robotInfo,MYSQLI_ASSOC);
$mode = $row['automatic'];

if($mode == 1){
	$newMode = 0;
	$mode_text = "Manual";
}
else{
	$newMode = 1;
	$mode_text = "Automatic";
}
$action = "Mode change for robot with ID =$robotID, change mode to $mode_text";
writeLog($userID,$action);
$sql = "UPDATE adminSettings SET automatic = $newMode WHERE robotID = '$robotID'";

mysqli_query($con,$sql);
header("Location: user.php");
?>