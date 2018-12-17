<?php 
include('session.php');
include('logging.php');
$robotID = $_GET['robotID'];
$userID = $_GET['userID'];
$action = "User has connected to robot with ID =$robotID";
writeLog($userID,$action); 
$sql = "UPDATE robotconfig SET connected = 1, userID = $userID  WHERE idrobotconfig = $robotID";
mysqli_query($con,$sql);
header("Location: user.php");
?>