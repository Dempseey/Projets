<?php session_start(); ?>

<?php  include 'include/Header.php'; ?> 

<?php
include 'include/database.php';
global $db;

$d = $db->prepare("SELECT * FROM tournament_t ORDER BY tourneyId DESC"); //Crée un fetch avec les informations de l'utilisateur
$d->execute([]);
$tournoiouvert = $d->fetch();
$tournoiID = $tournoiouvert['tourneyId'];
?>

<link rel="stylesheet" type="text/css" href = "css/CurrentTournament.css">
<link rel="stylesheet" type="text/css" href = "css/Main.css">


<div id="main">
    <?php include "include/Arrow.php"?>
    <div class="center">

            <?php
            if(($tournoiouvert)){
                for($tournoiouvert; $tournoiID != 0; $tournoiID = $tournoiID - 1 ){

                    $c = $db->prepare("SELECT * FROM tournament_t WHERE tourneyId = :tourneyId AND stateT > 1 AND stateT < 4 ORDER BY tourneyId DESC"); //Crée un fetch avec les informations de l'utilisateur
                    $c->execute(['tourneyId'=> $tournoiID]);
                    $tournoiouvert2 = $c->fetch();
                    $NbTeam = $tournoiouvert2['NbTeam'];
                    $ID = $tournoiouvert2['tourneyId'];

                    if($tournoiouvert2){

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
                        include 'include/SeeTourney.php';
                        echo "</div>";
                    }

                }



            }else{
                echo "No Tournament currently open";
            }
            ?>
    </div>
</div>

<?php  include 'include/Footer.php'; ?>