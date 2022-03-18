<!-- php  include 'include/Header.php'  --> <!-- A FAIRE APRES -->
<?php session_start(); ?>
<?php
include 'include/database.php';
global $db;
?>

<head>
    <meta charset="utf-8" />
    <link href ="css/Pools.css" rel="stylesheet">
    <link href ="css/Main.css" rel="stylesheet">
</head>
<body>
    
    <?php  include 'include/Header.php'; ?>
    <div id="main">
        <?php include "include/Arrow2.php"?><br/>
        <div class="center">
            <h1>Manage the tournament</h1>
            
            <h3 id="color"> My tournament : <u><?php include 'include/DisplayTourney.php' ?></u> </h3>

            <p id="color">You have <strong><?php include 'include/NumberTeamPool.php' ?></strong> teams present
            in your tournament, you can therefore make up to <strong><?php echo $nbPoulesAuto; ?></strong> pools. </p>

            <label id="color" for="nbPls">Please choose the number of pools you want :</label>
        
            <form method="get" action="PoolConfirm.php">
                <select name="nbPls" id="nbPls">
            <?php include 'include/DisplayNumberPool.php'; ?>
                </select>
            <input type="hidden" name="tourneyId" value="<?php echo $tourneyId ?>">
            <input type="hidden" name="nbEq" value="<?php echo $nbEquipes ?>">
                <button id="sub_pool" name="sub_pool" type="submit">Confirm</button>
            </form>
            <br/><br/>
        </div>
    </div>
    
    <?php  include 'include/Footer.php'; ?>  <!-- Inclut le FOOTER -->
    
</body>


