<?php

    $match_id_to_check = $_GET['matchId'];

    $sql = "SELECT teamId1, teamId2 FROM match_t WHERE matchId = $match_id_to_check";
    $q = $db->query($sql);

    while($row = $q->fetch())
    {
        if($row['teamId1'] != 0 && $row['teamId2'] != 0)
        {
            $checkValidity = true;
        }
        else
        {
            $checkValidity = false;
        }
    }

    global $checkValidity;



?>