<?php session_start(); ?>
<?php include 'include/database.php'; ?>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/PoolConfirm.css">
    <link href ="css/Main.css" rel="stylesheet">

    <script src="js/DisplayPools.js"></script>
    <script src="js/DrawPools.js"></script>
    <script src="js/DragAndDrop.js"></script>
    <script src="js/GetBackTeam.js"></script>
    <script src="js/PoolConfirm.js"></script>
    
    
</head>
<?php  include 'include/Header.php'; ?>

<body onload="affpoules()">
    
    <div id="main">
        <div class="center">

            <h3 id="color"> You have selected <?php echo $_GET['nbPls']; ?> pools </h3>
            <p id="color"> To go back, click here : <button onclick="window.location ='ManageTournament.php'"> Change my choice </button> </p>

            <p id="color"> To make a random draw, click here : <button onclick="tirage();">Random selection</button> </p>
            <p id="color"> To make a level draw, click here : <button onclick="level();">Level selection</button> </p>
            <p id="color"> Otherwise you can drag each teams into the pool you want using your computer mouse </p><br/>
            <h3 id="color">List of teams : </h3>
            <button onclick="goBack()">Bring all the teams back</button>
            <div id="backTeam" class="getBackTeam" ondragover="onDragOver(event)" ondrop="onDropBack(event)">
                <?php include 'include/GetAllTeam.php' ?>
            </div><br/>

            <div id="add_poules"></div>

            <div class="buttonDiv">
                <br/><br/>
                <button onclick="conf_pool()">Confirm my choices </button>
                <br/><br/>
            </div>

        </div>
    </div>
    
    <?php  include 'include/Footer.php'; ?>  <!-- Inclut le FOOTER -->

</body>



</html>








