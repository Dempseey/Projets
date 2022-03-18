<?php 

    $cpt = 1;

    while($cpt <= $nbPoulesAuto)
    {
        echo '<option value="'.$cpt.'">'.$cpt.'</option>';
        $cpt ++;
    }

?>