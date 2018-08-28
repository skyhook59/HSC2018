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
     	$strQuery = "SELECT pick AS TEAM
					   , count(pick) AS PICKS
					   , sum(if(winner>0.6,1,0)) AS WINS
					   , sum(if(winner=0.5,1,0)) AS TIES
					   , sum(if(winner=0.0,1,0)) AS LOSSES
					   FROM `picksview` WHERE username = '$username'
				   GROUP BY pick
				   ORDER BY Picks DESC";
				  // LIMIT 10";

     	// Execute the query, or else return the error message.
     	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

     	// If the query returns a valid response, prepare the JSON string
    	if($result) {
        	// The `$json` array holds the chart attributes and data
        	$json ='{
			   "chart": {			   	 
				 "caption": "Teams Picked The Most Often",
				 "xaxisname": "Team",
				 "yaxisname": "Times Picked",
				 "showvalues": "0",
				 "showSum": "1",
				 "showAlternateHGridColor": "0",
				 "showAlternateVGridColor": "0",
				 "theme": "fint"

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
				 "seriesname": "LOSSES",
				 "color": "#F65314",
				 "data": [
				';
	    $result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");
	    while($row = mysqli_fetch_assoc($result)){
	    	$json .='{"value": "'.$row[LOSSES].'"},';}
   		$json= rtrim($json, ',');
   		
   		$json .='
			]
	   },
	   {
				"seriesname": "TIES",
  			    "color": "#FFBB00",
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
				"seriesname": "WINS",
				 "color": "#7CBB00",				
				 "data": [
			   ';
		$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");
		while($row = mysqli_fetch_assoc($result)){
			$json .='{"value": "'.$row[WINS].'"},';}
		$json= rtrim($json, ',');
 
		$json .='
			]
	    }
		]
      }';


}
	/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

        	$stackbarChart = new FusionCharts("stackedbar2d", "CommonPicks" , '100%', '500', "commonpicks", "json", $json);

        	// Render the chart
        	$stackbarChart->render();

        	// Close the database connection
        	$dbhandle->close();
     	

  	?>
