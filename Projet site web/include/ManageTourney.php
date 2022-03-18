<form method="post">
    <input type="submit" id="Voir" name="<?php echo "Voir$ID"; ?>"  value="Manage the Tournament">
</form>

<?php

		$w = $db->prepare("SELECT * FROM match_t  WHERE tourneyId = :tourneyId");
        $w->execute(['tourneyId'=>$ID]);
        $ww = $w->rowCount();

        $y = $db->prepare("SELECT * FROM tournament_t  WHERE tourneyId = :tourneyId");
        $y->execute(['tourneyId'=>$ID]);
        $yy = $y->fetch();

    $Voir = "Voir$ID";
    if(isset($_POST[$Voir])){
		if($ww > 0 && $TT == 2){
			header('Location: SeePoolTournament.php?tourneyId='.$ID.'&nbPls='.$NbPls.'&nbEq='.$NbTeam.'');
		}
		if($ww > 0 && $TT == 1){
			header('Location: Bracket'.$NbTeam.'.php?tourneyId='.$ID.'&bracketR='.$yy['bracketR'].'');
		}
    }
?>