<!DOCTYPE html>
<html lang="en">
<head>
  <title>Stats for <?php $username = $_GET['username']; echo $username; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="../fusioncharts/js/fusioncharts.js"></script>
  <script src="../fusioncharts/js/themes/fusioncharts.theme.fint.js"></script>  
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 700px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    
    .current_rank { text-align: center; }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;}
    }
  </style>

	<?php   
		//	$username = strtoupper($username);
	  		require("../fusioncharts/fusioncharts.php");
			require("winsbyweek-chart.php"); 
			require("dogfavmix-chart.php");
			require("homevisitmix-chart.php");
			require("commonpicks-chart.php");		
			require("ATSWinners-chart.php");		
			require("rank.php")				
	?>

</head>
<body>

<nav class="navbar navbar-inverse visible-xs">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">HSC Stats</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Dashboard</a></li>
        <li><a href="http://hsc.mcph.ee/HSC2016/">Home</a></li>
        <li><a href="#top"><? echo $username; ?>'s Stats</a></li>
        <li><a href="#League">HSC Stats</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
 <div class="row content">
   <div class="col-sm-3 sidenav hidden-xs">
      <h2>HSC Stats</h2>
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#">Dashboard</a></li>
        <li><a href="http://hsc.mcph.ee/HSC2016/">Home</a></li>
        <li><a href="#top"><? echo $username; ?>'s Stats</a></li>
        <li><a href="#League">HSC Stats</a></li>
      </ul><br>
   </div>
    <a name="top"></a>
    <br>
	<div class="col-sm-9"> 
       <div class="well">
        <h4>Wins By Week</h4>
        <p><div id="winschartbyweek"><!-- Fusion Charts will render here--></div></p>
      </div>
      <div class="row">
      <div class="col-sm-3">
        <div class="well">
            <div class="current_rank">
            <h4>Current League Rank</h4>
            <p><h1><? echo $rank ?></h1></p><br/>
            <h4>Current Record</h4>            
            <h3><? echo "$num_wins - $num_losses - $num_ties ";?></h3></div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="well">
            <h4>Fav/Dog Pick Mix</h4>
            <p><div id="chart-2"><!-- Fusion Charts will render here--></div></p>
            <i>How often you pick Favorites vs. Dogs</i>
	    </div>
       </div>
       <div class="col-sm-4">
         <div class="well">
            <h4>Home/Away Mix</h4>
            <p><div id="chart-3"><!-- Fusion Charts will render here--></div></p></p>
            <i> How often you pick Home Teams</i>
         </div>
        </div>
      </div>    
      <div class="row">
      <div class="well">
        <h4>Teams Picked Most Often By <? echo"$username"; ?></h4>
        <p><div id="commonpicks"><!-- Fusion Charts will render here--></div></p>
      </div>
      <a name="League"></a>
      <div class="well">
        <h4>Best Teams Against the Spread</h4>
        <p><div id="ATSWinners"><!-- Fusion Charts will render here--></div></p>
      </div>
    </div>
    </div>
<!--
    <div class="row">
        <div class="col-sm-4">
          <div class="well">
            <p>Text</p>
            <p>Text</p>
            <p>Text</p>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <p>Text</p>
            <p>Text</p>
            <p>Text</p>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <p>Text</p>
            <p>Text</p>
            <p>Text</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8">
          <div class="well">
            <p>Text</p>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <p>Text</p>
          </div>
        </div>
      </div>
    </div>
-->
</div>
</div>

</body>
</html>

