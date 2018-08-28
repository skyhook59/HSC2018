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
     	$strQuery = "SELECT week, sum(winner) AS Wins FROM `picksview` where username = '$username' GROUP BY week ORDER BY week asc";

     	// Execute the query, or else return the error message.
     	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

     	// If the query returns a valid response, prepare the JSON string
    	if($result) {
        	// The `$json` array holds the chart attributes and data
        	$json =' 
					{
			"chart": {
				"caption": "Wins By Week",
				"xAxisname": "Week",
				"bgColor": "#ffffff",
				"borderAlpha": "20",
				"canvasBorderAlpha": "0",
				"usePlotGradientColor": "0",
				"plotBorderAlpha": "10",
				"showXAxisLine": "1",
				"showValues": "1",
				"divLineIsDashed": "1",
				"showAlternateHGridColor": "0"
			},
			"categories": [
			  {
			   "category": [
				';
	    
	    while($row = mysqli_fetch_assoc($result)){
	    	$json .='{"label": "'.$row[week].'"},';}
   		$json= rtrim($json, ',');
		   	$json .='				
					]}],
			"dataset": [
				{
				 "seriesname": "'.$username.'",
				 "renderas": "line",
				 "data": [
				';
	    $result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");
	    while($row = mysqli_fetch_assoc($result)){
	    	$json .='{"value": "'.$row[Wins].'"},';}
   		$json= rtrim($json, ',');
   		
   		$json .='
			]
	   },
	   {
         "seriesname": "Average",
         "color": "#ff0000",
         "renderas": "line",
         "showValues": "0",
         "data": [
	        ';
       	$strQuery = "SELECT week, (sum(winner) / count(DISTINCT(username))) AS AvgWins FROM `picksview` GROUP BY week";
	    $result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");
	    while($row = mysqli_fetch_assoc($result)){
	    	$json .='{"value": "'.$row[AvgWins].'"},';}
   		$json= rtrim($json, ',');
   		
   		$json .='
			]
	    }
		]
      }';


}


	/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

        	$mscombi2dChart = new FusionCharts("mscombi2d", "WinsChartByWeek" , '100%', '300', "winschartbyweek", "json", $json);

        	// Render the chart
        	$mscombi2dChart->render();

        	// Close the database connection
        	$dbhandle->close();
     	

  	?>


   </body>

</html>
