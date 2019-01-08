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
<table class = "cat">
	Current Status of the robot:
	<Br>
	<?php
	date_default_timezone_set("Europe/Stockholm");
	echo "Last updated (GMT+1): " . date("H:i:s");
	?>
	<br>
	<tr>
	<?php for($i = 1; $i < $joints + 1; $i++){ ?>
		<td> Joint<?php echo $i; ?> </td> <td></td>
	<?php } ?>
	</tr>
	<tr>
	<?php for($i = 0; $i < $joints ; $i++){ ?>
		<td><center> <?php echo $joints_info[$i] ?> </center></td>  <td></td>
	<?php }	?>
	</tr>
	
	
</table>
