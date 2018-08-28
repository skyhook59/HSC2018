<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Current Standings</title>
<link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/css/bootstrap.min.css">
<link href="http://getbootstrap.com/2.3.2/assets/css/bootstrap-responsive.css" rel="stylesheet">
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>



<?php
//variable for database connection

require "../connections.php";

//open DB connection
$con = mysql_connect($host,$dbusername,$password);
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
mysql_select_db("$database", $con);


echo '<h2> Overall Standings</h2>';
echo "<div class='table-responsive table-condensed'>";
	echo "<table width = '400' id ='standing' class='table-striped'>";
	echo "<thead style='font-weight:bold';>";
	echo "<tr><td>Rank</td><td>User</td><td>Points</td><td>";
	echo "</thead>";
	echo "<tbody>";
// display the current totals in a table:
$query = "SELECT username, sum(winner) AS 'Total' FROM picksview GROUP BY username ORDER BY sum(winner) desc";
$result = mysql_query($query);


// Weekly Scores

// Logic to determine which week's totals to show.
$dow = date('w',strtotime("now"));
$theTime = date ('G', strtotime("now"));

if (($dow > 2) && ($dow < 6)){
$week = $week -1;
}

if (($dow == 6) && ($theTime < 14)){
$week = $week -1;
}

$rank = 0;
$last_score = false;
$rows = 0;

while( ($row = mysql_fetch_array($result)))
{
	$rows++;
	if( $last_score != $row['Total']){
	  $last_score = $row['Total'];
	  $rank = $rows;
	  }
	echo "<tr><td>";
	echo $rank;
	echo "</td><td>";
	echo $row['username'];
	echo "</td><td>";
	echo $row['Total'];
	echo "</td></tr>";
}
echo '</tbody></table></div>';
echo '<br /><br />';
echo "<h2> Week# $week Scores</h2>";
echo "<div class='table-responsive table-condensed'>";
	echo "<table width = '400' id ='standing' class='table-striped'>";
	echo "<thead style='font-weight:bold';>";
	echo "<tr><td>"."User"."</td><td>"."Points"."</td><td>";
	echo "</thead>";
	echo "<tbody>";
// display the current totals in a table:
$query = "SELECT username, sum(winner) AS 'Total' FROM picksview WHERE week = $week\n"
. "group by username\n"
. "order by sum(winner) desc LIMIT 0, 35 ";
$result = mysql_query($query);

while( ($row = mysql_fetch_array($result)))
{
	echo "<tr><td>";
	echo $row['username'];
	echo "</td><td>";
	echo $row['Total'];
	echo "</td></tr>";
}
echo '</tbody></table></div>';


// close DB connection
mysql_close($con);

?>
