<?php

$a = $db->prepare("SELECT * FROM team_t WHERE IdProfile = :IdProfile AND tourneyId = :tourneyId"); 
$a->execute(['IdProfile'=> $_SESSION['login'],'tourneyId' => $ID]);
$NombreTournoi = $a->rowCount();
if($NombreTournoi == 0){
    include'PreRegistrationButton.php';
}else{
    include'UnsubscribeButton.php';
}

?>

<?php
    

    $Valider = "Inscription$ID";
    
    if(isset($_POST[$Valider])){
        header('Location: TeamRegistration.php?tourneyId='.$ID.'');
        //Mettre le lien vers l'inscription
    }

    $Annuler = "Desinscription$ID";
    
    if(isset($_POST[$Annuler])){
        $g = $db->prepare("DELETE FROM team_t WHERE IdProfile = :IdProfile AND tourneyId = :tourneyId"); 
        $g->execute(['IdProfile'=> $_SESSION['login'],'tourneyId' => $ID]);
        header('Location: WaitingPage.php');
        //Mettre le lien vers l'inscription
    }
?>