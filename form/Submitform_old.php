<?php 
//variable for database connection

require "../connections.php";

$PicksTable = "Picks";
$weeknumber = $week;
$ipaddress = $_SERVER['REMOTE_ADDR'];

// Grab values from POST of form, make all upper case- makes queries later easier.
	$username=$_POST['username'];

	$pick1=strtoupper($_POST['pick1']);
	$pick2=strtoupper($_POST['pick2']);
	$pick3=strtoupper($_POST['pick3']);
	$pick4=strtoupper($_POST['pick4']);
	$pick5=strtoupper($_POST['pick5']);

	//open DB connection
	$con = mysql_connect($host,$dbusername,$password);
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("$database", $con);

// Determine Which Week We're in
	$date = date('Y-m-d H:i:s');

//	$weeknumber =  mysql_result(mysql_query("SELECT week FROM weekNumber WHERE WeekStartTime < '$date' LIMIT 1"),0);
	
// Get User ID
	$id = mysql_result(mysql_query("SELECT id FROM users WHERE username='$username'"),0);

// Get User E-mail Address
	$emailaddress = mysql_result(mysql_query("SELECT email FROM users WHERE username='$username'"),0);
// Get User Name
	$name = mysql_result(mysql_query("SELECT name FROM users WHERE username='$username'"),0);



// Get Game ID for each Pick from the Lines table
$gameID1 = mysql_result(mysql_query("SELECT gameID FROM `Lines` WHERE week = $weeknumber AND '$pick1' in(favTeam, dogTeam)"),0);
$gameID2 = mysql_result(mysql_query("SELECT gameID FROM `Lines` WHERE week = $weeknumber AND '$pick2' in(favTeam, dogTeam)"),0);
$gameID3 = mysql_result(mysql_query("SELECT gameID FROM `Lines` WHERE week = $weeknumber AND '$pick3' in(favTeam, dogTeam)"),0);
$gameID4 = mysql_result(mysql_query("SELECT gameID FROM `Lines` WHERE week = $weeknumber AND '$pick4' in(favTeam, dogTeam)"),0);
$gameID5 = mysql_result(mysql_query("SELECT gameID FROM `Lines` WHERE week = $weeknumber AND '$pick5' in(favTeam, dogTeam)"),0);	

// Insert Pick 1
	$sql="INSERT INTO $PicksTable (`id`, `username`, `week`,`gameID`, `pick`)
	VALUES
	('$id','$username','$weeknumber','$gameID1','$pick1')";
	mysql_query($sql);
// Insert Pick 2
	$sql="INSERT INTO $PicksTable (`id`, `username`, `week`,`gameID`, `pick`)
	VALUES
	('$id','$username','$weeknumber','$gameID2','$pick2')";
	mysql_query($sql);
// Insert Pick 3
	$sql="INSERT INTO $PicksTable (`id`, `username`, `week`,`gameID`, `pick`)
	VALUES
	('$id','$username','$weeknumber','$gameID3','$pick3')";
	mysql_query($sql);
// Insert Pick 4
	$sql="INSERT INTO $PicksTable (`id`, `username`, `week`,`gameID`, `pick`)
	VALUES
	('$id','$username','$weeknumber','$gameID4','$pick4')";
	mysql_query($sql);
// Insert Pick 5
	$sql="INSERT INTO $PicksTable (`id`, `username`, `week`,`gameID`, `pick`)
	VALUES
	('$id','$username','$weeknumber','$gameID5','$pick5')";
	mysql_query($sql);
//Close DB Connection
	mysql_close($con);

	
echo "<pre>";		
$resultmessage ="At $date For Week $weeknumber $username from $ipaddress who has an ID # of $id, picked: [$gameID1] $pick1, [$gameID2] $pick2, [$gameID3] $pick3, [$gameID4] $pick4, [$gameID5] $pick5";
echo $resultmessage;
echo "</br>";
echo "</pre>";

//Write to a log
$file = 'pickslogX.txt';
$current = file_get_contents($file);
$current .= "$resultmessage \r\n";
file_put_contents($file,$current);



//send email with picks
require_once('/home/pi/www/PHPMailer/class.phpmailer.php');
$mail = new PHPMailer();

// Email Variables
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "smtp.gmail.com";      // SMTP server
//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "tls";                 // sets the prefix to the server
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
$mail->Username   = "reminder@mcph.ee";    // GMAIL username
$mail->Password   = "$emailpassword";      // GMAIL password

$mail->SetFrom('reminder@mcph.ee', 'Steve McPhee');
$mail->AddReplyTo('steve@mcph.ee', 'Steve McPhee');


// Email Subject & Body Content
$mail->Subject    = "Your HSC Picks for Week $weeknumber";
//$body             = file_get_contents('contents.html');
$body = "
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<title>Untitled Document</title>
</head>

<body>
<p>Here is a summary of your picks for week $weeknumber:</p>
  $pick1<br />
  $pick2<br />
  $pick3<br />
  $pick4<br />
  $pick5<br />
<br />
Good luck with your picks!
<br />
Cheers,
<br />
<p>Helga.


</body>
</html>
";

//$body             = eregi_replace("[\]",'',$body);

$mail->MsgHTML($body);
	
$address = "$emailaddress";
//$mail->clearAllRecipients( );
$mail->AddAddress($address, "$name");

//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}




?>

