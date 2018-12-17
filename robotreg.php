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
    $modelname = @$_POST["modelname"];
    $joints = @$_POST["joints"];
	$query = mysqli_query($con,"SELECT robotmodel FROM robotconfig WHERE robotmodel = '$modelname' ");
 
 
    if (mysqli_num_rows($query) != 0)
    {
        $error= "Modelname already exists";
    }
	else{
		if($modelname != false && $joints != false){
			$sql = "INSERT INTO robotconfig (robotmodel,connected,userID,joints) VALUES ('$modelname',0,0,$joints)"; 
			mysqli_query($con,$sql);
			$sql = "SELECT * FROM robotconfig WHERE robotmodel = '$modelname'";
			$res = mysqli_query($con,$sql);
			$row = mysqli_fetch_array($res,MYSQLI_ASSOC);
			$robotID = $row['idrobotconfig'];
			$sql2 = "INSERT INTO adminSettings (robotID,automatic, active) VALUES($robotID,0,0)";
			mysqli_query($con,$sql2);
			$error = "Robot succesfully added";
			$action = "User with id = $adminID created a new model calld: $modelname";
			writeLog($adminID, $action); 
		}
	}
	
}
?>
<h1> <font> Register a new Robot here! </font></h1>
 
<div class="container">
 
<form class="data" method="post" action="" >
<label> <font color="white"> Modelname:</font> </label> <input name="modelname" type="text"> <br>
<label> <font color="white"> Nr of joints: </font></label> <input name = "joints" type="text"> <br>

<br>
<input  type="Submit" value = "Submit" >  <br>
 
</form>
</div>
<br><br><br><br><br><br><br><br><br><br>
<div id="error" style="float:left"><?php echo $error; ?></div>
 
 
 
 
</body>
</html>