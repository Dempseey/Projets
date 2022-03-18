<?php

//On affiche juste les équipes pour que le js les mettent dans les poules par la suite//////////////////////////
$tourneyId = $_GET['tourneyId'];

$sql = "SELECT * FROM team_t WHERE (tourneyId = $tourneyId) AND (validation = 1)";
$res = $db->query($sql);

$cpt = 1;
    
while($row = $res->fetch()) {
    echo '<div name="'.$row['teamId'].'" id="teamdrag'.$cpt.'" >'.$row['teamName'].'</div>';
    $cpt++;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////




//On récupère tout dans la table matches pour faire les opérations ensuites //////////////////

$sql = "SELECT * FROM match_t WHERE tourneyId = $tourneyId";
$res = $db->query($sql);

$cptMatchNumber = 1;

while($row = $res->fetch())
{
    $matchId = $row['matchId'];
    $teamId1 = $row['teamId1'];
    $teamId2 = $row['teamId2'];
    $poolIdOfMatch = $row['poolId'];
    $stateOfMatch = $row['stateM'];
    /*
        0 = n'a pas commencé
        1 = est en cours
        2 = attends que les scores soit rentré
        3 = terminé
    */

    //en dessous je regardes si l'état du match est à 1 (en cours) car il faut aller sur la page MatchDetails.php pour
    //que, si le match est terminé, qu'il change son état en "attend les scores", donc je regardes en dessous
    //si il y a des matchs "en cours" et si ils sont vraiment en cours, sinon je les changes en "attend les scores"
    if($stateOfMatch == 1)
    {
        $actualDate = date("Y-m-d H:i:s", time());
        $endDate = $row['endDate'];

        $datetime1 = date_create($actualDate);
        $datetime2 = date_create($endDate);

        if($datetime1 > $datetime2)
        {
            $sqlUp = "UPDATE match_t team_t SET stateM = :stateM WHERE matchId = :matchId";
            $q = $db->prepare($sqlUp);
            $q->execute(array(
                'stateM' => 2,
                'matchId' => $matchId
            ));

        $stateOfMatch = 2;
        }
    }
    //à partir d'ici tout est rentré dans l'ordre



    //Je selectionne les noms des éuipes pour crée des petits tableaux de matchs.
    //Je leur donne des id bien spécifiques car le secret en javascript c'est les id
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
	

    echo '<table id="matchnumber'.$cptMatchNumber.'_'.$stateOfMatch.'" onclick="MatchDetails('.$matchId.')" style="background-color : #FF9898">';
    $cptMatchNumber++;
        
    echo '<tr> <th colspan="3"> Match of pool number '.$poolIdOfMatch.'</th> </tr>';
    echo '<tr> <td> ' .$teamName1.'</td> <td class=versus> VERSUS </td> <td> '.$teamName2.' </td> </tr>';
        
    echo '</table>';
}

?>

