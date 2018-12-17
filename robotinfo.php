<html>
<head>
    <title> Robot Info </title>
    <meta charset = "UTF-8">
</head>
 
<?php
include ('session.php');
include('menu.php');
include('logging.php');
$robotID = $_POST['robotinfo'];
$userID = $login_session;
$action = "User requested infomation about robot with the ID = $robotID";
writeLog($userID,$action);
$robotINFO2 = mysqli_query($con,"SELECT * FROM robotconfig WHERE idRobotconfig = '$robotID'");
$activeRobot = mysqli_fetch_array($robotINFO2,MYSQLI_ASSOC);
$robotmodel = $activeRobot['robotmodel'];
$robotINFO = mysqli_query($con,"SELECT * FROM adminSettings WHERE robotID = '$robotID'");
$robotrow = mysqli_fetch_array($robotINFO,MYSQLI_ASSOC);
$mode = "";

if($robotrow['automatic'] == 1){
	$mode = "Automatic";
}
else{
	$mode = "Manual";
}
?>
<div id="productinfo">
 <table class = "prod">
	<tr>
			<td class="userclass"> <h2> RobotID | </h2> </td>
			<td class="userclass"> <h2> RobotModel |  </h2> </td>
			<td class="userclass"> <h2> Connected  | </h2> </td>
			<td class="userclass"> <h2> UserID  | </h2> </td>
			<td class="userclass"> <h2> Nr of Joints | </h2> </td>
			<td class="userclass"> <h2> Mode  | </h2> </td>
			<td class="userclass"> <h2> Active  </h2> </td>

	</tr>
	<tr> 
			<td class="userclass"> <?=$robotID;?> </td>
			<td class="userclass">  <?=$activeRobot['robotmodel'];?></td>
			<td class="userclass">  <?=$activeRobot['connected'];?></td>
			<td class="userclass">  <?=$activeRobot['userID'];?></td>
			<td class="userclass">  <center><?=$activeRobot['joints'];?></center></td>
			<td class="userclass">  <?=$mode;?></td>
			<td class="userclass">  <?=$robotrow['active'];?></td>
	</tr>
	
</table>

<td class="item"><form action="adminPriv.php?sorted=all" method="post">
			<input type="submit" value="Go back">
			</form></td>
</div>
<center>
<?php 
$files = glob("Images\RobotImg/*$robotmodel.*");

for ($i=0; $i<count($files); $i++) {
    $image = $files[$i];
    echo '<img src="'.$image .'" id = "robotPic"/>'."<br /><br />";
}
?>
</center>

</html>
