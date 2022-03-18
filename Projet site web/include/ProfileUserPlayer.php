<?php 

$a = $db->prepare("SELECT * FROM team_t WHERE idProfile = :idProfile ORDER BY tourneyId DESC");
$a->execute(['idProfile'=> $_SESSION['login']]);
$result = $a->rowCount();

$result2 = $a->fetch();
$ID = $result2['tourneyId'];
$level = 0; $Victory = 0; $Score =0;

for($i= $ID; $i > 0; $i--){
    
    $b = $db->prepare("SELECT * FROM team_t WHERE idProfile = :idProfile AND tourneyId = $i");
    $b->execute(['idProfile'=> $_SESSION['login']]);
    $result2 = $b->fetch();
	$level = $level + $result2['levelT'];
	$TeamID = $result2['teamId'];
	
	$c = $db->prepare("SELECT * FROM match_t WHERE winner = :winner AND tourneyId = $i");
    $c->execute(['winner'=> $TeamID]);
    $Victory = $c->rowCount();
    
	$d = $db->prepare("SELECT * FROM match_t WHERE teamId1 = :teamId1 AND tourneyId = $i");
    $d->execute(['teamId1'=> $TeamID]);
	$result3 = $d->fetch();
	if($result3['scoreTeam1'] >= 0){
		$Score = $Score + $result3['scoreTeam1'];
	}
	
	$e = $db->prepare("SELECT * FROM match_t WHERE teamId2 = :teamId2 AND tourneyId = $i");
    $e->execute(['teamId2'=> $TeamID]);
	$result4 = $e->fetch();
	if($result4['scoreTeam2'] >= 0){
		$Score = $Score + $result4['scoreTeam2'];
	}
	
}

$AverageLevel = $level/$result;

?>

<p>Number of team created : <strong><?php echo $result?></strong></p>
<p>Average level of teams : <strong><?php echo $AverageLevel?></strong></p>
<p>Number of victory : <strong><?php echo $Victory?></strong></p>
<p>Total score in all the tournament : <strong><?php echo $Score?></strong></p>