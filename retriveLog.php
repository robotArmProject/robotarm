<?php
include('session.php');
include('logging.php');
$userID = $login_session;
$sql = "SELECT * FROM logging";
$logginInfo = mysqli_query($con,$sql);
$i = 0;
while($row = mysqli_fetch_array($logginInfo,MYSQLI_ASSOC)) {
			$id[$i] = $row['idlogging'];
			$userID[$i] = $row['userID'];
			$IP[$i] = $row['userIP'];
			$time[$i] = $row['timestamp'];
			$action[$i] = $row['action'];
			$i++;
		}
mysqli_free_result($res);?>
<html>
<div id="loggingInfo" style="overflow-y:scroll; overflow-x:hidden; height:400px; width:600px">
<?php for($n = 0; $n <$i; $n++):?>
			<a href="logInfo.php?id=<?=$id[$n];?>" target="_self"> <?php echo $n; ?>: <?php echo $action[$n]; ?>, Performed by user <?php echo $userID[$n]; ?></a><br>

<?php endfor; ?>
</div>
</html>