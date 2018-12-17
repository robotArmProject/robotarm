<?php
Ob_start();
session_start();
$con = mysqli_connect("URL","USERNAME","PASSWORD","DB");

if(mysqli_connect_errno())
	{
	echo "failed to connect to MYSQL: " . mysqli_connnect_error();
	}
	


if(isset($_SESSION['login_user'])){
	$user_check = $_SESSION['login_user'];
	
	$ses_sql = mysqli_query($con,"SELECT * FROM Users WHERE username = '$user_check' ");
   
	$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
	$login_session = $row['idUsers'];
	
}
else{
header("Location:index.php");}
?>