<?php 
include('session.php');
include('logging.php');
$userID = $login_session;
	$robotID = $_POST['robotID'];
	if(is_numeric($robotID)){
			$sql = "SELECT idrobotconfig FROM robotconfig";
			$res = mysqli_query($con,$sql);
			$i =1;

			while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
				$i++;
			}
			if($robotID < $i){
				$sql = "UPDATE robotconfig SET connected = 0, userID = 0 WHERE idrobotconfig=$robotID";
				mysqli_query($con,$sql);
				header("Location: adminPriv.php?sorted=all");
				$action = "Removed connected user from robot with the ID = $robotID";
				writeLog($userID,$action);
			}
			else{
			
				header("Location:adminPriv.php?sorted=all&error2=WRONG_NUMBER");
				$action = "Failed to remove connected user due to id was not valid";
				writeLog($userID,$action);
			}
	}
	else{
		header("Location:adminPriv.php?sorted=all&error2=NOT_A_NUMBER");
		$action = "Failed to remove connected user due to id was not valid";
		writeLog($userID,$action);
	}
?>