<?php

    if($round == 0)
    {
        echo '<div id="Drag1" ondragover="onDragOver(event)" ondrop="onDrop(event)"><span class="score"></span></div>
        <div id="Drag2" ondragover="onDragOver(event)" ondrop="onDrop(event)"><span class="score"></span></div>';
    
    }

    else
    {
        echo '<div id="1_match1_1"><span id="s_1_match1_1" class="score"></span></div>
        <div id="1_match1_2"><span id="s_1_match1_2" class="score"></span></div>';
    
    }


?>