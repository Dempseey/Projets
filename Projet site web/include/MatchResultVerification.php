<?php 

     
    if(isset($_POST['formresult'])){ //test si le bouton a était appuyé
        
        extract($_POST); //Crée des variables en php
        
        if($scoreTeam1 != $scoreTeam2){ //test si les scores sont différents
            
            $q = $db->prepare("INSERT INTO match_t (scoreTeam1,scoreTeam2,winner) VALUES(:scoreTeam1,:scoreTeam2,:winner)");
            $q->execute([
                'scoreTeam1'=> $scoreTeam1,
                'scoreTeam2'=> $scoreTeam2,
                'winner'=>$winner
                ]);
        } else{
            echo "Scores must be different";
        }
    }
?>
