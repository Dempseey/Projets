<?php

    if(isset($_POST['startMatch']))
    {
        if($_POST['checkMatchS'] == 'notOverMatch')
        {
            $sql = "SELECT * FROM match_t WHERE matchId = $matchId";
            $res = $db->query($sql);

            while($row = $res->fetch())
            {
                $d = $_POST['duration_n'];

                $actualDate = date("Y-m-d H:i:s", time());
                $endDate = date("Y-m-d H:i:s", time()+(60 * $d));

                $sqlUp = "UPDATE match_t SET startedDate = :startedDate, endDate = :endDate, stateM = :stateM WHERE matchId = :matchId";
                $q = $db->prepare($sqlUp);
                $q->execute(array(
                    'startedDate' => $actualDate,
                    'endDate' => $endDate,
                    'matchId' => $matchId,
                    'stateM' => 1
                ));
            }
        }
        else if($_POST['checkMatchS'] == 'overMatch')
        {
            $sqlUp = "UPDATE match_t SET stateM = :stateM WHERE matchId = :matchId";
                $q = $db->prepare($sqlUp);
                $q->execute(array(
                    'stateM' => 2,
                    'matchId' => $matchId
                ));

            
        }

        header("Refresh:0");
    }


    if(isset($_POST['submitScore']))
    {
        $scoreTeam1 = $_POST['teamscore1'];
        $scoreTeam2 = $_POST['teamscore2'];

        if($scoreTeam1 > $scoreTeam2)
        {
            $winner = $teamId1;
        }
        elseif($scoreTeam2 > $scoreTeam1)
        {
            $winner = $teamId2;
        }
        else
        {
            $winner = 0;
        }
        
        $sql = "UPDATE match_t SET scoreTeam1 = :scoreTeam1, scoreTeam2 = :scoreTeam2, winner = :winner, stateM = :stateM WHERE matchId =:matchId";
        $res = $db->prepare($sql);

        $res->execute(array(
            'scoreTeam1' => $scoreTeam1,
            'scoreTeam2' => $scoreTeam2,
            'winner' => $winner,
            'stateM' => 3,
            'matchId' => $_GET['matchId']
        ));

        header("Refresh:0");

    }
?>