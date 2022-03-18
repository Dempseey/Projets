<form method="post">
    <input type="submit" id="Voir" name="<?php echo "Voir$ID"; ?>"  value="Manage the Tournament">
    <input type="submit" id="Ouvrir" name="<?php echo "Ouvrir$ID"; ?>"  value="Open Registrations">
    <input type="submit" id="Equipe" name="<?php echo "Equipe$ID"; ?>"  value="Pre-registered teams">
</form>

<?php
    $Voir = "Voir$ID";
    if(isset($_POST[$Voir])){
        if($TT == 2){
            header('Location: Pools.php?tourneyId='.$ID.'&bracketR=0'); //Mettre le lien du Tournoi en récupérant son ID
        }else{if($NumberTeam == 16){
            header('Location: Bracket16.php?tourneyId='.$ID.'&bracketR=0');
        }
        if($NumberTeam == 8){
            header('Location: Bracket8.php?tourneyId='.$ID.'&bracketR=0');
        }
        if($NumberTeam == 4){
            header('Location: Bracket4.php?tourneyId='.$ID.'&bracketR=0');
        }
             }
    }

    $Ouvrir = "Ouvrir$ID";
    if(isset($_POST[$Ouvrir])){
        $b = $db->prepare("UPDATE tournament_t SET stateT = '0' WHERE tourneyId = $ID");
        $b->execute();
        $delai = 0.3; 
        $url = 'ManageTournament.php';
        header("Refresh: $delai;url=$url");
        //Mettre etat 0 à 1
    }
    
    $Equipe = "Equipe$ID";
    if(isset($_POST[$Equipe])){
        header('Location: TeamDisplay.php?tourneyId='.$ID.'');
    }

?>
