<?php


//variable for database connection

include "../connections.php";

$tablename = "Lines";

//open DB connection
$con = mysql_connect($host,$dbusername,$password);
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
mysql_select_db("$database", $con);


//$week = 1;

$hometeam = array (

array('ARI', 'BAL', 'CAR', 'CLE', 'DEN', 'DET', 'GB',  'IND', 'LAC', 'MIA', 'MIN', 'NE',  'WSH', 'NYG', 'OAK', 'PHI'),  //week1					
array('ATL', 'BUF', 'CHI', 'CIN', 'DAL', 'DEN', 'GB',  'JAX', 'LAR', 'NO',  'NYJ', 'PIT', 'NYJ', 'TB',  'TEN', 'WSH'),  //week2					
array('ARI', 'ATL', 'BAL', 'CAR', 'CLE', 'DET', 'HOU', 'JAX', 'KC',  'LAR', 'MIA', 'MIN', 'PIT', 'SEA', 'TB',  'WSH'),  //week3					
array('ARI', 'ATL', 'CHI', 'DAL', 'DEN', 'GB',  'IND', 'JAX', 'LAC', 'LAR', 'NE',  'NYG', 'SF',  'PIT', 'TEN'), 		//week4					
array('BUF', 'CAR', 'CIN', 'CLE', 'DET', 'HOU', 'KC',  'LAC', 'NE',  'NO',  'NYJ', 'PHI', 'NYG', 'SEA', 'SF'), 			//week5					
array('ATL', 'CIN', 'CLE', 'DAL', 'DEN', 'GB',  'HOU', 'MIA', 'MIN', 'NE',  'NYG', 'NYJ', 'PHI', 'TEN', 'WSH'), 		//week6					
array('ARI', 'ATL', 'BAL', 'CHI', 'IND', 'JAX', 'KC',  'LAC', 'MIA', 'NYJ', 'PHI', 'SF',  'SEA', 'WSH'), 				//week7					
array('ARI', 'BUF', 'CAR', 'CHI', 'CIN', 'DET', 'HOU', 'JAX', 'KC',  'LAR', 'MIN', 'NYG', 'PIT'), 						//week8					
array('BAL', 'BUF', 'CAR', 'CLE', 'DAL', 'DEN', 'MIA', 'MIN', 'NE',  'NO',  'SEA', 'SF',  'ATL'), 						//week9					
array('CHI', 'CIN', 'CLE', 'GB',  'IND', 'KC',  'LAR', 'NYJ', 'OAK', 'PHI', 'PIT', 'SF',  'TEN'), 						//week10					
array('ARI', 'ATL', 'BAL', 'CHI', 'DET', 'IND', 'JAX', 'LAC', 'LAR', 'NO',  'NYG', 'SEA'), 								//week11					
array('BAL', 'BUF', 'CAR', 'CIN', 'DAL', 'DEN', 'DET', 'HOU', 'IND', 'LAC', 'MIN', 'NO',  'PHI', 'TB'), 				//week12					
array('ATL', 'CIN', 'DAL', 'DET', 'GB',  'HOU', 'JAX', 'MIA', 'NE',  'NYG', 'OAK', 'PHI', 'SEA', 'TB',  'TEN'), 		//week13					
array('ARI', 'BUF', 'CHI', 'CLE', 'DAL', 'GB',  'HOU', 'KC',  'LAC', 'MIA', 'OAK', 'SEA', 'TB',  'TEN', 'WSH'), 		//week14					
array('ATL', 'BAL', 'BUF', 'CAR', 'CHI', 'CIN', 'DEN', 'IND', 'JAX', 'KC',  'LAR', 'MIN', 'NYJ', 'PIT', 'SF'), 			//week15					
array('ARI', 'CAR', 'CLE', 'DAL', 'DET', 'IND', 'LAC', 'MIA', 'NE',  'NO',  'NYJ', 'OAK', 'SEA', 'SF',  'TEN'), 		//week16					
array('BAL', 'BUF', 'DEN', 'GB',  'HOU', 'KC',  'LAR', 'MIN', 'NE',  'NO',  'NYG', 'PIT', 'TB',  'TEN', 'WSH'), 		//week17					

);


foreach ($hometeam[$week-1] as $team)
	{
	echo "UPDATE `Lines` SET homeTeam ='$team' WHERE week = $week AND '$team' in (favTeam, dogTeam) </br>";
	$query="UPDATE `Lines` SET homeTeam ='$team' WHERE week = $week AND '$team' in (favTeam, dogTeam)";      mysql_query($query);
}
 

// close DB connection..
mysql_close($con);


?>


	
	
<!-- page loaded -->
	