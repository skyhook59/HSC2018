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
     	$strQuery = "SELECT pick AS TEAM
					   , count(pick) AS PICKS
					   , sum(if(winner>0.6,1,0)) AS WINS
					   , sum(if(winner=0.5,1,0)) AS TIES
					   , sum(if(winner=0.0,1,0)) AS LOSSES
					   FROM `picksview` WHERE username = '$username'
				   GROUP BY pick
				   ORDER BY Picks DESC";

     	// Execute the query, or else return the error message.
     	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

     	// If the query returns a valid response, prepare the JSON string
    	if($result) {
        	// The `$json` array holds the chart attributes and data
        	$json ='{
			   "chart": {
			   	 
				 "bgcolor": "E9E9E9",
				 "outcnvbasefontcolor": "666666",
				 "caption": "Teams Picked The Most Often",
				 "xaxisname": "Team",
				 "yaxisname": "Times Picked",
				 "showvalues": "0",
				 "numvdivlines": "10",
				 "showalternatevgridcolor": "0",
				 "alternatevgridcolor": "e1f5ff",
				 "divlinecolor": "e1f5ff",
				 "vdivlinecolor": "e1f5ff",
				 "basefontcolor": "666666",
				 "tooltipbgcolor": "F3F3F3",
				 "tooltipbordercolor": "666666",
				 "canvasbordercolor": "666666",
				 "canvasborderthickness": "1",
				 "showplotborder": "1",
				 "showSum": "1",
				 "plotfillalpha": "80",
				 "showborder": "0"
			   },
			"categories": [
			  {
			   "category": [
				';
	    
	    while($row = mysqli_fetch_assoc($result)){
	    	$json .='{"label": "'.$row[TEAM].'"},';}
   		$json= rtrim($json, ',');
		   	$json .='				
					]}],
			"dataset": [
				{
				 "seriesname": "WINS",
                 "color": "B1D1DC",
                 "plotbordercolor": "B1D1DC",
				 "data": [
				';
	    $result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");
	    while($row = mysqli_fetch_assoc($result)){
	    	$json .='{"value": "'.$row[WINS].'"},';}
   		$json= rtrim($json, ',');
   		
   		$json .='
			]
	   },
	   {
				"seriesname": "TIES",
			    "color": "C8A1D1",
				"plotbordercolor": "C8A1D1",
				"data": [
			   ';
		$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");
		while($row = mysqli_fetch_assoc($result)){
			$json .='{"value": "'.$row[TIES].'"},';}
		$json= rtrim($json, ',');
 
		$json .='
			]
	    },
	   {
				"seriesname": "LOSSES",
			    "color": "666666",
				"plotbordercolor": "C8A1D1",
				"data": [
			   ';
		$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");
		while($row = mysqli_fetch_assoc($result)){
			$json .='{"value": "'.$row[LOSSES].'"},';}
		$json= rtrim($json, ',');
 
		$json .='
			]
	    }
		]
      }';


}


	/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

        	$msbar2dChart = new FusionCharts("msbar2d", "CommonPicks" , '600', '300', "commonpicks", "json", $json);

        	// Render the chart
        	$msbar2dChart->render();

        	// Close the database connection
        	$dbhandle->close();
     	

  	?>
  	<div id="commonpicks"><!-- Fusion Charts will render here--></div>


   </body>

</html>

