<?php
$url = 'http://xml.pinnaclesports.com/pinnaclefeed.aspx?sporttype=Football&sportsubtype=nfl';

$xml = simplexml_load_file($url) or die("feed not loading");

$linesArray = array();
foreach ($xml->events->event as $game)

	foreach($game->participants->participant as $team)
		{
			$teamname = $team->participant_name;
				if ($visit = $team->visiting_home_draw == 'Home')
				{
					$spread =$game->periods->period->spread->spread_home;	
				}else {
					$spread = $game->periods->period->spread->spread_visiting;
				}
	
	// Turn objects into strings
		$teamname = strval($teamname);
		$spread = strval($spread);

	// Replace all the team names with my abbv.
	$teamname = str_replace("Arizona Cardinals", "ARI", $teamname);
	$teamname = str_replace("Atlanta Falcons", "ATL", $teamname);
	$teamname = str_replace("Baltimore Ravens", "BAL", $teamname);
	$teamname = str_replace("Buffalo Bills", "BUF", $teamname);
	$teamname = str_replace("Carolina Panthers", "CAR", $teamname);
	$teamname = str_replace("Chicago Bears", "CHI", $teamname);
	$teamname = str_replace("Cincinati Bengals", "CIN", $teamname);
	$teamname = str_replace("Cleveland Browns", "CLE", $teamname);
	$teamname = str_replace("Dallas Cowboys", "DAL", $teamname);
	$teamname = str_replace("Denver Broncos", "DEN", $teamname);
	$teamname = str_replace("Detroit Lions", "DET", $teamname);
	$teamname = str_replace("Green Bay Packers", "GB", $teamname);
	$teamname = str_replace("Houston Texans", "HOU", $teamname);
	$teamname = str_replace("Indianapolis Colts", "IND", $teamname);
	$teamname = str_replace("Jacksonville Jaguars", "JAX", $teamname);
	$teamname = str_replace("Kansas City Chiefs", "KC", $teamname);
	$teamname = str_replace("Miami Dolphins", "MIA", $teamname);
	$teamname = str_replace("Minnesota Vikings", "MIN", $teamname);
	$teamname = str_replace("New England Patriots", "NE", $teamname);
	$teamname = str_replace("New Orleans Saints", "NO", $teamname);
	$teamname = str_replace("New York Giants", "NYG", $teamname);
	$teamname = str_replace("New York Jets", "NYJ", $teamname);
	$teamname = str_replace("Oakland Raiders", "OAK", $teamname);
	$teamname = str_replace("Philadelphia Eagles", "PHI", $teamname);
	$teamname = str_replace("Pittsburgh Steelers", "PIT", $teamname);
	$teamname = str_replace("San Diego Chargers", "SD", $teamname);
	$teamname = str_replace("Seattle Seahawks", "SEA", $teamname);
	$teamname = str_replace("Tampa Bay Buccaneers", "TB", $teamname);
	$teamname = str_replace("Los Angeles Rams", "LA", $teamname);
	$teamname = str_replace("Tennessee Titans", "TEN", $teamname);
	$teamname = str_replace("Washington Redskins", "WAS", $teamname);
	$teamname = str_replace("San Francisco 49ers", "SF", $teamname);
		
// load into key-value array	
$linesArray[$teamname] = $spread;

}
		
//print_r($linesArray);

?>
