<?php

//Dans ce fichier je vais récupérer les points de chaque équipe.

//Je vais d'abord récupérer tous les teamId dans la table Team qui font parti du tournoi et qui ont été validé pour
//ne récupérer que ceux qu'on veut.

    $tourneyId = $_GET['tourneyId'];

    $sql = "SELECT teamId FROM team_t WHERE (tourneyId = $tourneyId) AND (validation = 1)";
    $res = $db->query($sql);


    while($row = $res->fetch())
    {
        $cptPts = 0;

        $actualTeam = $row['teamId'];

        //Ici je récupère toutes les lignes dans la table matches où l'une des deux équipes est celle qui m'intéresse

        $sql2 = "SELECT * FROM match_t WHERE (teamId1 = $actualTeam) OR (teamId2 = $actualTeam)";
        $res2 = $db->query($sql2);

        while($row2 = $res2->fetch())
        {
            $teamId1 = $row2['teamId1'];
            $teamId2 = $row2['teamId2'];

            //Je regarde si mon équipe est l'équipe 1 ou 2 et je calcule les points en conséquence
            //Si le score de mon équipe est supérieur, c'est +3 points
            //Si c'est égal, c'est +1 pts
            //Sinon c'est 0 points donc je m'occupe pas de ça

            if($teamId1 == $actualTeam)
            {
                $scoreActualTeam = $row2['scoreTeam1'];
                $scoreEnnemy = $row2['scoreTeam2'];

                if(($scoreActualTeam != NULL) && ($scoreEnnemy != NULL))
                {
                    if($scoreActualTeam > $scoreEnnemy)
                    {
                        $cptPts = $cptPts + 3;
                    }
                    else if($scoreActualTeam == $scoreEnnemy)
                    {
                        $cptPts += 1;
                    }
                }

                
            }
            else if($teamId2 == $actualTeam)
            {
                $scoreActualTeam = $row2['scoreTeam2'];
                $scoreEnnemy = $row2['scoreTeam1'];

                if(($scoreActualTeam != NULL) && ($scoreEnnemy != NULL))
                {
                    if($scoreActualTeam > $scoreEnnemy)
                    {
                        $cptPts += 3;
                    }
                    else if($scoreActualTeam == $scoreEnnemy)
                    {
                        $cptPts += 1;
                    }
                }
            }


        }
        
        //Et pour finir je crée un div qui contient mon nombre de points, dont l'id est l'id de l'équipe
        //pour pouvoir le retrouver facilement
        echo '<div id="nbpts_'.$actualTeam.'" class="score"> '.$cptPts.' </div>';

    }

?>