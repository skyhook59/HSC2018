<?php

//variable for database connection
require_once ('../connections.php');
//variable for database connection
$week=1;
require_once('../../PHPMailer/class.phpmailer.php');
$mail = new PHPMailer();

// Email Variables
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "smtp.gmail.com";      // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "tls";                 // sets the prefix to the server
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
$mail->Username   = "reminder@mcph.ee";    // GMAIL username
$mail->Password   = "$emailpassword";         // GMAIL password

$mail->SetFrom('reminder@mcph.ee', 'Steve McPhee');
$mail->AddReplyTo('steve@mcph.ee', 'Steve McPhee');


// Email Subject & Body Content
$mail->Subject    = "Week $week Lines are Now Up";
//$body             = file_get_contents('contents.html');
$body = "The line are now up. You can review them, and submit your picks here: http://65.94.155.91/HSC2015 ";
$body             = eregi_replace("[\]",'',$body);

$mail->MsgHTML($body);


//open DB connection
$con = mysql_connect($host,$dbusername,$password);


$linesup = "SELECT count(*) FROM `Lines` WHERE week = $week";



if ($linesup > 0 ){

	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("$database", $con);

	$query = "SELECT email, name FROM users  WHERE username ='MCPHEE'";
	//NOT IN(SELECT DISTINCT username FROM Picks  WHERE week = $week)";
	$results = mysql_query($query);
 echo "$linesup found for week $week.";
 }


while( ($result = mysql_fetch_array($results)))
{
	$emailaddress = $result['email'];
	$name = $result['name'];
	
$address = "$emailaddress";
$mail->clearAllRecipients( );
$mail->AddAddress($address, "$name");


//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

}

// close DB connection
mysql_close($con);

echo $week;
?>
page loaded.
