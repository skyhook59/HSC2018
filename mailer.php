<?php

//variable for database connection
require "connections.php";
//variable for database connection

require_once('../PHPMailer/class.phpmailer.php');
$mail = new PHPMailer();

// Email Variables
$mail->isSMTP(); // telling the class to use SMTP
//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the server
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
$mail->Username   = "reminder@mcph.ee";    // GMAIL username
$mail->Password   = "$emailpassword";      // GMAIL password

$mail->SetFrom('reminder@mcph.ee', 'Steve McPhee');
$mail->AddReplyTo('steve@mcph.ee', 'Steve McPhee');


// Email Subject & Body Content
$mail->Subject    = "You haven't submitted your picks for HSC yet.";
//$body             = file_get_contents('contents.html');
$body = "Yo. This is a reminder that you haven't submitted your picks for this week. They are due at 2pm EST on Saturdays. Get'er done!  http://hsc.mcph.ee/HSC2018";
$body             = eregi_replace("[\]",'',$body);

$mail->MsgHTML($body);


//open DB connection
$con = mysql_connect($host,$dbusername,$password);

if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
mysql_select_db("$database", $con);

$query = "SELECT email, name FROM `users`  WHERE username NOT IN(SELECT DISTINCT username FROM `Picks`  WHERE week = $week)";
$results = mysql_query($query);



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

?>
