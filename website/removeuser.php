<html>
<head>
    <title> remove user </title>
    <meta charset = "UTF-8">
</head>
 
<?php
include ('session.php');
include('menu.php');
include('logging.php');
$adminID = $login_session;

$userID = $_POST['removeUser'];
$sql = "DELETE FROM Users WHERE idUsers = $userID";
mysqli_query($con,$sql);
$action = "User with ID = $adminID, Deleted user with ID = $userID";
writeLog($adminID,$action);
header("Location: adminPriv.php?sorted=all");
?>

</html>