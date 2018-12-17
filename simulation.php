<html lang = "en-US">

<html>
<head>
	<meta charset="UTF-8">
	<title> Simulation </title>
</head>
<body>
<center>
<?php
include('session.php');
include('menu.php');
include('logging.php');
$userID = $login_session;
$action = "User with ID = $userID , check out the simulation data";
writeLog($userID,$action);
$videos = glob("uploads/*.mp4");
$files = glob("uploads/*.png");
for ($i=0; $i<count($files); $i++) {
    $image = $files[$i];
	echo '<img src="'.$image .'" alt="Broken Image" />'."<br /><br />";
	
}?>

<?php 
for ($i=0; $i<count($videos); $i++) {
    $video = $videos[$i];
	echo "<video width='320' height='240' controls>";
	echo '<source src="'.$video .'" type="video/mp4" />'."<br />";
	echo "</video>";
	
}
?>
<br>



</center>
</div>
</body>
</html>