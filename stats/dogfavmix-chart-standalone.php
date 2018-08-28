
<head>
  <title>Stats for <?php $username = $_GET['username']; echo $username; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="../fusioncharts/js/fusioncharts.js"></script>

</head>

<?php

// Include the `fusioncharts.php` file that contains functions	to embed the charts.

  include("../fusioncharts/fusioncharts.php");
   
// all DB connection stuff
   include("../connections.php");

// The following 4 code lines contain the database connection information. Alternatively, you can move these code lines to a separate file and include the file here. You can also modify this code based on your database connection. */

   $hostdb = "$host";  // MySQl host
   $userdb = "$dbusername";  // MySQL username
   $passdb = "$password";  // MySQL password
   $namedb = "$database";  // MySQL database name
	$username = $_GET['username'];
   // Establish a connection to the database
   $dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

   // Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect
   if ($dbhandle->connect_error) {
  	exit("There was an error with your connection: ".$dbhandle->connect_error);
   }

     	// Form the SQL query
     	$strQuery = "SELECT    sum(if(p.pick = l.favTeam,1,0)) AS Num_of_Fav_Pick, sum(if(p.pick = l.dogTeam,1,0)) AS Num_of_Dog_Pick				
		FROM `Picks` p LEFT JOIN `Lines` l ON p.gameID = l.gameID WHERE p.username = '$username' ";

     	// Execute the query, or else return the error message.
     	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");
		
		// create an array of the results
		
		$row = mysqli_fetch_array($result);


	/*Create an object for the chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

	$json = 
		'{ "chart": 
			{
        	"startingangle": "120",
        	"showlabels": "0",
        	"showlegend": "0",
        	"showborder": "0",
        	"enablemultislicing": "0",
        	"slicingdistance": "5",
        	"showpercentvalues": "1",
        	"showpercentintooltip": "0",
        	"canvasBgAlpha": "0"
    		},
	       "data": [
	        {
           	 "label": "Fav Picks",
             "value": "'.$row[0].'"
        	},
        	{
             "label": "Dog Picks",
             "value": "'.$row[1].'"
        	}
    		]
		}';

        $pieChart = new FusionCharts("pie2D", "DogsFavs" , '100%', '100%', "chart-2", "json", $json);

        	// Render the chart
        	$pieChart->render();

        	// Close the database connection
        	$dbhandle->close();
     	

  	?>
<div id="chart-2"><!-- Fusion Charts will render here--></div>


   </body>

</html>
