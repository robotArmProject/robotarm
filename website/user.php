<!DOCTYPE>
<html lang = "en-US">
<?php
include('session.php');
include('menu.php');
include('logging.php');
$userID = $login_session;
$userINFO = mysqli_query($con,"SELECT * FROM Users WHERE idUsers = '$userID'");
$row = mysqli_fetch_array($userINFO,MYSQLI_ASSOC);
$robotINFO = mysqli_query($con,"SELECT * FROM adminSettings WHERE active = 1");
$robotrow = mysqli_fetch_array($robotINFO,MYSQLI_ASSOC);
$robotID = $robotrow['robotID'];
if($robotID == null){
$robotError = "No active robot selected please contact Admin";
}
$robotINFO2 = mysqli_query($con,"SELECT * FROM robotconfig WHERE idRobotconfig = '$robotID'");
$activeRobot = mysqli_fetch_array($robotINFO2,MYSQLI_ASSOC);
if($activeRobot['connected'] == 0 || $activeRobot['userID'] == $userID){
	$blocked = 0;
	$error= "You have to connect to the robot ";
}
else{
	$error = "Please wait,some other user is connected to the robot.";
	$blocked = 1;
}

 
?>
<head>
	<meta charset="UTF-8">
	<title> Controll robot </title>
	<script type="text/javascript" src="http://static.robotwebtools.org/EventEmitter2/current/eventemitter2.min.js"></script>
	<script type="text/javascript" src="http://static.robotwebtools.org/roslibjs/current/roslib.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" type="text/javascript">
	function loadJoints(){ //Loading current joint status from database
		$.ajax({
			type:"GET",
			url:"jointLoad.php",
			success:function(data){
				$("#categories").html(data);
			}
		});
		setTimeout(loadJoints,400);
	}
	function loadJointsManu(){ //Load joint data for target boxes
		$.ajax({
			type:"GET",
			url:"joint_load_manu.php",
			success:function(data){
				$("#joint_target").html(data);
			}
		});
		
	}
	function enterData(action){ //Used for logging user action
		console.log(action);
		$.ajax({
			type:"GET",
			url:"management.php?action="+action,
			success:function(data){
				
			}
		});
	}
	$(document).ready(function(){
		loadJoints();
		loadJointsManu();
	});
	
	  // Connecting to ROS
	  // -----------------
	  var ros = new ROSLIB.Ros({
	    url : 'ws://25.13.181.103:9091' 
	  });
		
	  ros.on('connection', function() {
	    console.log('Connected to websocket server.');
		document.getElementById('conError').innerHTML = "<span style='color: green;'> Connected to ROS computer. </span>";
		//Console log 
	  });

	  ros.on('error', function(error) {
	    console.log('Error connecting to websocket server: ', error);
		document.getElementById('conError').innerHTML = "<span style='color: red;'> Error when connecting to ROS computer. </span>";
		//console log
	  });

	  ros.on('close', function() {
		 document.getElementById('conError').innerHTML = "<span style='color: red;'> Connection closed </span>"; 
	    console.log('Connection to websocket server closed.');
	  });
	  // Publishing a Topic
	  // ------------------
	
	function target_dest() {
		var action ="Moved manipulator to: ["+document.getElementById("string1").value +","+ document.getElementById("string2").value +","+ document.getElementById("string3").value +","+ document.getElementById("string4").value +"]";
	  enterData(action); //loging user action
	  var robotControl = new ROSLIB.Topic({ //create topic
	    ros : ros,
	    name : '/manual_target',
	    messageType : 'std_msgs/Int32MultiArray'
	  });
	  var target_mess = new ROSLIB.Message({
		data: 
			[parseInt(document.getElementById("string1").value) , parseInt(document.getElementById("string2").value) , parseInt(document.getElementById("string3").value) , parseInt(document.getElementById("string4").value)]
			//insert data

		});
		console.log(target_mess.data);
	  robotControl.publish(target_mess);
	}
	function jointMove(j,v) {
	  var action = "Moving joint"+j+"in direction:"+v;
	  enterData(action);
	  var robotControlMessage; 
	  var robotControl = new ROSLIB.Topic({
		ros : ros,
		name : '/joint_move',
		messageType : 'std_msgs/Int32MultiArray'
	  });
	  robotControlMessage = new ROSLIB.Message({
		data:
			[j,v]
		});
	  robotControl.publish(robotControlMessage);
		
	}
	
	function openGripper(){
		enterData("Sent command OpenGripper");

		var robotControl = new ROSLIB.Topic({
		ros : ros,
		name : '/CPRMoverCommands',
		messageType : 'std_msgs/String'
	  });

	  var robotControlMessage = new ROSLIB.Message({
		data: 
			'GripperOpen'});
	  robotControl.publish(robotControlMessage);
	}
	function closeGripper(){
		enterData("Sent command closeGripper");
		var robotControl = new ROSLIB.Topic({
		ros : ros,
		name : '/CPRMoverCommands',
		messageType : 'std_msgs/String'
	  });

	  var robotControlMessage = new ROSLIB.Message({
		data: 
			'GripperClose'});
	  robotControl.publish(robotControlMessage);
	}
	function reset(){
		enterData("Sent command Reset");
		var robotControl = new ROSLIB.Topic({
		ros : ros,
		name : '/CPRMoverCommands',
		messageType : 'std_msgs/String'
	  });

	  var robotControlMessage = new ROSLIB.Message({
		data: 
			'Reset'});
	  robotControl.publish(robotControlMessage);
	}
	function enable(){
		enterData("Sent command Enable");
		var robotControl = new ROSLIB.Topic({
		ros : ros,
		name : '/CPRMoverCommands',
		messageType : 'std_msgs/String'
	  });

	  var robotControlMessage = new ROSLIB.Message({
		data: 
			'Enable'});
	  robotControl.publish(robotControlMessage);
	}
	function stop(){
		enterData("Emergency STOP");
		var robotControl = new ROSLIB.Topic({
		ros : ros,
		name : '/stop',
		messageType : 'std_msgs/String'
	  });	
	  var robotControlMessage = new ROSLIB.Message({
		data: 
			'Stop'});
	  robotControl.publish(robotControlMessage);
	}
	function runAuto (){
	var e = document.getElementById("scriptName");
	var value = e.options[e.selectedIndex].value;
	var text = e.options[e.selectedIndex].text;
	
	var action = "Running script: "+text;
	enterData(action);
	var robotControl = new ROSLIB.Topic({
		ros : ros,
		name : '/script',
		messageType : 'std_msgs/String'
	  });

	  var robotControlMessage = new ROSLIB.Message({
		data: 
			text});
	  robotControl.publish(robotControlMessage);
	
	}
	// Joint constrains [lower limit, high limit]
	// 1 =  [-150,150]
	// 2 = [-30,60]
	// 3 = [-40,140]
	// 4 = [-130,130]
	
	
    </script>
</head>
<body>
	<div id = "categories">
	<!--<?php include('jointLoad.php');?> -->
	</div>
	<?php if(isset($_SESSION['login_user']) && $row['accessLevel'] > 1 && $blocked == 0 && $robotrow['automatic']==0 && $activeRobot['connected'] == 1){ ?>
	<div id = "joints">
	Manual mode<br> select which joint to increse or decrese
	<table>
	<?php for($i = 1; $i < $joints + 1; $i++){ ?>
		<tr> <td><button onmousedown="jointMove(<?php echo $i;?>,1)">j<?php echo $i;?> inc</button> </td>  <td><button onmousedown="jointMove(<?php echo $i;?>,0)">j<?php echo $i;?> dec</button> </td></tr>
	<?php } ?>
	</table> 
	<?php } ?>
	</div>
	<?php if(isset($_SESSION['login_user']) && $row['accessLevel'] > 1 && $blocked == 0 && $robotrow['automatic']==0 && $activeRobot['connected'] == 1){ ?>
	<div id = "joint_target">
		<?php include("joint_load_manu.php"); ?>
	</div>
	<?php } ?>
<?php if(isset($_SESSION['login_user']) && $row['accessLevel'] > 1 && $blocked == 0  && $activeRobot['connected'] == 1){ ?>
	
		
		<div id ="gripper">
		Commands for robot:
		<table class = "gripen">
		<tr> <td><center> <button onclick="reset()"> Reset </button></center> </td> <td> <center> <button onclick="enable()"> Enable Motors </button></center></td> </tr>
		<tr> <td> <center> <button onclick="openGripper()"> Open Gripper </button></center></td><td> <center> <button onclick="closeGripper()"> Close Gripper </button></center></td> </tr>
		</table>
		</div>
	<div id = "STOP">
	<button id= "stopButton" onclick="stop()"> STOP </button>
	</div>
	<?php } ?>
	
	
	<?php 
	if($activeRobot['connected'] == 1 && $activeRobot['userID']==$userID && $robotrow['automatic']==1){ ?>
	
	<div id = "Mode">
		Select which script to run<br>
		<select id = "scriptName">
	  <option value="pick1" >pick1</option>
	  <option value="pick2">pick2</option>
	  <option value="pick3">pick3</option>
	  <option value="pickAll">pickAll</option>
	</select>
	
		<table>
				<button onclick="runAuto()"> Run  AutoMode</button></center>
		</table>
	</div>
	
	
	
	<?php }
	if($activeRobot['connected'] == 1 && $activeRobot['userID']==$userID){ 
		$error = "Connected to the robot."; 
	
	?>
		
	<div id = "Mode1">
	<?php if($robotrow['automatic']==1){ ?>
		Automatic Mode
	
	<?php } else { ?>
		Manual Mode
	<?php } ?>
	<form action="switchMode.php" method="post">
		<input type="hidden" name="robotID" value="<?=$robotID;?>">
		<input type="submit" value="Change mode">
		</form>
	</div>
	<?php } 
	?>
	
	
	<div id = "logging">
	Console log:<br>
	<div id = "conError"> </div>
	<?php if($error == "Connected to the robot."){ ?>
		<span style='color: green;'><?php echo $error; ?> </span> <br>
	<?php } else{ ?>
		<span style='color: red;'><?php echo $error; ?> </span> <br>
	<?php } ?>
	
	<?php echo $robotError; ?> <br>
	
	
	
	</div>
		
	
	

	<div id="videoBooth">
		 <iframe src="https://player.twitch.tv/?channel=robotarmprojekt" frameborder="0" allowfullscreen="false" scrolling="no" height="600" width="750"></iframe><a href="https://www.twitch.tv/robotarmprojekt?tt_content=text_link&tt_medium=live_embed" style="padding:2px 0px 4px; display:block; width:345px; font-weight:normal; font-size:10px; text-decoration:underline;"></a>
	</div>
	<?php if(isset($_SESSION['login_user']) && $row['accessLevel'] > 1){?>
	
	
	
		<?php if($activeRobot['connected'] == 0 && $activeRobot['userID'] == 0){ ?>
		<div id = "connect">
			Connection:<center><form action="connect.php?robotID=<?php echo $robotID; ?>&userID=<?php echo $userID;?>" method="post"><input type="submit" value = "Connect" name="Connect"></form></center><?php
			
		}
		else if ($activeRobot['connected'] == 1 && $activeRobot['userID']==$userID){?>
		<div id = "connect">
		Connection:<center><form action="disconnect.php?robotID=<?php echo $robotID;?>" method="post"><input type="submit" value = "Disconnect" name="Disconnect"></form></center><?php
		}
	}
	?>
	
	</div>
<footer>Contact info: robotarmprojekt@gmail.com</footer>
</body>
</html>
