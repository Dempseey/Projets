<?php

    if(isset($_POST['confirm_b_s']))
    {
        
        $w = "UPDATE tournament_t SET stateT = :stateT WHERE tourneyId = :tourneyId";
            $y = $db->prepare($w);
            $res1 = $y->execute([
                'stateT' => 3,
                'tourneyId' => $ID
            ]);
        
        $nb_teams = $_POST['nbTeams'];

        for($i=1 ; $i <= $nb_teams ; $i++)
        {
            $actualTeamId = $_POST['team'.$i];
            $listTeam[] = $actualTeamId;
            $sql = "UPDATE team_t SET bracket = :bracket WHERE teamId = :teamId";
            $q = $db->prepare($sql);
            $res = $q->execute([
                'bracket' => 1,
                'teamId' => $actualTeamId
            ]);
        }        

        $cpt = 0;
        while($cpt < $nb_teams)
        {
            $teamId1 = $listTeam[$cpt];
            $cpt++;
            $teamId2 = $listTeam[$cpt];
            $cpt++;

            $db->query("INSERT INTO match_t (tourneyId, teamId1, teamId2, bracketM) VALUES ('$ID', '$teamId1', '$teamId2', '1')");
        }

        switch($nb_teams)
        {
            case 2 :
                $db->query("UPDATE tournament_t SET bracketR = 2 WHERE tourneyId = $ID");
                header('Location: Bracket2.php?tourneyId='.$ID.'&bracketR=2');
            break;

            case 4 :
                $db->query("UPDATE tournament_t SET bracketR = 3 WHERE tourneyId = $ID");
                header('Location: Bracket4.php?tourneyId='.$ID.'&bracketR=3');
            break;

            case 8 :
                $db->query("UPDATE tournament_t SET bracketR = 4 WHERE tourneyId = $ID");
                header('Location: Bracket8.php?tourneyId='.$ID.'&bracketR=4');
            break;

            case 16 :
                $db->query("UPDATE tournament_t SET bracketR = 5 WHERE tourneyId = $ID");
                header('Location: Bracket16.php?tourneyId='.$ID.'&bracketR=5');
            break;
        }


        

    }

    


?>