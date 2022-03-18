<?php

    $sql = "SELECT * FROM match_t WHERE matchId = $matchId";
    $res = $db->query($sql);

    

    while($row = $res->fetch())
    {
        $teamId1 = $row['teamId1'];
        $teamId2 = $row['teamId2'];

        $sqlFirst = "SELECT teamName FROM team_t WHERE teamId = $teamId1";
        $sqlSec = "SELECT teamName FROM team_t WHERE teamId = $teamId2";
        $resFirst = $db->query($sqlFirst);
        $resSec = $db->query($sqlSec);
        $teamName1 = "";
        $teamName2 = "";
        while($rowFirst = $resFirst->fetch())
        { $teamName1 = $rowFirst['teamName']; }
        while($rowSec = $resSec->fetch())
        { $teamName2 = $rowSec['teamName']; }

        $scoreEq1 = $row['scoreTeam1'];
        $scoreEq2 = $row['scoreTeam2'];

        $state = $row['stateM']; //Etat du match

        switch($state)
        {
            case 0 :
                echo '<p>The match has not yet started, please choose an option and tap below to start it</p>';
                echo '</br></br>';
                echo '<form method="post">';
                echo '<div class="buttonDiv>"';
                echo '<label for="notStartedM"><p>Is the match already over ?</p></label></br>';
                echo '<input type="radio" id="overMatch" onchange="checkedState()" name="checkMatchS" value="overMatch" checked> ';
                echo '<label for="overMatch">Yes</label>';
				echo "&nbsp";
                echo '<input type="radio" id="notOverMatch" onchange="checkedState()" name="checkMatchS" value="notOverMatch"> ';
                echo '<label for="noOverMatch">No</label>';
                echo '</br></br>';
                echo '</div>';
                echo '<div class="buttonDiv>"';
                echo '<div id="duration_div">';
                echo '</div>';
                echo '</div>';
                echo '<button type="submit" name="startMatch">Start</button>';
                echo '</form>';

                break;

            case 1 : 
                echo '<p>The match is in progress, wait until the end of the allotted time to complete the scores</p></br>';
                include 'include/showRemainingTime.php';
                echo '</br></br>';
                break;

            case 2 :
                echo '<p>The match is over, fill in the team scores</p>';
                echo '</br></br>';
                echo '<form method="post">';
                echo '<div class="buttonDiv>"';
                echo '<label for="teamscore1"><p>'.$teamName1.' \'s score</p></label></br>';
                echo '<input id="teamscore1" name="teamscore1" type="number" value="0" min="0" max="99">';
                echo '</br></br>';
                echo '</div>';
                echo '<div class="buttonDiv>';
                echo '<label for="teamscore2"><p>'.$teamName2.' \'s score</p></label></br>';
                echo '<input id="teamscore2" name="teamscore2" type="number" value="0" min="0" max="99">';
                echo '</div>';
                echo '<div class="buttonDiv"> </br>';
                echo '<button type="submit" name="submitScore"> Submit scores </button>';
                echo '</div>';
                echo '</form>';
                break;

            case 3 :
                echo '<p>This match is over.</p>';
                echo '</br>';

                if($scoreEq1 == $scoreEq2)
                {
                    echo '<p>The game ended in a draw.';
                    echo '</br>';
                    echo 'It was : </p><h4>'.$scoreEq1.'-'.$scoreEq2.'.</h4>';
                }
                elseif($scoreEq1 > $scoreEq2)
                {
                    echo '<p>The winner is : '.$teamName1.'</br>';
                    echo 'The score is : </p><h4>'.$scoreEq1.'-'.$scoreEq2.'.</h4>';
                }
                else
                {
                    echo '<p>The winner is : '.$teamName2.'</br>';
                    echo 'The score is : </p><h4>'.$scoreEq1.'-'.$scoreEq2.'.</h4>';
                }
                break;                

        }

    }

?>