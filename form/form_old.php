<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>This Week's Picks</title>
<!--
  <link rel="stylesheet" type="text/css" href="view.css" media="all">
  <script type="text/javascript" src="view.js"></script>
  -->
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/parsley.js/1.1.16/parsley.extend.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/parsley.js/1.1.16/parsley.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/css/bootstrap.min.css">
<link href="http://getbootstrap.com/2.3.2/assets/css/bootstrap-responsive.css" rel="stylesheet">
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
<style type="text/css">
             input.parsley-success
            {
              color: #468847 !important;
              background-color: #DFF0D8 !important;
              border: 1px solid #D6E9C6 !important;
            }
            input
            {
                width: 150px;
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
        </style>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body id="main_body" >

<pre>
Fav	Line	Dog
PHI	-3.5	KC
TEN	-3	SD
MIN	-5.5	CLE
NE	-7	TB
HOU	-2.5	BAL
DAL	-4	STL
NO	-7	ARI
WAS	-2	DET
GB	-2.5	CIN
CAR	-1	NYG
MIA	-2.5	ATL
SF	-10	IND
SEA	-19	JAX
NYJ	-2.5	BUF
CHI	-2.5	PIT
DEN	-15	OAK
</pre>

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
	<form class="form-horizontal" data-validate="parsley" method="post" action="Submitform.php">

			<h2>Picks for Week 3 </h2>
			<p>Please enter the 2 or 3 letter code for your picks.</p>
	<div class="control-group">
	<div class="control-label">					

<!-- 		   <label class="control-label" for="username">Username: </label>
		   <input id="username" name="username" class="controls" type="text" maxlength="20" value="" data-minlength="2" data-trigger="focusin focusout" data-required="true" /> 
 -->
 		<label class="description form-inline" for="username">Username </label>
		<select class="controls input-small" id="username" name="username"> 

			<option value='' selected='selected'></option>
			<option value='MCPHEE' >MCPHEE </option>
			<option value='MCCOURT' >MCCOURT </option>
			<option value='DINO' >DINO </option>
			<option value='GRAMMA' >GRAMMA </option>
			<option value='GORD' >GORD </option>
			<option value='CHAD' >CHAD </option>
			<option value='HOOPER' >HOOPER </option>
			<option value='SOUTH' >SOUTH </option>
			<option value='PATRSON' >PATERSON </option>
			<option value='MORGAN' >MORGAN </option>
			<option value='ROGERS' >ROGERS </option>
			<option value='GUSSY' >GUSSY </option>
			<option value='SKIP' >SKIP </option>
			<option value='STEVENS' >STEVENS </option>
			<option value='DOWDS' >DOWDS </option>
			<option value='HURLEY' >HURLEY </option>
			<option value='MEAT' >MEAT </option>
			<option value='LONN' >LONN </option>
			<option value='FITZ' >FITZ </option>
		</select>

		   <label for="pick1">Pick 1 </label>
		   <input id="pick1" name="pick1" class="controls input-small" type="text" maxlength="3" value="" data-trigger="focusin focusout" data-minlength="1" data-required="true" style="text-transform: uppercase" data-inlist="DEN, NE, PIT, NO, TB, KC, CHI, CLE, SEA, DET, IND, STL, SF, DAL, WAS, HOU, BAL, BUF, TEN, ATL, NYJ, JAX, CIN, MIA, CAR, MIN, OAK, ARI, GB, NYG, PHI, SD"/> 
		   <label class="description" for="pick2">Pick 2 </label>
		   <input id="pick2" name="pick2" class="controls input-small" type="text" maxlength="3" value="" data-trigger="focusin focusout" data-minlength="1" data-required="true" style="text-transform: uppercase" data-inlist="DEN, NE, PIT, NO, TB, KC, CHI, CLE, SEA, DET, IND, STL, SF, DAL, WAS, HOU, BAL, BUF, TEN, ATL, NYJ, JAX, CIN, MIA, CAR, MIN, OAK, ARI, GB, NYG, PHI, SD"/> 
		   <label class="description" for="pick3">Pick 3 </label>
		   <input id="pick3" name="pick3" class="controls input-small" type="text" maxlength="3" value="" data-trigger="focusin focusout" data-minlength="1" data-required="true" style="text-transform: uppercase" data-inlist="DEN, NE, PIT, NO, TB, KC, CHI, CLE, SEA, DET, IND, STL, SF, DAL, WAS, HOU, BAL, BUF, TEN, ATL, NYJ, JAX, CIN, MIA, CAR, MIN, OAK, ARI, GB, NYG, PHI, SD"/> 
		   <label class="description" for="pick4">Pick 4 </label>
		   <input id="pick4" name="pick4" class="controls input-small" type="text" maxlength="3" value="" data-trigger="focusin focusout" data-minlength="1" data-required="true" style="text-transform: uppercase" data-inlist="DEN, NE, PIT, NO, TB, KC, CHI, CLE, SEA, DET, IND, STL, SF, DAL, WAS, HOU, BAL, BUF, TEN, ATL, NYJ, JAX, CIN, MIA, CAR, MIN, OAK, ARI, GB, NYG, PHI, SD"/> 
 		   <label class="description" for="pick5">Pick 5 </label>
		   <input id="pick5" name="pick5" class="controls input-small" type="text" maxlength="3" value="" data-trigger="focusin focusout" data-minlength="1" data-required="true" style="text-transform: uppercase" data-inlist="DEN, NE, PIT, NO, TB, KC, CHI, CLE, SEA, DET, IND, STL, SF, DAL, WAS, HOU, BAL, BUF, TEN, ATL, NYJ, JAX, CIN, MIA, CAR, MIN, OAK, ARI, GB, NYG, PHI, SD"/> 


		    <input id="saveForm" class="btn btn-primary" type="submit" name="submit" value="Submit" />
		</form>	
	</div>	
	</div>
	
</body>
</html>
