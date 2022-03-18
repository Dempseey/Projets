

<?php

if(isset($_POST['invisisub']))
{
    $tourneyId = $_GET['tourneyId'];
    $nbPool = $_POST['numberofpool'];

    $cptPool = 1;

    while($cptPool <= $nbPool)
    {
        $nbMatchInPool = $_POST['pool'.$cptPool.'_nbmatch'];
        $cptNbMatch = 1;

        while($cptNbMatch <= $nbMatchInPool)
        {
            $i = 1;
            $firstTeamId = $_POST['pool'.$cptPool.'_match'.$cptNbMatch.'_team'.$i];
            $i ++;
            $secondTeamId = $_POST['pool'.$cptPool.'_match'.$cptNbMatch.'_team'.$i];

            $sql = "INSERT INTO match_t (tourneyId, poolId, teamId1, teamId2) VALUES(:tourneyId, :poolId, :teamId1, :teamId2)";
            $res = $db->prepare($sql);
            $res->execute([
                'tourneyId' => $tourneyId, 
                'poolId' => $cptPool,
                'teamId1' => $firstTeamId,
                'teamId2' => $secondTeamId
            ]);

            $cptNbMatch++;

        }

        $cptPool++;
    }

    $db->query("UPDATE tournament_t SET stateT=2 WHERE tourneyId = $tourneyId");
	$db->query("UPDATE tournament_t SET NbPls=$nbPool WHERE tourneyId = $tourneyId");

    header('Location: SeePoolTournament.php?tourneyId='.$tourneyId.'&nbPls='.$nbPool.'&nbEq='.$_GET['nbEq'].'');

}





?>