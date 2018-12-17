<html>
<head>
    <title> Edit user </title>
    <meta charset = "UTF-8">
</head>
 
<?php
include ('session.php');
include('menu.php');
include('logging.php');
$adminID = $login_session;
$error = "";
$noID = '0';
if(isset($_GET['error'])){
	$error = $_GET['error'];
	if($error = "no_userID"){
		$noID = '1';		
		goto slut;	
	}	
	else {
		$userID = $_GET['userID'];
		
	}	
}
else{ 
	$userID = $_POST['edituser'];
	$noID = '0';
}
$userINFO = mysqli_query($con,"SELECT * FROM Users WHERE idUsers = '$userID'");
$row = mysqli_fetch_array($userINFO,MYSQLI_ASSOC);
$action = "User with id = $adminID edit user information about user = $userID"; 
writeLog($adminID,$action);
slut: ?>

 <?php if($noID=='1'){ echo "NO userID was provided please return to admin management and try again";}
				else{	
		 			?> <h1> Edit information for <?php echo $row['username'];} ?> </h1>
<div class="container">
 
<form class="data" method="post" action="updateUser.php?userID=<?php echo $userID ?>" >
<label> <font color="white"> Username:</font> </label> <input name="username" type="text"> <br>
<label> <font color="white"> Realname: </font></label> <input name = "realname" type="text"> <br>
<label> <font color="white"> Access level: </font></label> <input name = "accessLevel" type="text"> <br>
<label> <font color="white"> Password: </font></label> <input name = "password" type="password"> <br>
<label> <font color="white"> Repeat password: </font></label> <input name = "repeatPassword" type="password"> <br>
 
<br>
<input  type="Submit" name = "done" value = "Submit" >  <br>
<input type = "hidden" name="userID" value = "<?php $userID; ?>"> 
</form>
</div>
 
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div id="error" style="float:left"><?php echo $error; ?></div>
</html>
