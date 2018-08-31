<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>This Week's Picks</title>
<!--
  <link rel="stylesheet" type="text/css" href="view.css" media="all">
  <script type="text/javascript" src="view.js"></script>
  -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/parsley.js/1.1.16/parsley.extend.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/parsley.js/1.1.16/parsley.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/css/bootstrap.min.css">
<link href="http://getbootstrap.com/2.3.2/assets/css/bootstrap-responsive.css" rel="stylesheet">
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<style type="text/css">
             input.parsley-success
            {
              color: #468847 !important;
              background-color: #DFF0D8 !important;
              border: 1px solid #D6E9C6 !important;
            }
  
            ul.parsley-error-list
            {
                font-size: 14px;
                list-style-type:none;
            }
            
            input.parsley-error
            {
              color: #B94A48 !important;
              background-color: #F2DEDE !important;
              border: 1px solid #EED3D7 !important;
            }
            ul.parsley-error-list li
            {
                line-height: 14px;
            }
			#lines
			{
				width: 20em;
			}
			input.input-mini
			{
				width:3em;
				float:middle;
			}
			.control-label
			{
				font-weight:normal;
			}
			
        </style>
</head>
<body id="main_body" >
<div id="lines">	
<?php

	//variable for database connection
 	 require "../connections.php";
	
	//feed from pinnacle- in $linesArray 
	//key-value array: $linesArray[$teamname] = $spread;
//	 include "pinnacle_feed.php";

	//open DB connection
	$con = mysql_connect($host,$dbusername,$password);
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("$database", $con);


	$pinnacle_url = "https://www.pinnacle.com/en/odds/match/football/usa/nfl?sport=true&aup=true&icl=nfl-hpsnippet";
?>
	
	<form  role="form" method="post" action="Submitform1.php">

		<div class="form-group">	
	     <div class="control-group">
 		 <label for="username" >Username </label>
		 <select id="username" name="username" data-required="true"> 

			<option value='' selected='selected'></option>
			<option value='MCPHEE' >MCPHEE </option>
			<option value='DARK' >DARK </option>
			<option value='GRAMMA' >GRAMMA </option>
			<option value='GORD' >GORD </option>
			<option value='CHAD' >CHAD </option>
			<option value='HOOPER' >HOOPER </option>
			<option value='SOUTH' >SOUTH </option>
			<option value='MORGAN' >MORGAN </option>
			<option value='ROGERS' >ROGERS </option>
			<option value='GUSSY' >GUSSY </option>
			<option value='SKIP' >SKIP </option>
			<option value='STEVENS' >STEVENS </option>
			<option value='DOWDS' >DOWDS </option>
			<option value='HURLEY' >HURLEY </option>
			<option value='FITZ' >FITZ </option>
			<option value='PATERSON' >PATERSON </option>
			<option value='AFK' >AFK </option>
		 </select>
		 </div>
		</div>


<?php	
	

	// display this week's lines:
	$query = "SELECT `favteam` , `line`, `dogteam`, `homeTeam`, `gameID` FROM `Lines` WHERE week = $week ORDER by `gameID`";
	$result = mysql_query($query);

	//Create HTML Table for Lines
	echo "<div class='table-responsive table-condensed'>";
	echo "<table id ='lines' class='table table-striped'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Fav</th> <th class='numeric'>Line</th><th>Dog</th><th style='text-align:center'><a href =$pinnacle_url><i> Pinnacle </a><br \>Live Line</i></th>";
	echo "</thead>";
	echo "<tbody>";
	echo "<tr>";
	




	while( ($row = mysql_fetch_array($result)))
	{
		echo "<tr><td>";

//		if ($row['favteam'] === $row ['homeTeam']){echo "<b>";}
		echo '<div class="btn-group" data-toggle="buttons">';
		echo '<label class="btn btn-primary">';
		echo '<input type="radio"  data-toggle="button" name="pick'.$row['gameID'].'" value="'.$row['favteam'].'">';
		echo $row['favteam'];
		echo "</label>";

//		if ($row['homeTeam'] === $row ['favteam']){echo "</b>";}

		echo "</td><td>";

		echo '<label class="btn btn-secondary">';
		echo $row['line'];
		echo "</label>";

		echo "</td><td>";

//		if ($row['homeTeam'] === $row ['dogteam']){echo "<b>";}
		echo '<label class="btn btn-primary">';
		echo '<input type="radio" data-toggle="button" name="pick'.$row['gameID'].'" value="'.$row['dogteam'].'">';
		echo $row['dogteam'];
		echo "</label>";


//		if ($row['homeTeam'] === $row ['favteam']){echo "</b>";}
		echo "<br />";
//		echo '</td><td style="text-align:center">';
//		echo "<i>".$linesArray[$row['favteam']]."</i>"; //Pinnacle line
//		echo "</td></tr>";
		echo "</div>";

	}

	echo "</tbody></table>";
	echo "</div>";
?>	
	<input id="saveForm" class="btn btn-primary" type="submit" name="submit" value="Submit" />



</div>

</div>
</div>
	<?php
	// close DB connection
	mysql_close($con);

	?>
	
</body>
</html>

