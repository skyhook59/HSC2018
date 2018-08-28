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
<script type="text/javascript" src="/select-togglebutton.js"></script>
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
	<ul class="nav nav-tabs"  data-tabs="tabs" >
	  <li class="active"><a data-toggle="tab" href="#picks">Picks</a></li>
	  <li><a data-toggle="tab" href="#lines">Lines</a></li>
	  <li><a  href="../">Menu</a></li>
	</ul>
<div class="tab-content">	
<div class="tab-pane" id="lines">	
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


//Create HTML Table for Lines
	echo "<div class='table-responsive table-condensed'>";
	echo "<table id ='lines' class='table table-striped'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Fav</th> <th class='numeric'>Line</th><th>Dog</th>";
	echo "</thead>";
	echo "<tbody>";
	echo "<tr>";
	
	// display this week's lines:
	$query = "SELECT `favteam` , `line`, `dogteam`, `homeTeam`  FROM `Lines` WHERE week = $week ORDER by `gameID`";
	$result = mysql_query($query);

	while( ($row = mysql_fetch_array($result)))
	{
		echo "<tr><td>";
		if ($row['favteam'] === $row ['homeTeam']){echo "<b>";}
		echo $row['favteam'];
		if ($row['homeTeam'] === $row ['favteam']){echo "</b>";}
		echo "</td><td>";
		echo $row['line'];
		echo "</td><td>";
		if ($row['homeTeam'] === $row ['dogteam']){echo "<b>";}
		echo $row['dogteam'];
		if ($row['homeTeam'] === $row ['favteam']){echo "</b>";}
		echo "</td><td></tr>";
	}

	echo"</tbody></table></div>";
	

?>
</div>
<div class="tab-pane active" id="picks">
<script>
$(function() {
    $('input').focusout(function() {
        // Uppercase-ize contents
        this.value = this.value.toLocaleUpperCase();
    });
});;
</script>
<?php 
//TODO: Put week # into a file and run a cronjob to update nightly?
//TODO: Add check for # of entries for that users 
  // $sql=SELECT count(*) FROM Picks WHERE username=$username AND week=$week
  // if $sql > 1 You already submitted your picks, else show the form.
?>
	<form class="horizontal-form" role="form" data-validate="parsley" method="post" action="Submitform.php">

			<h2>Picks for Week <?php echo $week; ?> </h2>
			<p>Please enter the 2 or 3 letter code for your picks.</p>

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
		 </select>
		 </div>
		</div>
		  <div class="form-group">
		   <div class="control-group">
		   <label class="col-sm-2 control-label" for="pick1">Pick 1 </label>
		   <input id="pick1" name="pick1" class="input-mini" type="text" maxlength="3" value="" data-trigger="focusin focusout"  data-minlength="1" data-required="true" style="text-transform: uppercase" data-inlist="DEN, NE, PIT, NO, TB, KC, CHI, CLE, SEA, DET, IND, STL, SF, DAL, WAS, HOU, BAL, BUF, TEN, ATL, NYJ, JAX, CIN, MIA, CAR, MIN, OAK, ARI, GB, NYG, PHI, SD"/> 
	   	   </div>
	      </div>
		   
		  <div class="form-group">
		   <div class="control-group">		   
		   <label class="col-sm-2 control-label" for="pick2">Pick 2 </label>
		   <input id="pick2" name="pick2" class="input-mini" type="text" maxlength="3" value="" data-trigger="focusin focusout" data-minlength="1" data-required="true" style="text-transform: uppercase" data-inlist="DEN, NE, PIT, NO, TB, KC, CHI, CLE, SEA, DET, IND, STL, SF, DAL, WAS, HOU, BAL, BUF, TEN, ATL, NYJ, JAX, CIN, MIA, CAR, MIN, OAK, ARI, GB, NYG, PHI, SD"/> 
		   </div>
	      </div>
		  
		  <div class="form-group"> 
		   <div class="control-group">
		   <label class="col-sm-2 control-label" for="pick3">Pick 3 </label>
		   <input id="pick3" name="pick3" class="input-mini" type="text" maxlength="3" value="" data-trigger="focusin focusout" data-minlength="1" data-required="true" style="text-transform: uppercase" data-inlist="DEN, NE, PIT, NO, TB, KC, CHI, CLE, SEA, DET, IND, STL, SF, DAL, WAS, HOU, BAL, BUF, TEN, ATL, NYJ, JAX, CIN, MIA, CAR, MIN, OAK, ARI, GB, NYG, PHI, SD"/> 
	   	   </div>
	      </div>
		  
		  <div class="form-group"> 
		   <div class="control-group">
		   <label class="col-sm-2 control-label" for="pick4">Pick 4 </label>
		   <input id="pick4" name="pick4" class="input-mini" type="text" maxlength="3" value="" data-trigger="focusin focusout" data-minlength="1" data-required="true" style="text-transform: uppercase" data-inlist="DEN, NE, PIT, NO, TB, KC, CHI, CLE, SEA, DET, IND, STL, SF, DAL, WAS, HOU, BAL, BUF, TEN, ATL, NYJ, JAX, CIN, MIA, CAR, MIN, OAK, ARI, GB, NYG, PHI, SD"/> 
 		   </div>
		  </div>
		  
		  <div class="form-group">  
		   <div class="control-group">
		   <label class="col-sm-2 control-label" for="pick5">Pick 5 </label>
		   <input id="pick5" name="pick5" class="input-mini" type="text" maxlength="3" value="" data-trigger="focusin focusout" data-minlength="1" data-required="true" style="text-transform: uppercase" data-inlist="DEN, NE, PIT, NO, TB, KC, CHI, CLE, SEA, DET, IND, STL, SF, DAL, WAS, HOU, BAL, BUF, TEN, ATL, NYJ, JAX, CIN, MIA, CAR, MIN, OAK, ARI, GB, NYG, PHI, SD"/> 
	   	   </div>
		  </div>
		   
		   <div class="form-group">
		   <input id="saveForm" class="btn btn-primary" type="submit" name="submit" value="Submit" />
	   	   </div>
		</form>	
	</div>	
</div>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('#tabs').tab();
    });
</script>   
</div>
	<?php
	// close DB connection
	mysql_close($con);

	?>
	
</body>
</html>

