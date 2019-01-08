<?php
	include('session.php');
	if (isset($_GET['userID'])){
		
	 
		$userID = $_GET['userID'];
		//@ minskar warrnings
		$username = @$_POST["username"];
		$realname = @$_POST["realname"];
		$accessLevel = @$_POST["accessLevel"];
		$password = @$_POST["password"];
		$repeatPassword = @$_POST["repeatPassword"];
		$encpassword = md5($password);
		$query = mysqli_query($con,"SELECT * FROM Users WHERE idUsers = '$userID'");
		$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
		$passok = '0';
		if($password == false){
			$encpassword = $row['userPassword'];
			$passok = 1;  
		}
		else {
			if($password == $repeatPassword){
				$passok = '1';
			}
			else{
				$passok = '0';
			}
		}

		if($realname == false){
			$realname = $row['realName'];  
		}
		if($accessLevel == false){
			$accessLevel = $row['accessLevel'];
		}
		if($username == false){
			$username = $row['username'];
		} 

		if($passok == '1'){
		 
			$sql = "UPDATE Users SET username = '$username',accessLevel = '$accessLevel',realName='$realname',userPassword='$encpassword' WHERE idUsers = '$userID'";        
			mysqli_query($con, $sql);
			header("Location: adminPriv.php?sorted=all");
		}
		else {
			header("location:edituser.php?error=password_not_match&userID=$userID");	
		}
}
else{
	header("location:edituser.php?error=no_userID");
}
?>