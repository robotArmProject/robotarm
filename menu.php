<html>
<link rel="stylesheet" type="text/css" href="styles.css">
<body style="color:#FFFFFF;">
<div class="menu" style="z-index:1; border-bottom:1px solid white">
<a href = "user.php">Control robot</a>
<a href = "settings.php"> Account settings </a>
	<?php 
	if(isset($_SESSION['login_user']) && $row['accessLevel'] > 2){ ?>
		<a href="adminPriv.php?sorted=all" target="_self">Admin management</a>
	<?php } ?>
	<a href = "simulation.php"> Simulation </a>
	<a href = "logout.php"> Sign out </a> 
	
</div>
</body>
</html>