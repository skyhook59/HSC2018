<?php
   
// all DB connection stuff
   include("../connections.php");

// The following 4 code lines contain the database connection information. Alternatively, you can move these code lines to a separate file and include the file here. You can also modify this code based on your database connection. */

   $hostdb = "$host";  // MySQL host
   $userdb = "$dbusername";  // MySQL username
   $passdb = "$password";  // MySQL password
   $namedb = "$database";  // MySQL database name

   // Establish a connection to the database
   $dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

   // Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect
   if ($dbhandle->connect_error) {
  	exit("There was an error with your connection: ".$dbhandle->connect_error);
   }
   	// Form the first SQL query to get the current user's total score
   	$strQueryMyScore = "SELECT sum(winner) AS Score FROM picksview WHERE username = '$username'";

	// Execute the query, or else return the error message.
   	$result = $dbhandle->query($strQueryMyScore) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

	$row = mysqli_fetch_array($result);
	$myscore = $row[0];
	

	// Form the SQL query to see where the score above ranks (how many are above it)
   	$strQuery = "SELECT COUNT(*) FROM ( SELECT SUM(winner) AS `Total` FROM picksview GROUP BY username HAVING SUM(winner)>$myscore) s";

   	// Execute the query, or else return the error message.
   	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");


	$row = mysqli_fetch_array($result);
	$rank = $row[0];

$rank = $rank + 1;

//  echo $username.' is currently ranked '.$rank;


//Number of Wins
   	$strQuery = "SELECT sum(if(winner=1.0,1,0)) FROM `picksview` WHERE username='$username'";

   	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

	$row = mysqli_fetch_array($result);
	$num_wins = $row[0];

//Number of Ties
   	$strQuery = "SELECT sum(if(winner=0.5,1,0)) FROM `picksview` WHERE username='$username'";

   	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

	$row = mysqli_fetch_array($result);
	$num_ties = $row[0];

//Number of Losses
   	$strQuery = "SELECT sum(if(winner=0,1,0)) FROM `picksview` WHERE username='$username'";

   	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

	$row = mysqli_fetch_array($result);
	$num_losses = $row[0];

//echo "$username has $num_wins wins, $num_ties ties, and $num_losses losses";

?>
