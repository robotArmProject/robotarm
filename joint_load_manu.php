<?php include('session.php'); 
$robotINFO = mysqli_query($con,"SELECT * FROM adminSettings WHERE active = 1");
$robotrow = mysqli_fetch_array($robotINFO,MYSQLI_ASSOC);
$robotID = $robotrow['robotID'];
$robotINFO2 = mysqli_query($con,"SELECT * FROM robotconfig WHERE idRobotconfig = '$robotID'");
$activeRobot = mysqli_fetch_array($robotINFO2,MYSQLI_ASSOC);
$joints = $activeRobot['joints'];
$robotINFO3 = mysqli_query($con,"SELECT * FROM robot_data WHERE robotID='$robotID'");
$robotrow2 = mysqli_fetch_array($robotINFO3,MYSQLI_ASSOC);
$joints_data = $robotrow2['joint_orientation'];

$joints_info = explode(",", $joints_data);
?>
Enter where you want the robot to move
	<table>
	<tr>
	<?php for($i = 1; $i < $joints + 1; $i++){ ?>
	
	<td> <center>Joint<?php echo $i; ?></center> </td>
	
	
	
	<?php } ?>
	<tr>
	<?php for($i = 0; $i < $joints ; $i++){
	$index = $i +1 ;
	?>

	<td><input type="text" size="4px" id="string<?php echo $index;?>" value = <?php echo $joints_info[$i];?>></td>
	<?php } ?>
	<br>
	</tr>
	<tr>
	<td><center><button onclick="target_dest()">Send</button></center></td>
	</tr>
	
	</table>	