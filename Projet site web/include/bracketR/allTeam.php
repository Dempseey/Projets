<?php

    if($round == 0)
    {
        echo '<p id="color"> To make a random draw, click here : <button onclick="tirage();">Random selection</button> </p>'.
            '<p id="color"> To make a level draw, click here : <button onclick="level();">Level selection</button> </p>'.
            '<p id="color">Otherwise you can drag each teams into the bracket you want using your computer mouse</p>'.
                    '<h3 id="color">List of teams : </h3>'.
                    '<button onclick="goBack()">Bring all the teams back</button>'.
                    '<div id="backTeam" class="getBackTeam" ondragover="onDragOver(event)" ondrop="dropBack(event)">';

                    include 'GetAllTeam2.php';

        echo          '</div><br/>'.
                    '<div class="buttonDiv">'.
                        '<br/><br/>'.
                        '<button id="conf_choices" onclick="getTeamStart()">Confirm my choices </button>'.
                        '<form method="post" id="get_ts">'.
                        '</form>'.
                        '<br/><br/>'.
                    '</div>';

    }



?>