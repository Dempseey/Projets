<?php

    for($i=1; $i <= $round ; $i++)
    {
        $matchNb = 1;

        $sql = "SELECT teamId1, teamId2, matchId FROM match_t WHERE (tourneyId = $ID) AND (bracketM = $i) ORDER BY matchId";
        $q = $db->query($sql);

        echo '<div id="matchRound'.$i.'">';
        $oneOrTwo = 1;

        while($row = $q->fetch())
        {
            $check1 = false;
            $check2 = false;

            if($oneOrTwo == 3) $oneOrTwo = 1;

            $teamId1 = $row['teamId1'];
            if($row['teamId1'] != '') {$check1 = true;}
            $teamId2 = $row['teamId2'];
            if($row['teamId2'] != '') {$check2 = true;}
            $matchId = $row['matchId'];

            echo '<div id="'.$i.'_matchNb'.$matchNb.'">'; $matchNb++;

            if($check1)
            {
                $sql1 = ("SELECT teamName FROM team_t WHERE teamId = $teamId1");
                $res1 = $db->query($sql1);
                while($row1 = $res1->fetch()) {
                    if($i == $round)
                    {
                        echo '<div name="'.$matchId.'" id="'.$teamId1.'">'.$row1['teamName'].'</div>';
                    }
                    else
                    {
                        echo '<div name="'.$matchId.'" id="'.$teamId1.'" onclick="matchDetails('.$matchId.','.$oneOrTwo.',0)">'.$row1['teamName'].'</div>';
                    }
                }
            }

            
            if($check2)
            {
                $sql2 = ("SELECT teamName FROM team_t WHERE teamId = $teamId2");
                $res2 = $db->query($sql2);

                while($row2 = $res2->fetch()) {
                    if($i == $round)
                    {
                        echo '<div name="'.$matchId.'" id="'.$teamId2.'">'.$row2['teamName'].'</div>';
                    }
                    else
                    {
                        echo '<div name="'.$matchId.'" id="'.$teamId2.'" onclick="matchDetails('.$matchId.','.$oneOrTwo.',0)">'.$row2['teamName'].'</div>';                    
                    }
                }
            }

            $oneOrTwo ++;

            echo '</div>';
        }

        echo '</div>';

        


    }



?>