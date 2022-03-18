<?php 

if($checkValidity)
{
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
}
else
{
    $matchId = $_GET['matchId'];

    $sql = "SELECT teamId1, teamId2 FROM match_t WHERE matchId = $matchId";
    $res = $db->query($sql);

    while($row = $res->fetch())
    {
        if($row['teamId1'] == 0)
        {
            $id = $row['teamId2'];
            $res = $db->query("SELECT teamName FROM team_t WHERE teamId = $id");
            while($row2 = $res->fetch())
            {
                $tn = $row2['teamName'];
            }
        }
        else
        {
            $id = $row['teamId1'];
            $res = $db->query("SELECT teamName FROM team_t WHERE teamId = $id");
            while($row2 = $res->fetch())
            {
                $tn = $row2['teamName'];
            }
        }
    }

    echo '<table>';
        echo '<tr> <td>';
        echo $tn;
        echo '</td> </tr>';
    echo '</table>';
}


?>