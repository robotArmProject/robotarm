<%
response.expires=-1

response.write("<?php date_default_timezone_set("Europe/Stockholm");
	echo "Last updated: " . date("H:i:s"); ?>")
%>