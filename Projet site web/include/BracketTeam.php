<?php 

$b = $db->prepare("SELECT * FROM team_t WHERE tourneyId = :tourneyId");
$b->execute(['tourneyId' => $ID]);
$NumberTeam = $b->rowCount();

$d = $db->prepare("SELECT * FROM team_t WHERE tourneyId = :tourneyId ORDER BY levelT");
$d->execute(['tourneyId' => $ID]);
$result = $d->fetch();
$level = $result['levelT'];
$cpt = 0;
$Name=array();


for($level; $level < 100;$level++){
    $a = $db->prepare("SELECT * FROM team_t WHERE tourneyId = :tourneyId AND levelT = :levelT ORDER BY levelT");
    $a->execute(['tourneyId' => $ID, 'levelT' => $level]);
    $result = $a->fetch();
    if($result){
        $Name[$cpt]=$result['teamName'];
        $cpt++;
    }
}
?>