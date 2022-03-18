<?php

    //Récuperer l'id du tournoi, j'ai mit 2 pour que fonctionne le reste
    $sql = "SELECT teamName FROM team_t WHERE (tourneyId = $tourneyId) AND (validation = 1)";
    $res = $db->query($sql);
    $nbEquipes = $res->rowCount();
    echo $nbEquipes;

    $nbPoulesAuto = ceil($nbEquipes / 3);

?>