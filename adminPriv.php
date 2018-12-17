<html>
<body>
<?php
include('session.php');
include('menu.php');

if (isset($_GET['sorted'])){
	$sorttype = $_GET['sorted'];
}
if(isset($_GET['error'])){
	$error = $_GET['error'];
	if($error == "NOT_A_NUMBER"){
		$error ="The ID provided is not a number";}
	else if($error == "WRONG_NUMBER"){
		$error = "The ID provided is invalid";}
	else {
		$error = "UNKNOWN Error, try again";
	}
}
if(isset($_GET['error2'])){
	$error2 = $_GET['error2'];
	if($error2 == "NOT_A_NUMBER"){
		$error2 ="The ID provided is not a number";}
	else if($error2 == "WRONG_NUMBER"){
		$error2 = "The ID provided is invalid";}
	else {
		$error2 = "UNKNOWN Error, try again";
	}
}
?>
<title> Admin Managment </title>
<div id= "categories">

<table class = 'cat'>
<tr>	
	<td>
		<a class="cat" href="adminPriv.php?sorted=all">Show all options</a>
	</td>
</tr>
<tr>
	<td>
		<a class="cat" href="adminPriv.php?sorted=robot">Robot options</a>
	</td>
</tr>
<tr>
	<td>
		<a class="cat" href="adminPriv.php?sorted=users">User options</a>
	</td>
</tr>


<tr>
	<td>
		<a class="cat" href="adminPriv.php?sorted=log">Retrive User log</a>
	</td>
</tr>
</table>
</div>
<div id = "robotswitch">
	<h2>Change robot options:</h2>
	Insert robotID you want to set to Active
	<form action="switchRobot.php" method="post">
		<input type = "text" name = "robotID">
		<input type="submit" value="change">
	</form>
	<?php echo $error; ?>
Insert robotID to purge connected user
	<form action="purge.php" method="post">
		<input type = "text" name = "robotID">
		<input type="submit" value="Purge">
	</form>
	<?php echo $error2; ?>
</div>
<?php if(isset($sorttype)): ?>
<div id="productinfo">
<table class = "prod">
<tr>
	<?php if($sorttype == 'users'): 
		$sql = "SELECT * FROM Users";
		$res = mysqli_query($con,$sql);
		$i =0;

		while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
			$userID[$i] = $row['userID'];
			$userName[$i] = $row['username'];
			$userreal[$i] = $row['realName'];
			$userAL[$i] = $row['accessLevel'];
			$userID[$i] = $row['idUsers'];
			$i++;
		}
		mysqli_free_result($res);?>
		<tr>
			<td class="userclass"> <h2> UserID </h2> </td>
			<td class="userclass"> <h2> Username </h2> </td>
			<td class="userclass"> <h2> Real name </h2> </td>
			<td class="userclass"> <h2> Access </h2> </td>
			<td class="userclass"> <h2> User </h2> </td>
			<td class="userclass"> <h2> &nbsp; </h2> </td>
		</tr>
		<?php for($n = 0; $n <$i; $n++):?>
		<tr><td class="userclass"><?=$userID[$n];?></td>
			<td class="userclass"><?=$userName[$n];?></td>
			<td class="userclass"><?=$userreal[$n];?></td>
			<td class="userclass"><center><?=$userAL[$n];?></center></td>
			<td ><center><form action="edituser.php?" method="post">
			<input type="submit" value="Edit">
			<input type="hidden" name="edituser" value="<?=$userID[$n];?>"></form></center></td>
			<td ><center><form action="removeuser.php" method="post">
			<input type="submit" value="Delete">
			<input type="hidden" name="removeUser" value="<?=$userID[$n];?>"></form></center></td>
		</tr>
		
		<?php
		endfor
		?>
		<td class="item"><form action="userReg.php" method="post">
			<input type="submit" value="Add new user">
			</form></td>

	<?php endif; ?>
	<?php if($sorttype == 'robot'):
	$sql = "SELECT * FROM robotconfig";
		$res = mysqli_query($con,$sql);
		$i =0;

		while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
			$robotID[$i] = $row['idrobotconfig'];
			$robotmodel[$i] = $row['robotmodel'];
			$connected[$i] = $row['connected'];
			$userID[$i] = $row['userID'];
			$joints[$i] = $row['joints'];
			$i++;
		}
	
		mysqli_free_result($res);
		$sql = "SELECT * FROM adminSettings";
		$res = mysqli_query($con,$sql);
		$i =0;

		while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
			$robotID[$i] = $row['robotID'];
			$automatic[$i] = $row['automatic'];
			if($automatic[$i] == 1){
				$automatic[$i] = "Automatic";
			}
			else{
				$automatic[$i] = "Manual";
			}
			
			$active[$i] = $row['active'];
			if($active[$i] == 0){
				$active[$i] = "No";
			}
			else{
				$active[$i] = "Yes";
			}
			$i++;
		}
		
		?>
	<tr> 
			<td class="userclass"> <h2> robotID </h2> </td>
			<td class="userclass"> <h2> robotmodel  </h2> </td>
			<td class="userclass"> <h2> Active  </h2> </td>
			<td class="userclass"> <h2> Mode  </h2> </td>
			<td class="userclass"> <h2> Info </h2> </td>
	</tr>	
	<?php for($n = 0; $n <$i; $n++):
			?>
		
		<tr>
			<td class="userclass"><?=$robotID[$n];?></td>
			<td class="userclass"><?=$robotmodel[$n];?></td>
			<td class="userclass"><center><?=$active[$n];?></center></td>
			<td class ="userclass"><?=$automatic[$n];?></td>	
				
			
			<td ><form action="robotinfo.php" method="post">
			<input type="submit" value="More info">
			<input type="hidden" name="robotinfo" value="<?=$userID[$n];?>"></form></td>
		</tr>
		
		<?php
		endfor ?>
		<td class="item"><form action="robotreg.php" method="post">
			<input type="submit" value="Add new Robot">
			</form></td>
			
		<?php endif; ?>
	
	<?php if($sorttype =='all'): 
		$sql = "SELECT * FROM Users";
		$res = mysqli_query($con,$sql);
		$i =0;

		while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
			$userID[$i] = $row['userID'];
			$userName[$i] = $row['username'];
			$userreal[$i] = $row['realName'];
			$userAL[$i] = $row['accessLevel'];
			$userID[$i] = $row['idUsers'];
			$i++;
		}
		mysqli_free_result($res);?>
		<tr> 
			<td class="userclass"> <h2> UserID </h2> </td>
			<td class="userclass"> <h2> Username </h2> </td>
			<td class="userclass"> <h2> Real name </h2> </td>
			<td class="userclass"> <h2> Access </h2> </td>
			<td class="userclass"> <h2> User </h2> </td>
			<td class="userclass"> <h2> &nbsp; </h2> </td>
		</tr>
		<?php for($n = 0; $n <$i; $n++):?>
		<tr>
			<td class="userclass"><?=$userID[$n];?></td>
			<td class="userclass"><?=$userName[$n];?></td>
			<td class="userclass"><?=$userreal[$n];?></td>
			<td class="userclass"><center><?=$userAL[$n];?></center></td>
			<td ><form action="edituser.php" method="post">
			<input type="submit" value="Edit">
			<input type="hidden" name="edituser" value="<?=$userID[$n];?>"></form></td>
			<td ><form action="removeuser.php" method="post">
			<input type="submit" value="Delete">
			<input type="hidden" name="removeUser" value="<?=$userID[$n];?>"></form></td>
		</tr>
		
		<?php
		endfor
		?>
		<td class="item"><form action="userReg.php" method="post">
			<input type="submit" value="Add new user">
			</form></td>
		
		<tr>  <td> <hr> </td>
			<td> <hr> </td>
			<td> <hr> </td>
			
			<td> <hr> </td>
			<td> <hr> </td> </tr>
		
		
	<?php 
	$sql = "SELECT * FROM robotconfig";
		$res = mysqli_query($con,$sql);
		$i =0;

		while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
			$robotID[$i] = $row['idrobotconfig'];
			$robotmodel[$i] = $row['robotmodel'];
			$connected[$i] = $row['connected'];
			$userID[$i] = $row['userID'];
			$joints[$i] = $row['joints'];
			$i++;
		}
	
		mysqli_free_result($res);
		$sql = "SELECT * FROM adminSettings";
		$res = mysqli_query($con,$sql);
		$i =0;

		while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
			$robotID[$i] = $row['robotID'];
			$automatic[$i] = $row['automatic'];
			if($automatic[$i] == 1){
				$automatic[$i] = "Automatic";
			}
			else{
				$automatic[$i] = "Manual";
			}
			$active[$i] = $row['active'];
			if($active[$i] == 0){
				$active[$i] = "No";
			}
			else{
				$active[$i] = "Yes";
			}
			$i++;
		}?>
	<tr> 
			<td class="userclass"> <h2> robotID </h2> </td>
			<td class="userclass"> <h2> robotmodel  </h2> </td>
			<td class="userclass"> <h2> Active  </h2> </td>
			<td class="userclass"> <h2> Mode  </h2> </td>
			<td class="userclass"> <h2> Info </h2> </td>
	</tr>	
	<?php for($n = 0; $n <$i; $n++):
			?>
		
		<tr>
			<td class="userclass"><?=$robotID[$n];?></td>
			<td class="userclass"><?=$robotmodel[$n];?></td>
			<td class="userclass"><center><?=$active[$n];?></center></td>
			<td class ="userclass"><?=$automatic[$n];?></td>	
				
			
			<td ><form action="robotinfo.php" method="post">
			<input type="submit" value="More info">
			<input type="hidden" name="robotinfo" value="<?=$robotID[$n];?>"></form></td>
		</tr>
		
		<?php
		endfor ?>
		<td class="item"><form action="robotreg.php" method="post">
					<input type="submit" value="Add new Robot">
					</form></td>
		
		
	<?php endif;
	if($sorttype =='log'):
	include("retriveLog.php");
	?><hr>
	Click on entry to access more information
	<?php
	endif;
	?>
	
	
	
	

	<?php endif;?>
</tr>		
</table>

</body>
</html>