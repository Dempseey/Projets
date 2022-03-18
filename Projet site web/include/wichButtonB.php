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
        $match_Id = $_GET['matchId'];

        if($scoreTeam1 > $scoreTeam2)
        {
            $winner = $teamId1;
        }
        elseif($scoreTeam2 > $scoreTeam1)
        {
            $winner = $teamId2;
        }
        
        $sql = "UPDATE match_t SET scoreTeam1 = :scoreTeam1, scoreTeam2 = :scoreTeam2, winner = :winner, stateM = :stateM  WHERE matchId =:matchId";
        $res = $db->prepare($sql);

        $res->execute(array(
            'scoreTeam1' => $scoreTeam1,
            'scoreTeam2' => $scoreTeam2,
            'winner' => $winner,
            'stateM' => 3,
            'matchId' => $match_Id
        ));





        $tid = $db->query("SELECT tourneyId, bracketM FROM match_t WHERE matchId = $match_Id");
        while($row = $tid->fetch())
        {
            $tourneyId = $row['tourneyId'];
            $wichBnb = $row['bracketM'];
        }

        $wichBnb++;

        
        if($_GET['secMid'] != 0)
        {
            $mid = $_GET['secMid'];
            $oneOrTwo = $_GET['pos'];
            if($oneOrTwo == 'u')
            {
                $db->query("UPDATE match_t SET teamId1 = $winner WHERE matchId = $mid");
            }
            elseif($oneOrTwo == 'd')
            {
                $db->query("UPDATE match_t SET teamId2 = $winner WHERE matchId = $mid");
            }
        }
        else
        {
            $oneOrTwo = $_GET['pos'];
            if($oneOrTwo == 'u')
            {
                $db->query("INSERT INTO match_t (teamId1, tourneyId, bracketM) VALUES ('$winner', '$tourneyId', '$wichBnb')");
            }
            elseif($oneOrTwo == 'd')
            {
                $db->query("INSERT INTO match_t (teamId2, tourneyId, bracketM) VALUES ('$winner', '$tourneyId', '$wichBnb')");
            }
        }










        header("Refresh:0");

    }
?>