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


$week = 3;

$hometeam = array (
  array('NE','DET','CHI','CIN','HOU','BUF','TEN','WAS','CLE','MIA','LAR','SF','GB','DAL','MIN','DEN'), //week1
  array('CIN','IND','CAR','TB','BAL','PIT','NO','KC','JAX','LAC','OAK','DEN','SEA','LAR','ATL','NYG'), //week2
  array('SF','DET','IND','BUF','NE','NYJ','CAR','PHI','CHI','MIN','TEN','GB','LAC','WAS','ARI'), //week3
  array('GB',	'ATL',	'NE',	'CLE',	'MIN',	'NYJ',	'DAL',	'BAL',	'HOU',	'TB',	'LAC',	'ARI',	'DEN',	'SEA',	'KC'), //week4
  array('TB',	'PHI',	'CIN',	'DET',	'PIT',	'NYG',	'CLE',	'IND',	'MIA',	'OAK',	'LAR',	'DAL',	'HOU',	'CHI'), //week5
  array('CAR',	'BAL',	'HOU',	'NO',	'MIN',	'ATL',	'NYJ',	'WAS',	'JAX',	'ARI',	'OAK',	'KC',	'DEN'), //week6
  array('OAK',	'MIN',	'CHI',	'PIT',	'IND',	'GB',	'MIA',	'BUF',	'CLE',	'SF',	'LAC',	'NYG',	'NE',	'PHI'), //week7
  array('BAL',	'NYJ',	'TB',	'NO',	'CIN',	'NE',	'BUF',	'PHI',	'SEA',	'WAS',	'DET',	'KC'), //week8
  array('NYJ',	'CAR',	'TEN',	'JAX',	'PHI',	'HOU',	'NYG',	'NO',	'SF',	'SEA',	'DAL',	'MIA',	'GB'), //week9
  array('ARI',	'TEN',	'DET',	'CHI',	'JAX',	'WAS',	'BUF',	'TB',	'IND',	'LAR',	'ATL',	'SF',	'DEN',	'CAR'), //week10
  array('PIT',	'HOU',	'GB',	'CHI',	'CLE',	'NYG',	'MIN',	'NO',	'LAC',	'DEN',	'DAL'), //week11
  array('DET',	'DAL',	'WAS',	'KC',	'NYJ',	'PHI',	'CIN',	'NE',	'ATL',	'IND',	'LAR',	'SF',	'OAK',	'ARI',	'PIT',	'BAL'), //week12
  array('DAL',	'NO',	'MIA',	'BAL',	'TEN',	'JAX',	'NYJ',	'ATL',	'BUF',	'CHI',	'GB',	'LAC',	'ARI',	'OAK',	'SEA',	'CIN'), //week13
  array('ATL',	'CIN',	'TB',	'CLE',	'BUF',	'CAR',	'KC',	'HOU',	'JAX',	'DEN',	'ARI',	'LAC',	'NYG',	'LAR',	'PIT',	'MIA'), //week14
  array('IND',	'DET',	'KC',	'WAS',	'CLE',	'MIN',	'CAR',	'JAX',	'BUF',	'NO',	'NYG',	'SEA',	'PIT',	'SF',	'OAK',	'TB'),  //week15
  array('BAL',	'GB',	'NO',	'NE',	'CHI',	'WAS',	'CIN',	'NYJ',	'TEN',	'KC',	'CAR',	'SF',	'ARI',	'DAL',	'HOU',	'PHI'), //week16
  array('MIA',	'ATL',	'MIN',	'BAL',	'PIT',	'PHI',	'DET',	'IND',	'TEN',	'TB',	'NE',	'NYG',	'SEA',	'DEN',	'LAC',	'LAR'), //week17  
);


foreach ($hometeam[$week-1] as $team)
	{
	echo "UPDATE `Lines` SET homeTeam ='$team' WHERE week = $week AND '$team' in (favTeam, dogTeam) </br>";
}
 

// close DB connection..
mysql_close($con);


?>