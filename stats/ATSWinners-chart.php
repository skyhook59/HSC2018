<?php
   
// all DB connection stuff
   include("../connections.php");

// The following 4 code lines contain the database connection information. Alternatively, you can move these code lines to a separate file and include the file here. You can also modify this code based on your database connection. */

   $hostdb = "$host";  // MySQl host
   $userdb = "$dbusername";  // MySQL username
   $passdb = "$password";  // MySQL password
   $namedb = "$database";  // MySQL database name

   // Establish a connection to the database
   $dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

   // Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect
   if ($dbhandle->connect_error) {
  	exit("There was an error with your connection: ".$dbhandle->connect_error);
   }

     	// Form the SQL query
     	$strQuery = "SELECT ATSWinner AS TEAM, count(gameStatus) AS WINS FROM linesview 
					WHERE gameStatus <>''
					GROUP BY TEAM
					ORDER BY Wins DESC";

     	// Execute the query, or else return the error message.
     	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

     	// If the query returns a valid response, prepare the JSON string
    	if($result) {
        	// The `$json` array holds the chart attributes and data
        	$json ='{
			   "chart": {			   	 
				 "caption": "Best Record Against the Spread",
				 "xaxisname": "Team",
				 "yaxisname": "ATS Wins",
				 "showvalues": "1",
				 "showSum": "0",
		         "placeValuesInside": "1",
				 "showAlternateHGridColor": "0",
				 "showAlternateVGridColor": "0",
				 "theme": "fint"
			     },
			    "data": [';
	    
	    while($row = mysqli_fetch_assoc($result)){
	    	$json .='{ "color": "#00A1F1","label": "'.$row[TEAM].'", "value": "'.$row[WINS].'"},';}
   		$json= rtrim($json, ',');
		   	$json .='				
				]}';
			}
	/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

        	$barChart = new FusionCharts("bar2d", "ATSWinnersChart", '100%', '100%', "ATSWinners", "json", $json);
        	// Render the chart
        	$barChart->render();

        	// Close the database connection
        	$dbhandle->close();
     	

  	?>
