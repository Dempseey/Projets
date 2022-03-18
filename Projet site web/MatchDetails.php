<?php session_start(); ?>
<?php include 'include/database.php'; ?>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/Main.css">
	<link rel="stylesheet" href="css/MatchDetails.css">
	<link rel="stylesheet" href="css/Arrow.css"> 
    <script src="js/notStarted.js"></script>
</head>
<?php  include 'include/Header.php'; ?>

<body>

    <div id="main">
        <div class="center">

            <div class="buttonDiv">
                <?php include 'include/showTableMatch.php' ?>
            </div>

            <div class="buttonDiv">
                <?php include 'include/showMatchOptions.php' ?>
            </div>

            <?php include 'include/wichButton.php' ?>

            <div class="buttonDiv"> 
				<input type="image" class="Arrow" src="css/img/Arrow.jpg" onclick="window.history.back()">
			</div>


        </div>
    </div>

</body>


</html>