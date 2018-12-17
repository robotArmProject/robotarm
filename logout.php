<?php
	include('session.php');
	include('logging.php');
	$userID = $login_session;
	session_start();
	
	$sql = "SELECT idrobotconfig FROM robotconfig WHERE userID = $userID";
	$res = mysqli_query($con,$sql);
	if(mysqli_num_rows($query) > 0){
		$sql = "SELECT * FROM robotconfig WHERE userID = $userID";
		$res = mysqli_query($con,$sql);
		$activeRobot = mysqli_fetch_array($res,MYSQLI_ASSOC);
		$robotID = $activeRobot['idrobotconfig'];
		$sql = "UPDATE robotconfig SET connected = 0, userID = 0 WHERE idrobotconfig=$robotID";
		mysqli_query($con,$sql);
		$action = "Disconnected user from robot due to logged off";
		writeLog($userID,$action);
		header("Location: index.php");
	}
	$action = "User has logged off";
	writeLog($userID,$action);
	if(session_destroy()){
		header("Location: index.php");
	}
	header("Location: index.php");
?>