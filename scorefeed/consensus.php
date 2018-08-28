<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Consensus Picks</title>
<link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/css/bootstrap.min.css">
<link href="http://getbootstrap.com/2.3.2/assets/css/bootstrap-responsive.css" rel="stylesheet">
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>



<?php
//variable for database connection

require "../connections.php";


//$week = $week - 1 ; // uncomment this line until Saturday afternoon.
$dow = date('w',strtotime("now"));
$theTime = date ('G', strtotime("now"));

//TODO: make this into 1 query and move to external file (or function?)

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
$total = 0;


echo "<h2> Consensus Picks for Week $week</h2>";
echo "<div class='table-responsive table-condensed'>";
	echo "<table width = '200' id ='consensuspicks' class='table-striped'>";
	echo "<thead style='font-weight:bold';>";
	echo "<tr><td>"."Team"."</td><td>"."Picked"."</td><td>"."Points"."</td><td>";
	echo "</thead>";
	echo "<tbody>";
// display the current totals in a table:
$query = "SELECT pick, count(pick) AS 'Total', winner FROM picksview WHERE week = $week GROUP BY pick ORDER BY count(pick) DESC LIMIT 5";
$result = mysql_query($query);

while( ($row = mysql_fetch_array($result)))
{
	echo "<tr><td>";
	echo $row['pick'];
	echo '</td><td align="right">';
	echo $row['Total'];
	echo '</td><td align="right">';
	echo $row['winner'];
  	 $total += $row['winner'];
	echo "</td></tr>";
}

echo '<tr><td><b>Total</b></td><td></td><td align="right" ><b>'.number_format($total, 1, '.', ',').'</b></td></tr></b>';
echo '</tbody></table></div>';

$total = 0;
$lastweek = $week -1;
echo "<h2> Consensus Picks for Week $lastweek</h2>";
echo "<div class='table-responsive table-condensed'>";
	echo "<table width = '200' id ='consensuspicks' class='table-striped'>";
	echo "<thead style='font-weight:bold';>";
	echo "<tr><td>"."Team"."</td><td>"."Picked"."</td><td>"."Points"."</td><td>";
	echo "</thead>";
	echo "<tbody>";


// display the current totals in a table:
$query = "SELECT pick, count(pick) AS 'Total', winner FROM picksview WHERE week = ($week -1) GROUP BY pick ORDER BY count(pick) DESC LIMIT 5";
$result = mysql_query($query);

while( ($row = mysql_fetch_array($result)))
{
	echo "<tr><td>";
	echo $row['pick'];
	echo '</td><td align="right">';
	echo $row['Total'];
	echo '</td><td align="right">';
	echo $row['winner'];
  	 $total += $row['winner'];
	echo "</td></tr>";
}
echo '<tr><td><b>Total</b></td><td></td><td align="right"><b>'.number_format($total, 1, '.', ',').'</b></td></tr></b>';
echo '</tbody></table></div>';



echo "<h2> Seasons Consensus Record </h2>";
echo "<div class='table-responsive table-condensed'>";
	echo "<table width = '200' id ='consensusrecord' class='table-striped'>";
	echo "<thead style='font-weight:bold';>";
	echo "<tr><td>"."Week"."</td><td>"."Picked"."</td><td>"."Points"."</td><td>";
	echo "</thead>";
	echo "<tbody>";
	
	
// display the current totals in a table:
$query = "SELECT week, pick, count(pick) AS 'Total', winner FROM picksview WHERE week <= $week GROUP BY week, pick ORDER BY week, count(pick) DESC";
$result = mysql_query($query);
$total = 0;
$grandtotal = 0;
$lastweek = 0;
$i=0;
while ($row = mysql_fetch_array($result))
{
	if ($lastweek == $row['week'])
		{
			$i++;
		}
		else {$lastweek = $row['week'];
		
			$i=0;
		}	
	if ($i < 5)
		{	
	echo "<tr><td>";
	echo $row['week'];
	echo '</td><td align="right">';
	echo $row['pick'];
	echo '</td><td align="right">';
	echo $row['winner'];
	  $total += $row['winner'];
	  $grandtotal += $row['winner'];
	echo "</td></tr>";
	$lastweek = $row['week'];
		} elseif ($i == 5) {
	echo '<tr><td><b>Total</b></td><td></td><td align="right"><b>'.number_format($total, 1, '.', ',').'</b></td></tr>';	
	$total = 0;
		}

}
	echo '<tr><td><b>Grand Total</b></td><td></td><td align="right"><b>'.number_format($grandtotal, 1, '.', ',').'</b></td></tr>';
echo '</tbody></table></div>';
echo $dow.' | '.$theTime.' | '.$week.' | '.$thedate;
// close DB connection
mysql_close($con);

?>
