<?php 
include('session.php');
include('logging.php');
$userID = $login_session;
$action = $_GET['action'];
writeLog($userID,$action);
?>