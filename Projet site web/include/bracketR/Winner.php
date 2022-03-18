<?php

    $w = $db->prepare("SELECT * FROM team_t  WHERE tourneyId = :tourneyId AND bracket = :bracket");
    $w->execute(['tourneyId'=>$ID,'bracket' => 1]);
    $result2 = $w->rowCount();
    

if($result2 == 16){
    $y = $db->prepare("SELECT * FROM match_t  WHERE tourneyId = :tourneyId AND bracketM = :bracketM");
    $y->execute(['tourneyId'=> $ID,'bracketM' => 4]);
    $test = $y->fetch();
    $Winner = $test['winner'];
    if(isset($Winner)){
        $a = $db->prepare("UPDATE tournament_t SET stateT = '4' WHERE tourneyId = $ID");
        $a->execute();
        //Passer l'état à 4, animation de victoire
    }
}

if($result2 == 8){
    $y = $db->prepare("SELECT * FROM match_t  WHERE tourneyId = :tourneyId AND bracketM = :bracketM");
    $y->execute(['tourneyId'=> $ID,'bracketM' => 3]);
    $test = $y->fetch();
    $Winner = $test['winner'];
    if(isset($Winner)){
        $a = $db->prepare("UPDATE tournament_t SET stateT = '4' WHERE tourneyId = $ID");
        $a->execute();
        //Passer l'état à 4, animation de victoire
    }
}

if($result2 == 4){
    $y = $db->prepare("SELECT * FROM match_t  WHERE tourneyId = :tourneyId AND bracketM = :bracketM");
    $y->execute(['tourneyId'=> $ID,'bracketM' => 2]);
    $test = $y->fetch();
    $Winner = $test['winner'];
    if(isset($Winner)){
        $a = $db->prepare("UPDATE tournament_t SET stateT = '4' WHERE tourneyId = $ID");
        $a->execute();
        //Passer l'état à 4, animation de victoire
    }
}

if($result2 == 2){
    $y = $db->prepare("SELECT * FROM match_t  WHERE tourneyId = :tourneyId AND bracketM = :bracketM");
    $y->execute(['tourneyId'=> $ID,'bracketM' => 1]);
    $test = $y->fetch();
    $Winner = $test['winner'];
    if(isset($Winner)){
        $a = $db->prepare("UPDATE tournament_t SET stateT = '4' WHERE tourneyId = $ID");
        $a->execute();
        //Passer l'état à 4, animation de victoire
    }
}

?>