<?php session_start(); ?>
<?php  include 'include/Header.php'; ?>  
<?php include 'include/database.php';
global $db;?>

<link rel="stylesheet" type="text/css" href = "css/TeamDisplay.css">
<link rel="stylesheet" type="text/css" href = "css/MainBig.css">
<link href ="bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" rel="stylesheet">


<div id="main">
    <?php include "include/Arrow2.php"?>
    <div class="center">
        
        <?php
        

        $ID = $_GET['tourneyId'];
        
        $a = $db->prepare("SELECT * FROM team_t WHERE tourneyId = :tourneyId ORDER BY teamId DESC");
        $a->execute(['tourneyId'=> $ID ]);
        $result = $a->fetch();
        $TeamId = $result['teamId'];
        
        $b = $db->prepare("SELECT * FROM tournament_t WHERE tourneyId = :tourneyId");
        $b->execute(['tourneyId'=> $ID ]);
        $result2 = $b->fetch();
        $NbTeams = $result2['NbTeam'];
        
        $c = $db->prepare("SELECT * FROM team_t WHERE tourneyId = :tourneyId AND validation = :validation");
        $c->execute(['tourneyId'=> $ID, 'validation'=>1 ]);
        $NbTeamsValide = $c->rowCount();
        
        echo "<h1 id=color>Teams registered <span class=Number>$NbTeamsValide/$NbTeams<span> </h1>";
        $Progress = (($NbTeamsValide/$NbTeams)*100);
        include "include/Progress.php";
        echo "</br>";
        
        if($NbTeams == $NbTeamsValide){
            echo "<h2 id=danger>Number of teams reached</h2>";
            echo "</br>";
            $e = $db->prepare("UPDATE tournament_t SET stateT = '1' WHERE tourneyId = $ID");
            $e->execute();
            
            
            for($result; $TeamId != 0; $TeamId = $TeamId - 1 ){

                $ID = $_GET['tourneyId'];
                $a = $db->prepare("SELECT * FROM team_t WHERE tourneyId = :tourneyId AND teamId = :teamId ORDER BY teamId DESC");
                $a->execute(['tourneyId'=> $ID,'teamId'=>$TeamId ]);
                $result = $a->fetch();

                if($result){

                    $IdTeam = $result['teamId'];
                    $Name = $result['teamName'];
                    $Validation = $result['validation'];
                    echo "<p>$Name &nbsp</p>";
                    if($Validation == 0){
                        include "include/DetailTeam.php";
                    }
                    else{
                        include "include/CancelTeam.php";
                        include"include/DetailTeam.php";
                    }

                }
            }
            
        }else{
            
            $e = $db->prepare("UPDATE tournament_t SET stateT = '0' WHERE tourneyId = $ID");
            $e->execute();
            
            for($result; $TeamId != 0; $TeamId = $TeamId - 1 ){

                $ID = $_GET['tourneyId'];
                $a = $db->prepare("SELECT * FROM team_t WHERE tourneyId = :tourneyId AND teamId = :teamId ORDER BY teamId DESC");
                $a->execute(['tourneyId'=> $ID,'teamId'=>$TeamId ]);
                $result = $a->fetch();

                if($result){

                    $IdTeam = $result['teamId'];
                    $Name = $result['teamName'];
                    $Validation = $result['validation'];
                    echo "<p>$Name &nbsp</p>";
                    if($Validation == 0){
                        include "include/TeamValidation.php";
                        include "include/DetailTeam.php";
                    }
                    else{
                        include "include/CancelTeam.php";
                        include"include/DetailTeam.php";
                    }

                }
            }
        }

            
        ?>

    </div>
</div>
        
<?php  include 'include/Footer.php'; ?>