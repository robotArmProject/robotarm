<html>
<head>
    <title> Register </title>
    <meta charset="UTF-8">
</head>
 
<?php
//  connecta to db
$error="";
 
include ('session.php');
include ('menu.php');
include('logging.php');
$adminID = $login_session;
 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    //@ minskar warrnings
    $username = @$_POST["username"];
    $realname = @$_POST["realname"];
    $accessLevel = @$_POST["accessLevel"];
    $password = @$_POST["password"];
    $repeatPassword = @$_POST["repeatPassword"];
    $encpassword = md5($password);
    $query = mysqli_query($con,"SELECT username FROM Users WHERE username = '$username' ");
 
 
    if (mysqli_num_rows($query) != 0)
    {
        echo "Username already exists";
    return;
    }
 
    else
    {   if($username == false || $realname==false || $accessLevel == false || $password==false || $repeatPassword==false ){
        $error =" Please fill out everthing";
       
    }
    else{
      if($password == $repeatPassword){
        $sql = "INSERT INTO Users (username,userPassword,accessLevel,realName) VALUES ('$username','$encpassword','$accessLevel','$realname')";        
        mysqli_query($con,"SELECT * FROM Users");
            mysqli_query($con, $sql);
            $error = "";
			$action = " User with ID=  $adminID created a new user";
			writeLog($adminID,$action);
           
      }
      else{
          $error="Password does not match";
      }
  }
  }
}
?>
 
 <h1> <font> Register here! </font></h1>
 
<div class="container">
 
<form class="data" method="post" action="" >
<label> <font color="white"> Username:</font> </label> <input name="username" type="text"> <br>
<label> <font color="white"> Realname: </font></label> <input name = "realname" type="text"> <br>
<label> <font color="white"> Access level: </font></label> <input name = "accessLevel" type="text"> <br>
<label> <font color="white"> Password: </font></label> <input name = "password" type="password"> <br>
<label> <font color="white"> Repeat password: </font></label> <input name = "repeatPassword" type="password"> <br>
 
<br>
<input  type="Submit" value = "Submit" >  <br>
 
</form>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div id="error" style="float:left"><?php echo $error; ?></div>
 
 
 
 
</body>
 
</html>