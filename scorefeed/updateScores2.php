<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Updating the Scores</title>
</head>
<body>



<?php
//variable for database connection

require "../connections.php";

//open DB connection
$con = mysql_connect($host,$dbusername,$password);
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
mysql_select_db("$database", $con);


// curl function to scrap data from feed

function get_content($url)
{
	$ch = curl_init();

	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_HEADER, 0);

	ob_start();

	curl_exec ($ch);
	curl_close ($ch);
	$string = ob_get_contents();

	ob_end_clean();

	return $string;
}
// Pull content from ESPN
$content = get_content ("http://www.espn.com/nfl/bottomline/scores");

// Put into an array
$content_array=explode("&", $content);
$scorearray = array();
$i=0;
// Iterate through the array
foreach($content_array as $content) {
	if (strpos($content, "_left") !==FALSE ) // only look at elements that start with _left
	{
		$equalpos = strpos($content, "="); // get the position of the = sign
		$end = strlen($content); // get the length of the string
		$score = substr($content, ($equalpos+1), $end); // pull the string between the = sign and the end
		$score = str_replace("^", "", $score); // get rid of the ^ signs (designates home teams)
		// Replaces all the teams with their 3 letter abbreviation
		$score = str_replace("Arizona", "ARI", $score);
		$score = str_replace("Atlanta", "ATL", $score);
		$score = str_replace("Baltimore", "BAL", $score);
		$score = str_replace("Buffalo", "BUF", $score);
		$score = str_replace("Carolina", "CAR", $score);
		$score = str_replace("Chicago", "CHI", $score);
		$score = str_replace("Cincinnati", "CIN", $score);
		$score = str_replace("Cleveland", "CLE", $score);
		$score = str_replace("Dallas", "DAL", $score);
		$score = str_replace("Denver", "DEN", $score);
		$score = str_replace("Detroit", "DET", $score);
		$score = str_replace("Green%20Bay", "GB", $score);
		$score = str_replace("Houston", "HOU", $score);
		$score = str_replace("Indianapolis", "IND", $score);
		$score = str_replace("Jacksonville", "JAX", $score);
		$score = str_replace("Kansas%20City", "KC", $score);
		$score = str_replace("Miami", "MIA", $score);
		$score = str_replace("Minnesota", "MIN", $score);
		$score = str_replace("New%20England", "NE", $score);
		$score = str_replace("New%20Orleans", "NO", $score);
		$score = str_replace("NY%20Giants", "NYG", $score);
		$score = str_replace("NY%20Jets", "NYJ", $score);
		$score = str_replace("Oakland", "OAK", $score);
		$score = str_replace("Philadelphia", "PHI", $score);
		$score = str_replace("Pittsburgh", "PIT", $score);
		$score = str_replace("San%20Diego", "SD", $score);
		$score = str_replace("Seattle", "SEA", $score);
		$score = str_replace("San%20Francisco", "SF", $score);
		$score = str_replace("Los%20Angeles", "LA", $score);
		$score = str_replace("Tampa%20Bay", "TB", $score);
		$score = str_replace("Tennessee", "TEN", $score);
		$score = str_replace("Washington", "WAS", $score);
		$score = str_replace("%20%20%20", ",", $score); // replaces the 3 spaces between scores with a ,
		$score = str_replace("%20", ",", $score); // replaces the remaining spaces with a ,
		$elem = explode(",",$score); //breaks these new strings into elements call $elem[x]
		$scorearray[$i][$elem[0]] = $elem[1]; // creates array with the key = the 1st team, and the value the 1st teams's score
		$scorearray[$i][$elem[2]] = $elem[3];// creates array with the key = the 2nd team, and the value the 2nd teams's score
		$scorearray[$i][$elem[6]];
/*
		// updates where the 1st team is the favTeam
		$query="UPDATE $database.Lines SET favScore = $elem[1], gameStatus = '$elem[4] $elem[5] $elem[6]'
		WHERE favTeam = '$elem[0]'
		AND week = $week";
		mysql_query($query);

		// updates where the 1st team is the dogTeam
		$query="UPDATE $database.Lines SET dogScore = $elem[1], gameStatus = '$elem[4] $elem[5] $elem[6]'
		WHERE dogTeam = '$elem[0]'
		AND week = $week";
		mysql_query($query);

		// updates where the 2nd team is the favTeam
		$query="UPDATE $database.Lines SET favScore = $elem[3], gameStatus = '$elem[4] $elem[5] $elem[6]'
		WHERE favTeam = '$elem[2]'
		AND week = $week";
		mysql_query($query);

		// updates where the 2nd team is the dogTeam
		$query="UPDATE $database.Lines SET dogScore = $elem[3], gameStatus = '$elem[4] $elem[5] $elem[6]'
		WHERE dogTeam = '$elem[2]'
		AND week = $week";
		mysql_query($query);

*/
		$i++;
	}
}

// close DB connection
//mysql_close($con);

echo '<pre>';
echo "week = $week"."</br>";
echo $string;
print_r($scorearray[$i][$elem[0]] = $elem[1]); // creates array with the key = the 1st team, and the value the 1st teams's score
//		$scorearray[$i][$elem[2]] = $elem[3];// creates array with the key = the 2nd team, and the value the 2nd teams's score
//		$scorearray[$i][$elem[6]];
print_r($scorearray);
echo "<br>Seems to have worked, check the database('.$database.')<br><br>";
echo '</pre>';

?>
