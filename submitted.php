<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Number of Submissions so far this week</title>
</head>
<body>

<?php

//variable for database connection
	require "connections.php";

//open DB connection
	$con = mysql_connect($host,$dbusername,$password);
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("$database", $con);

// count number of picks divide by 5 to get number of guys who have picked

$result = mysql_query("SELECT count(*) / 5 FROM `Picks` WHERE week = $week");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
$row= mysql_fetch_row($result);

// remember $row is an array so need to add [0] to show first value. 
// add (float) to remove the trailing zeros.

echo "Number of Picks submitted for Week $week is ".(float)$row[0];
echo "<br /> http://$externalip/HSC2014";

?> 

</body>
</html>
