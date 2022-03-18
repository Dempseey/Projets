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

<?php include 'include/checkTwoP.php' ?>


<body>

    <div id="main">
        <div class="center">

            <div class="buttonDiv">
                <?php include 'include/showTableMatchB.php' ?>
            </div>

            <div class="buttonDiv">
                <?php include 'include/showMatchOptionsB.php' ?>
            </div>

            <?php include 'include/wichButtonB.php' ?>

            <div class="buttonDiv"> 
				<input type="image" class="Arrow" src="css/img/Arrow.jpg" onclick="window.history.back()">
			</div>


        </div>
    </div>

</body>


</html>