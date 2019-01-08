<?php
include('session.php');
include('logging.php');
$userID = $login_session;
$robotID = $_GET['robotID'];
$action = "User has disconnected to robot with ID =$robotID";
writeLog($userID,$action); 
$sql = "UPDATE robotconfig SET connected = 0, userID = 0  WHERE idrobotconfig = $robotID";
mysqli_query($con,$sql);
header("Location: user.php");
?>