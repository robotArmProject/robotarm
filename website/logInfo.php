<?php
include('session.php');
include('menu.php');
include('logging.php');
$userID = $login_session;
$logId = $_GET['id'];
$sql = "SELECT * FROM logging WHERE idlogging =$logId";
$logginInfo = mysqli_query($con,$sql);
$res = mysqli_fetch_array($logginInfo,MYSQLI_ASSOC);

?>
<div id="logcontent">
 <table id = "logtable">
	<tr>
			<td> <center><h2> Log ID  </h2></center> </td>
			<td> <center><h2> user ID   </h2> </center></td>
			<td> <center><h2> UserIP    </h2> </center></td>
			<td> <center><h2> Timestamp   </h2> </center></td>
			<td> <center><h2> Action  </h2> </center></td>


	</tr>
	<tr> 
			<td>  <center><?=$res['idlogging'];?></center> </td>
			<td>  <center><?=$res['userID'];?></center></td>
			<td>  <center><?=$res['userIP'];?></center></td>
			<td>  <center><?=$res['timestamp'];?></center></td>
			<td>  <center><?=$res['action'];?></center></td>
			<td>  <center><form action="adminPriv.php?sorted=log" method="post">
			<input type="submit" value="Go back"></center>
			</form></td>
	</tr>
	
</table>