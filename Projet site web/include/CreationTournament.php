<?php

    if(isset($_POST['formsend'])){ //test si le bouton a était appuyé
        extract($_POST); //Crée des variables en php (par exemple '$email') et les initialise aves les valeurs écrit par la personne qui remplit sont formulaire
        if(!empty($manager) && !empty($nameT) && !empty($tourneyType) && !empty($sport) && !empty($beginningDate) && !empty($endingDate) && !empty($NbTeams) && !empty($location)){
            if($beginningDate < $endingDate ){
                if($tourneyType == 1){
                    if($NbTeams == 16 || $NbTeams == 8 || $NbTeams == 4 || $NbTeams == 2){
                        $sql = "INSERT INTO tournament_t (manager,nameT,tourneyType,sport, beginningDate, endingDate, NbTeam, location, logT) VALUES ( ?, ?, ?,   ?, ?, ?, ?, ?, ?)";
                        $stmntinsert = $db->prepare($sql);
                        $result = $stmntinsert -> execute([$manager, $nameT, $tourneyType, $sport, $beginningDate, $endingDate, $NbTeams, $location,   $_SESSION['login']]);
                        header('Location: WaitingPage.php'); 
                    }else{
                        echo "<h2>The Team must be 2, 4, 8 or 16 !</h2>";
                    }
                }else{
                    $sql = "INSERT INTO tournament_t (manager,nameT,tourneyType,sport, beginningDate, endingDate, NbTeam, location, logT) VALUES ( ?, ?, ?,   ?, ?, ?, ?, ?, ?)";
                        $stmntinsert = $db->prepare($sql);
                        $result = $stmntinsert -> execute([$manager, $nameT, $tourneyType, $sport, $beginningDate, $endingDate, $NbTeams, $location,   $_SESSION['login']]);
                        header('Location: WaitingPage.php'); 
                }
                
                
            }else{
                echo "<h2>The dates indicated are not correct ! </h2>";
            }
        }
    }
?>
