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
<link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/css/bootstrap.min.css">
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/js/bootstrap.min.js"></script>
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
//$week = $week - 1 ;

//open DB connection
$con = mysql_connect($host,$dbusername,$password);
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
mysql_select_db("$database", $con);

$user = $_GET['user'];


//summary of picks for week 
$query = "SELECT p.username, p.pick, l.favScore,l.dogscore, l.gameStatus, p.winner, l.favTeam, l.`line`, l.dogTeam FROM `picksview` p JOIN `linesview` l ON p.gameID = l.gameID WHERE p.week=$week AND p.username='$user' ORDER BY p.username";
$result = mysql_query($query);
echo '<h2> Week '.$week.' Picks </h2>';
echo "<div class='table-responsive table-condensed'>";
	echo "<table width = '575' id ='standing' class='table-striped'>";
	echo "<thead style='font-weight:bold'>";
	echo "<tr><td>"."User"."</td><td>"."Pick"."</td><td>"."Game Line"."</td><td>"."Score/Status"."</td><td class='numeric'>"."Winner"."</td></tr>";	echo "</thead>";
	echo "<tbody>";
//	echo "<div class='panel-group' id='accordion'><div class='panel panel-default'>";




$i=0;
while ($row = mysql_fetch_array($result))
{
	if ($lastuser == $row['username'])
		{
			$i++;
		}
	else
		{
		$lastuser = $row['username'];
			$i=0;
		}	
	if ($i == 0)
		{	
		echo "<tr data-toggle='collapse' data-target='#".$row['username']."' class='accordion-toggle'><td colspan=5>";
		echo "<div class='panel-heading'><h4 class='panel-title'>".$row['username']."</h4></div></a>";
		echo "</td></tr>";
		}
	echo "<tr class='hiddenRow'><td><div class='accordion-body collapse' id='".$row['username']."'>";
	echo $row['username'];
	echo "</td><td>";
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
	echo "</td><td class =''>";
	echo $row['winner'];
	echo "</tr></div>";
		
    $lastuser = $row['username'];		
}
echo '</div></div></tbody></table></div>';


// close DB connection
mysql_close($con);

?>
</body>
</html>