<?php

    $tourneyId = $ID;

    $sql = "SELECT teamName, teamId FROM team_t WHERE (tourneyId = $tourneyId) AND (validation = 1) AND (bracket = 0)";
    $res = $db->query($sql);
    
    $cpt = 1;
        
    while($row = $res->fetch()) {
        echo '<div class="draggable" name="'.$row['teamId'].'" id="teamdrag'.$cpt.'" draggable="true" ondragstart="onDragStart(event);">'.$row['teamName'].'</div>';
        $cpt++;
    }

?>