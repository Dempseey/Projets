<form method="post">
    <input type="submit" id="Annuler" name="<?php echo "Annuler$IdTeam"; ?>"  value="Cancel">
</form>

<?php

    $Annuler = "Annuler$IdTeam";
    if(isset($_POST[$Annuler])){
        $a = $db->prepare("UPDATE team_t SET validation = '0' WHERE teamId = $IdTeam");
        $a->execute();
        header("Refresh:0");
    }
?>