<?php session_start(); ?>
<?php include 'include/database.php'; ?>
<html>
<?php  include 'include/Header.php'; ?>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/SeePoolTournament.css">
	<link rel="stylesheet" href="css/MainBig.css">

    <script src="js/DisplayDefPools.js"></script>
    <script src="js/PlaceMatch.js"></script>
    <script src="js/UpdatePoolScore.js"></script>
    
    
</head>


<div id="cptM"><?php include 'include/GetAllTeamForSee2.php' ?></div>
<div id="sc"><?php include 'include/GetScores.php' ?></div>


<body>
    <div id="main">
			
			<div class="rightside">
				<h1>Here are all the pools</h1>
				<div id="def_pool"></div>

				<div class="buttonDiv">
					<h2>Scores are updated after each match</h2>
				</div>
			</div>
        
			
			
			<div class="leftside">
				<h1>Here are all the matchs</h1>
				<p>Click on one to see their details !</p>

				<div id="showmatch">
					<div id="notStarted" style="clear : both">
						<h3> Not started matches : </h3>
					</div>

					<br/><br/>

					<div id="started" style="clear : both">
						<h3> Matches in course : </h3>
					</div>

					<br/><br/>

					<div id="onWait" style="clear : both">
						<h3> Matches waiting for winner :</h3>
					</div>

					<br/><br/>

					<div id="done" style="clear : both">
						<h3> Finished matches :</h3>
					</div>

					<br/><br/>
				</div>
			</div>
			
	</div>
</body>
    <?php  include 'include/Footer.php'; ?>  <!-- Inclut le FOOTER -->

</html>