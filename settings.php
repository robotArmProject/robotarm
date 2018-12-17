<html>
<head>
	<title> Settings </title>
	<meta charset = "UTF-8">
</head>

<?php
include('session.php'); 
include('menu.php');
include('logging.php');
$userID = $login_session;
$userINFO = mysqli_query($con,"SELECT * FROM Users WHERE idUsers = '$userID'");
$row = mysqli_fetch_array($userINFO,MYSQLI_ASSOC);
$error = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    //@ minskar warrnings
    $realname = @$_POST["realname"];
    $password = @$_POST["password"];
    $repeatPassword = @$_POST["repeatPassword"];
    $encpassword = md5($password);
    $query = mysqli_query($con,"SELECT * FROM Users WHERE idUsers = '$userID' ");
 
      if($password == $repeatPassword){
	$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
	if($password == false){
		$encpassword = $row['userPassword'];	
	}
	if($realname == false){
		$realname = $row['realName']; 	
	}
   
	$sql = "UPDATE Users SET realName='$realname',userPassword='$encpassword' WHERE idUsers = '$userID'";        
            mysqli_query($con, $sql);
			$action = "Update user information";
			writeLog($userID,$action);
            header("location: user.php");
			
           
      }
      else{
          $error="Password does not match";
      }
  
  
}

?>
<div class="container">
 
<form class="data" method="post" action="" >
<label> <font color="white"> Realname: </font></label> <input name = "realname" type="text"> <br>
<label> <font color="white"> Password: </font></label> <input name = "password" type="password"> <br>
<label> <font color="white"> Repeat password: </font></label> <input name = "repeatPassword" type="password"> <br>
 
<br>
<input  type="Submit" value = "Submit" >  <br>
 
</form>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div id="error" style="float:left"><?php echo $error; ?></div>
</html>
