<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Stats for <?php $username = $_GET['username']; echo $username; ?>  </title>
<link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/css/bootstrap.min.css">
<link href="http://getbootstrap.com/2.3.2/assets/css/bootstrap-responsive.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="../fusioncharts/js/fusioncharts.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>



<?php
/*
//variable for database connection

require "../connections.php";
//$week = 4;

//open DB connection
$con = mysql_connect($host,$dbusername,$password);
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
mysql_select_db("$database", $con);

$username = $_GET['username'];

echo "<h2> $username's Stats</h2>";

// display the teams you pick the most often

echo "<h3> Most Frequently Picked Teams</h3>";
echo "<div class='table-responsive table-condensed'>";
	echo "<table width = '200' id ='consensuspicks' class='table-striped'>";
	echo "<thead style='font-weight:bold';>";
	echo "<tr><td>"."Team"."</td><td>"."Times Picked"."</td><td>";
	echo "</thead>";
	echo "<tbody>";


$query = "SELECT pick, count(pick) AS 'Total' FROM picksview WHERE  username = '$username' GROUP BY pick ORDER BY count(pick) DESC LIMIT 5";
$result = mysql_query($query);

while( ($row = mysql_fetch_array($result)))
{
	echo "<tr><td>";
	echo $row['pick'];
	echo "</td><td>";
	echo $row['Total'];
	echo "</td></tr>";
}
echo '</tbody></table></div>';

// display % of time you pick favorites vs. dogs

echo "<h3> How Frequently You Picked Fav vs. Dogs</h3>";
echo "<div class='table-responsive table-condensed'>";
	echo "<table width = '200' id ='consensuspicks' class='table-striped'>";
	echo "<thead style='font-weight:bold';>";
	echo "<tr><td>"."Team"."</td><td>"."Times Picked"."</td><td>";
	echo "</thead>";
	echo "<tbody>";


$query = "SELECT pick, count(pick) AS 'Total' FROM picksview WHERE  username = '$username' GROUP BY pick ORDER BY count(pick) DESC LIMIT 5";
$result = mysql_query($query);

while( ($row = mysql_fetch_array($result)))
{
	echo "<tr><td>";
	echo $row['pick'];
	echo "</td><td>";
	echo $row['Total'];
	echo "</td></tr>";
}
echo '</tbody></table></div>';



// close DB connection
mysql_close($con);

*/
// This is a simple example on how to draw a chart using FusionCharts and PHP.
// We have included includes/fusioncharts.php, which contains functions
// to help us easily embed the charts.
include("../fusioncharts/fusioncharts.php");

// Create the chart - Column 2D Chart with data given in constructor parameter 
// Syntax for the constructor - new FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "type of data", "actual data")
$columnChart = new FusionCharts("column2d", "ex1", "100%", 400, "chart-1", "json", '{  
                "chart":{  
                  "caption":"Harry\'s SuperMart",
                  "subCaption":"Top 5 stores in last month by revenue",
                  "numberPrefix":"$",
                  "theme":"ocean"
                },
                "data":[  
                  {  
                     "label":"Bakersfield Central",
                     "value":"880000"
                  },
                  {  
                     "label":"Garden Groove harbour",
                     "value":"730000"
                  },
                  {  
                     "label":"Los Angeles Topanga",
                     "value":"590000"
                  },
                  {  
                     "label":"Compton-Rancho Dom",
                     "value":"520000"
                  },
                  {  
                     "label":"Daly City Serramonte",
                     "value":"330000"
                  }
                ]
            }');
// Render the chart
//$columnChart->render();

print_r($columnChart);

/*
		SELECT  p.username
		, count (p.pick) AS Total_Picks
		, sum(if(p.pick = l.favTeam,1,0)) AS Num_of_Fav_Pick
		, sum(if(p.pick = l.dogTeam,1,0)) AS Num_of_Dog_Pick
		, sum(if(p.pick = l.homeTeam,1,0)) AS Num_of_Home_Pick
		, sum(if(p.pick = l.favTeam, if(p.pick = l.homeTeam,1,0),0)) AS Num_of_Fav_Home_Pick
		
		FROM `Picks` p LEFT JOIN `Lines` l ON p.gameID = l.gameID WHERE username = "MCPHEE" and p.week =9
		
		
		
		SELECT  p.username
		, count(p.pick) AS Total_Picks
		, sum(if(p.pick = l.favTeam,1,0)) AS Num_of_Fav_Pick
		, sum(if(p.pick = l.dogTeam,1,0)) AS Num_of_Dog_Pick
		, sum(if(p.pick = l.homeTeam,1,0)) AS Num_of_Home_Pick
		, sum(if(p.pick = l.favTeam, if(p.pick = l.homeTeam,1,0),0)) AS Num_of_Fav_Home_Pick
		, sum(if(p.pick = l.dogTeam, if(p.pick = l.homeTeam,1,0),0)) AS Num_of_Dog_Home_Pick
		
		FROM `Picks` p LEFT JOIN `Lines` l ON p.gameID = l.gameID WHERE username = "MCPHEE"
        GROUP BY p.week
        
        // how to display?
        // can i used picksview and included only winners vs. picks?
 
 */       
?>