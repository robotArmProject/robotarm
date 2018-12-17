

<?php
$con=mysqli_connect("utbweb.its.ltu.se","nadhan-4","bobosugerhart","nadhan4db");

if(mysqli_connect_errno())
	{
	echo "failed to connect to MYSQL: " . mysqli_connnect_error();
	} 
session_start();
$error="";
   
if(!empty($_POST['submit'])) {
      
	$username = @$_POST["username"];
	$password = @$_POST["password"];
	$encpassword = md5($password);
	      
      	$query = mysqli_query($con,"SELECT username FROM Users WHERE username='$username'");
     
if (mysqli_num_rows($query) != 0){
	
	$sql = mysqli_query($con,"SELECT userPassword FROM Users WHERE userPassword='$encpassword'");
	if(mysqli_num_rows($sql) != 0){

         	$_SESSION['login_user'] = $username;
         	header("location: middlepage.php");
	}
		
     
   	else {
         $error = "Your Login Name or Password is invalid";
      }
   }
   else{
	   $error = "Your Login Name or Password is invalid";
   }
}
?>
<html>
<style>
body{
background-image: url("http://utbweb.its.ltu.se/~nadhan-4/Images/process.PNG");
background-repeat: no-repeat;
background-size: cover;
}
</style>
<head>
	<meta charset="UTF-8">
	<title> Login page</title>
	

</head>
<body">


   <br>
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 2px #333333; margin-top:15%; " align = "Left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:5px;"><b>Sign in</b></div>
				
            <div>
               
               <form style="text-align:Center; padding: 20px; background-color:#CCCCCC;" action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                <br>  
		<input type = "submit" value = " Submit " name="submit"/><br />
               </form>
               
              
					
            </div>
				
         </div>
			
      </div>
 <center> <div id="error"><?php echo $error; ?></div> </center>
	
   </body>
</html>