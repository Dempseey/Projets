<form method="post">
    <input type="submit" id="Valider" name="<?php echo "Valider$IdTeam"; ?>"  value="Validate">
</form>

<?php

    $Valider = "Valider$IdTeam";
    if(isset($_POST[$Valider])){
        $a = $db->prepare("UPDATE team_t SET validation = '1' WHERE teamId = $IdTeam");
        $a->execute();
        header("Refresh:0");
    }
?>