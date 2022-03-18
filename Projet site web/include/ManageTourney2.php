<form method="post">
    <input type="submit" id="Voir" name="<?php echo "Voir$ID"; ?>"  value="Tournament overview">
</form>

<?php

        $y = $db->prepare("SELECT * FROM tournament_t  WHERE tourneyId = :tourneyId");
        $y->execute(['tourneyId'=>$ID]);
        $yy = $y->fetch();

    $Voir = "Voir$ID";
    if(isset($_POST[$Voir])){
			header('Location: Bracket'.$Number.'.php?tourneyId='.$ID.'&bracketR='.$yy['bracketR'].'');
    }
?>