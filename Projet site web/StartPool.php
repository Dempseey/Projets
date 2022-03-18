<?php session_start(); ?>
<html>
    <header>
        <?php include 'include/database.php'; ?>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/StartPool.css">
        <link rel="stylesheet" href="css/MainBig.css">
        <script src="js/GetPoolArray.js"></script>
        <script src="js/GenerateMatch.js"></script>
        <script src="js/GetMatchs.js"></script>
    </header>
    <?php  include 'include/Header.php'; ?>

    <body>
		<div id="main">
			<div class="center">
				<?php include 'include/GetTeamForArray.php'; ?>
				<h1> Here are the pools : </h1>

				<div id="def_pool"></div>

				<div class="buttonDiv"><button onclick="showbutton()">Get back</button></div>


				<div id="genbutton" class="buttonDiv">
					<br/><br/><br/>
					<button type="button" name="loadRandomMatch" id="loadRandomMatch" onclick="randomMatch()">Generate all the matches</button>
				</div>


				<div id="showmatch"></div>

				<form id="sendMatch" method="post">
					<div class="buttonDiv" id="subButton">
					<br/><br/>
					</div>

					<?php include 'include/SendMatch.php'?>
				</form>
			</div>
		</div>

    </body>
    <?php  include 'include/Footer.php'; ?>
</html>