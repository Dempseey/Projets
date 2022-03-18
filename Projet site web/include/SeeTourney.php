<form method="post">
<input type="submit" id="Voir" name="<?php echo "Voir$tournoiouvert2[tourneyId]"; ?>"  value="See the Tournament">
</form>

<?php



    $Voir = "Voir$tournoiouvert2[tourneyId]";
    if(isset($_POST[$Voir])){
		if($tournoiouvert2['stateT'] == 2){
			header('Location: SeePoolTournamentAsViewers.php?tourneyId='.$ID.'&nbPls='.$tournoiouvert2['NbPls'].'&nbEq='.$tournoiouvert2['NbTeam'].'');
		}
		
		if($tournoiouvert2['stateT'] == 3){
			header('Location: Bracket'.$NbTeam.'AsViewers.php?tourneyId='.$ID.'&bracketR='.$tournoiouvert2['bracketR'].'');
		}
		
    }