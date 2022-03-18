<?php

$tourneyId = $_GET['tourneyId'];

$sql = "SELECT * FROM team_t WHERE (tourneyId = $tourneyId) AND (validation = 1)";
$res = $db->query($sql);

$cpt = 1;
    
while($row = $res->fetch()) {
    echo '<div name="'.$row['teamId'].'" id="teamdrag'.$cpt.'" >'.$row['teamName'].'</div>';
    $cpt++;
}

?>