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
				$robotINFO = mysqli_query($con,"SELECT * FROM adminSettings WHERE robotID = '$robotID'");
				$robotrow = mysqli_fetch_array($robotINFO,MYSQLI_ASSOC);
				$newID = $robotrow['idadminSettings'];
				$robotINFO = mysqli_query($con,"SELECT * FROM adminSettings WHERE active = 1");
				$robotrow = mysqli_fetch_array($robotINFO,MYSQLI_ASSOC);
				$oldID = $robotrow['idadminSettings'];
			
				$sql = "UPDATE adminSettings SET active = 0 WHERE idadminSettings=$oldID";
				mysqli_query($con,$sql);
				$sql2="UPDATE adminSettings SET active = 1 WHERE idadminSettings=$newID";
				mysqli_query($con,$sql2);
				$action = "Switch active robot from $oldID to $newID";
				writeLog($userID,$action);
				header("Location: adminPriv.php?sorted=all");
			}
		else{
			header("Location:adminPriv.php?sorted=all&error2=WRONG_NUMBER");
		}
	}
	
	
	else{
		header("Location:adminPriv.php?sorted=all&error=NOT_A_NUMBER");
	}
?>