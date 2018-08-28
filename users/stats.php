<?PHP
/*require_once("../login/include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("../login/login.php");
    exit;
}
*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Weekly Picks</title>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/css/bootstrap.min.css">
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!--<script type="text/javascript" src="../bootstrap.min.js"></script> -->

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style type="text/css">
.hiddenRow {
    padding: 0 !important;
			}
</style>
</head>
<body>



<?php
//variable for database connection

require "../connections.php";

$username = $_GET['user'];


//check the date and time so you don't show that week's picks too soon

$dow = date('w',strtotime("now"));
$theTime = date ('G', strtotime("now"));

if (($dow > 2) && ($dow < 6)){
$week = $week -1;
echo "<i><h3>Last Week's Picks Displayed Until Saturday at 2pm</h3></i>";
}

if (($dow == 6) && ($theTime < 14)){
$week = $week -1;
echo "<i><h3>Last Week's Picks Displayed Until Saturday at 2pm</h3></i>";
}


//open DB connection
$con = mysql_connect($host,$dbusername,$password);
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
mysql_select_db("$database", $con);

//summary of picks for week 
$query = "SELECT p.`username`, p.`pick`, l.`favScore`,l.`dogscore`, l.`gameStatus`, p.`winner`, l.`favTeam`, l.`line`, l.`dogTeam` FROM `picksview` p JOIN `linesview` l ON p.gameID = l.gameID WHERE p.week=$week AND p.`username`='$username'";
$result = mysql_query($query);
echo "<h2>$username's Week $week Picks </h2>";
echo "<div class='table-responsive table-condensed'>";
	echo "<table width = '575' id ='standing' class='table-striped'>";
	echo "<thead style='font-weight:bold'>";
	echo "<tr><td>"."Pick"."</td><td>"."Game Line"."</td><td>"."Score/Status"."</td><td class='numeric'>"."Winner"."</td></tr>";	echo "</thead>";
	echo "<tbody>";
//	echo "<div class='panel-group' id='accordion'><div class='panel panel-default'>";

$i=-1;
while ($row = mysql_fetch_array($result))
{
	echo "<tr><td>";
	//echo $row['username'];
	//echo "</td><td>";
	echo $row['pick'];
	echo "</td><td>";
	echo "[";
	echo $row['favTeam'];
	echo " ";
	echo $row['line'];
	echo " ";
	echo $row['dogTeam'];
	echo "]";
	echo "</td><td>";
	echo $row['favScore'];
	echo " - ";
	echo $row['dogScore'];
	echo " ";
	echo $row['gameStatus'];
	echo "</td><td>";
	echo $row['winner'];
	echo "</tr></div>";
		
    $lastuser = $row['username'];		
}
echo '</div></div></tbody></table></div>';


// close DB connection
mysql_close($con);

?>

<?php 
echo "<!--";
echo $thedate."<br />";
echo date('w', strtotime($thedate))."<br />"; 
echo $theTime;
echo "-->";
?>
</body>
</html>