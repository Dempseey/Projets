<?php

    //Récuperer l'id du tournoi
    $tourneyId = $_GET['tourneyId'];
    $sql = "SELECT nameT FROM tournament_t WHERE (tourneyId = $tourneyId)";
    $res = $db->query($sql);

    $row = $res->fetch();
    echo $row["nameT"];


?>