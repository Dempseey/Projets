<?php session_start(); ?>
<?php
include ('include/database.php');
?>
<!DOCTYPE html>
<head>
    <title>Bracket</title>
    <link rel="stylesheet" type="text/css" href = "css/Bracket.css">
    <link rel="stylesheet" type="text/css" href = "css/Main.css">
    <meta charset="utf-8" />
    
    <script src="js/DragAndDrop2.js"></script>
    <script src="js/GetStartTeam.js"></script>
    <script src="js/PlaceBracketMatch.js"></script>
    
</head>

<?php  $ID = $_GET['tourneyId']; ?>
<?php $round = $_GET['bracketR'] ?>

<?php  include 'include/Header.php'; ?>
<?php include 'include/BracketTeam.php'?>
<?php include 'include/confirm_b.php' ?>


<body>
    <div id="temp_allT"><?php include 'include/bracketR/getAllTeam.php' ?></div>
    <div id="temp_allS"><?php include 'include/bracketR/getAllScore.php' ?></div>


    <div id="main">
        <?php include "include/Arrow2.php"?>
            <div class="center">
                <article id="container">
                    <section>
                        <?php include 'include/bracketR/eight.php' ?>
                    </section>
                    
                    <div class="connecter">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    
                    <div class="line">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    
                    
                    <section id="quarterFinals">
                        <div id="2_match1_1"><span id="s_2_match1_1" class="score"></span></div>
                        <div id="2_match1_2"><span id="s_2_match1_2" class="score"></span></div>
                        <div id="2_match2_1"><span id="s_2_match2_1" class="score"></span></div>
                        <div id="2_match2_2"><span id="s_2_match2_2" class="score"></span></div>
                    </section>

                    <div class="connecter" id="conn2">
                        <div></div>
                        <div></div>
                    </div>

                    <div class="line" id="line2">
                        <div></div>
                        <div></div>
                    </div>
                    
                    <section id="semiFinals">
                        <div id="3_match1_1"><span id="s_3_match1_1" class="score"></span></div>
                        <div id="3_match1_2"><span id="s_3_match1_2" class="score"></span></div>
                    </section>

                    <div class="connecter" id="conn3">
                        <div></div>
                    </div>

                    <div class="line" id="line3">
                        <div></div>
                    </div>

                    <section id="final">
                        <div id="4_match1_1"><span id="s_4_match1_1" class="score"></span></div>
                    </section>
                </article>       
                
                <div class="rightside">
                    <?php include 'include/bracketR/allTeam.php' ?>
                    <?php include 'include/bracketR/Winner.php' ?>
                </div>
        </div>
    </div>
        
</body>
                    
                    <?php  include 'include/Footer.php'; ?>
