<?php

for($i=1; $i <= $round ; $i++)
    {
        $matchNb = 1;

        $sql = "SELECT teamId1, teamId2, scoreTeam1, scoreTeam2, matchId FROM match_t WHERE (tourneyId = $ID) AND (bracketM = $i) ORDER BY matchId";
        $q = $db->query($sql);

        echo '<div id="matchScoreRound'.$i.'">';

        while($row = $q->fetch())
        {
            $scoreT1 = $row['scoreTeam1'];
            $scoreT2 = $row['scoreTeam2'];
            $matchId = $row['matchId'];

            echo '<div id="'.$i.'_scoreof_matchNb'.$matchNb.'">'; $matchNb++;

            if($row['teamId1'] != 0 && $row['teamId2'] != 0)
            {
                if(($scoreT1 != NULL) && ($scoreT2 != NULL))
                {
                    echo '<div id="scoreteam1">'.$scoreT1.'</div>';
                    echo '<div id="scoreteam2">'.$scoreT2.'</div>';
                }
                else
                {
                    echo '<div id="scoreteam1"> X </div>';
                    echo '<div id="scoreteam2"> X </div>';
                }
            } 
            else
            {
                echo '<div id="scoreteam1"></div>';
                echo '<div id="scoreteam2"></div>';
            }

            
            
            echo '</div>';
        }

        echo '</div>';

        


    }

?>