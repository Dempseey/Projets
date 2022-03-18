<?php session_start(); ?>

<?php  include 'include/Header.php'; ?> 

<?php
include 'include/database.php';
global $db;

$d = $db->prepare("SELECT * FROM tournament_t WHERE stateT = :stateT ORDER BY tourneyId DESC"); //Crée un fetch avec les informations de l'utilisateur
                    $d->execute(['stateT'=> 0]);
                    $tournoiouvert = $d->fetch();
                    $tournoiID = $tournoiouvert['tourneyId'];

?>

<link rel="stylesheet" type="text/css" href = "css/TournamentRegistration.css">
<link rel="stylesheet" type="text/css" href = "css/Main.css">
<meta charset="utf-8" />


<div id="main">
    <?php include "include/Arrow.php"?>
    <div class="center">

            <?php

                    

                    if(($tournoiouvert)){
                        for($tournoiouvert; $tournoiID != 0; $tournoiID = $tournoiID - 1 ){

                            $c = $db->prepare("SELECT * FROM tournament_t WHERE tourneyId = :tourneyId AND stateT = :stateT ORDER BY tourneyId DESC"); //Crée un fetch avec les informations de l'utilisateur
                            $c->execute(['tourneyId'=> $tournoiID,'stateT'=>0]);
                            $tournoiouvert2 = $c->fetch();

                            if($tournoiouvert2){
                                $ID = $tournoiouvert2['tourneyId'];
                                echo "<div class=tourney><div class=PlaceImage style=background-image:url(css/img/$tournoiouvert2[sport].jpg)></div>";
                                echo "<p>$tournoiouvert2[nameT] ";
                                echo "is a ";
                                echo "$tournoiouvert2[sport] ";
                                echo " tournament organized by ";
                                echo "$tournoiouvert2[manager] ";
                                echo "from "; echo "$tournoiouvert2[beginningDate] "; 
                                echo "to "; echo "$tournoiouvert2[endingDate] "; 
                                echo "in ";
                                echo "$tournoiouvert2[location] </p>";
                                include 'include/RegistrationTournamentPlayer.php';
                                echo "<br />";
                                echo "<br />";
                            }

                        } 

                    }else{
                        echo "No Tournament currently open";
                    }
                    ?>
        
    </div>
</div>
</div>
<?php  include 'include/Footer.php'; ?>

