<?php
 include('session.php');
 include('logging.php');
 $userID = $login_session; 
 $action = "User has logged in";
 writeLog($userID,$action);
 header("location: user.php");

?>