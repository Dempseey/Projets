<?php 

    $matchId = $_GET['matchId'];

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

        echo '<table>';
        echo '<tr> <td>';
        echo $teamName1;
		echo "&nbsp";
        echo '</td> <td class= versus> VERSUS </td> <td>';
		echo "&nbsp";
        echo $teamName2;
        echo '</td> </tr>';
        echo '</table>';

    }


?>