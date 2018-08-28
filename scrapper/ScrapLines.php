
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

$dom = new DOMDocument;
libxml_use_internal_errors(TRUE);

$dom->loadHTMLFile('https://www.westgatedestinations.com/nevada/las-vegas/westgate-las-vegas-hotel-casino/casino/supercontest-weekly-card');
libxml_clear_errors();

// Load the dom object into a DOMXpath object
$xpath = new DOMXpath($dom);


// Strips out whitespace
$dom->preserveWhiteSpace = false;


// XPath for finding the TRs

$element='//*/table//tr';

// Query the DOXpath object stored in $xpath to pull out the TRs defined in $element
$entries = $xpath->query($element);

echo '<pre>';
// loop over the table rows

foreach ($entries as $entry) 
{ 
    // get each column by tag name
    $cols = $entry->getElementsByTagName('td');
       
    // remove the asterisks
	$favteam = str_replace("*", "",$cols->item(0)->nodeValue); 
    $dogteam = str_replace("*", "",$cols->item(2)->nodeValue);

    // TODO add an IF statement based on the presense of a +
    // Make the lines negative if there is a +
    $theline = str_replace("+", "-",$cols->item(3)->nodeValue); 
	
	
	// Make the lines negative if there is no + TURNED BACK ON Setp 13, 2017  
//	$theline = "-".$cols->item(3)->nodeValue; 
    
    
    // Remove the game numbers-- but also removed the 49 from 49ers.
	$favteam = preg_replace('#[0-9 ]*#', '', $favteam);
	$dogteam = preg_replace('#[0-9 ]*#', '', $dogteam);
	
	// convert the fraction to .5 and then convert the string to a float
//	$theline = preg_replace('/[^0-9-\/]/', '', $theline);
//	$theline = str_replace("1/2", ".5", $theline); //not needed now that they use decimals
	$theline = (float) $theline;
	
	// Replace all the team names with my abbv. for favorites
	$favteam = str_replace("CARDINALS", "ARI", $favteam);
	$favteam = str_replace("FALCONS", "ATL", $favteam);
	$favteam = str_replace("RAVENS", "BAL", $favteam);
	$favteam = str_replace("BILLS", "BUF", $favteam);
	$favteam = str_replace("PANTHERS", "CAR", $favteam);
	$favteam = str_replace("BEARS", "CHI", $favteam);
	$favteam = str_replace("BENGALS", "CIN", $favteam);
	$favteam = str_replace("BROWNS", "CLE", $favteam);
	$favteam = str_replace("COWBOYS", "DAL", $favteam);
	$favteam = str_replace("BRONCOS", "DEN", $favteam);
	$favteam = str_replace("LIONS", "DET", $favteam);
	$favteam = str_replace("PACKERS", "GB", $favteam);
	$favteam = str_replace("TEXANS", "HOU", $favteam);
	$favteam = str_replace("COLTS", "IND", $favteam);
	$favteam = str_replace("JAGUARS", "JAX", $favteam);
	$favteam = str_replace("CHIEFS", "KC", $favteam);
	$favteam = str_replace("DOLPHINS", "MIA", $favteam);
	$favteam = str_replace("VIKINGS", "MIN", $favteam);
	$favteam = str_replace("PATRIOTS", "NE", $favteam);
	$favteam = str_replace("SAINTS", "NO", $favteam);
	$favteam = str_replace("GIANTS", "NYG", $favteam);
	$favteam = str_replace("JETS", "NYJ", $favteam);
	$favteam = str_replace("RAIDERS", "OAK", $favteam);
	$favteam = str_replace("EAGLES", "PHI", $favteam);
	$favteam = str_replace("STEELERS", "PIT", $favteam);
	$favteam = str_replace("CHARGERS", "LAC", $favteam);
	$favteam = str_replace("SEAHAWKS", "SEA", $favteam);
	$favteam = str_replace("BUCCANEERS", "TB", $favteam);
	$favteam = str_replace("RAMS", "LAR", $favteam);
	$favteam = str_replace("TITANS", "TEN", $favteam);
	$favteam = str_replace("REDSKINS", "WAS", $favteam);
	//since removing the game number also removed the 49 from 49ers, changed to ERS
	$favteam = str_replace("ERS", "SF", $favteam);
	
	// Replace all the team names with my abbv. for dogs
	$dogteam = str_replace("CARDINALS", "ARI", $dogteam);
	$dogteam = str_replace("FALCONS", "ATL", $dogteam);
	$dogteam = str_replace("RAVENS", "BAL", $dogteam);
	$dogteam = str_replace("BILLS", "BUF", $dogteam);
	$dogteam = str_replace("PANTHERS", "CAR", $dogteam);
	$dogteam = str_replace("BEARS", "CHI", $dogteam);
	$dogteam = str_replace("BENGALS", "CIN", $dogteam);
	$dogteam = str_replace("BROWNS", "CLE", $dogteam);
	$dogteam = str_replace("COWBOYS", "DAL", $dogteam);
	$dogteam = str_replace("BRONCOS", "DEN", $dogteam);
	$dogteam = str_replace("LIONS", "DET", $dogteam);
	$dogteam = str_replace("PACKERS", "GB", $dogteam);
	$dogteam = str_replace("TEXANS", "HOU", $dogteam);
	$dogteam = str_replace("COLTS", "IND", $dogteam);
	$dogteam = str_replace("JAGUARS", "JAX", $dogteam);
	$dogteam = str_replace("CHIEFS", "KC", $dogteam);
	$dogteam = str_replace("DOLPHINS", "MIA", $dogteam);
	$dogteam = str_replace("VIKINGS", "MIN", $dogteam);
	$dogteam = str_replace("PATRIOTS", "NE", $dogteam);
	$dogteam = str_replace("SAINTS", "NO", $dogteam);
	$dogteam = str_replace("GIANTS", "NYG", $dogteam);
	$dogteam = str_replace("JETS", "NYJ", $dogteam);
	$dogteam = str_replace("RAIDERS", "OAK", $dogteam);
	$dogteam = str_replace("EAGLES", "PHI", $dogteam);
	$dogteam = str_replace("STEELERS", "PIT", $dogteam);
	$dogteam = str_replace("CHARGERS", "LAC", $dogteam);
	$dogteam = str_replace("SEAHAWKS", "SEA", $dogteam);
	$dogteam = str_replace("BUCCANEERS", "TB", $dogteam);
	$dogteam = str_replace("RAMS", "LAR", $dogteam);
	$dogteam = str_replace("TITANS", "TEN", $dogteam);
	$dogteam = str_replace("REDSKINS", "WAS", $dogteam);
	$dogteam = str_replace("ERS", "SF", $dogteam);


/*
// testing outputs
if (strpos($favteam, "DAY") === false ) {
echo $database.$tablename.'('.$week.','.$favteam.','.$dogteam.','.$theline.', ,0,0, )<br />';
//echo $favteam."&nbsp;".$dogteam;."&nbsp;".$theline;
    }                                
*/
  // inserts the line into the LINES table, skipping the title rows that start with 'PRO' 
if (strpos($favteam, "DAY") === false ) {
$query="INSERT INTO $database.$tablename( `week`, `favTeam`, `dogTeam`, `line`,`homeTeam`, `favScore`, `dogScore`, `gameStatus`) VALUES ('$week','$favteam','$dogteam','$theline',' ','0','0',' ')";
 mysql_query($query);
	//echo out just to see if it looks right
	echo $favteam."&nbsp;".$dogteam."&nbsp;".$theline;
	echo "<br />";
	}

 
}   

echo 'it worked???';
echo '</pre>';

// close DB connection
mysql_close($con);

?>



	
	
<!-- page loaded -->
	