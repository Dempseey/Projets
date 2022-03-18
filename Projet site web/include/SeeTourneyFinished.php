<form method="post">
<input type="submit" id="Voir" name="<?php echo "Voir$tournoiouvert2[tourneyId]"; ?>"  value="See the Tournament">
</form>

<?php



    $Voir = "Voir$tournoiouvert2[tourneyId]";
    if(isset($_POST[$Voir])){		
		if($tournoiouvert2['stateT'] == 4){
            header('Location: Bracket'.$Number.'AsViewers.php?tourneyId='.$ID.'&bracketR='.$tournoiouvert2['bracketR'].'');
		}
    }