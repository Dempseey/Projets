<?php

    $matchId = $_GET['matchId'];

    $sql = "SELECT endDate FROM match_t WHERE matchId = $matchId";
    $res = $db->query($sql);

    while($row = $res->fetch())
    {
        echo '</br> </br>';
        $actualDate = date("Y-m-d H:i:s", time());
        $endDate = $row['endDate'];

        $datetime1 = date_create($actualDate);
        $datetime2 = date_create($endDate);

        if($datetime1 > $datetime2)
        {
            $sqlUp = "UPDATE match_t SET stateM = :stateM WHERE matchId = :matchId";
            $q = $db->prepare($sqlUp);
            $q->execute(array(
                'stateM' => 2,
                'matchId' => $matchId
            ));

            header("Refresh:0");
        }

        else
        {
            $date = date_diff($datetime1, $datetime2);

            $heure = $date->format('%H');
    
            if($heure == 0)
            {
                echo $date->format('<p>The match ends in %i minutes and %s seconds</p>');
            }
            else
            {
                echo $date->format('<p>The match ends in %H hours, %i minutes and %s seconds</p>');
            }
        }

    }


?>