<?php

    if(isset($_POST['startBracket']))
    {
        $nb_winner = $_POST['nb_winner'];

        for($i=1; $i <= $nb_winner; $i++)
        {
            $actualTeamName = $_POST['winnernb_'.$i];

            $sql = 'UPDATE team_t SET bracket = :bracket WHERE teamName = :teamName AND tourneyId = :tourneyId ';
            $q = $db->prepare($sql);

            $q->execute([
                'bracket' => 0,
                'teamName' => $actualTeamName,
                'tourneyId' => $_GET['tourneyId']

            ]);
        }

        switch($nb_winner)
        {
            case 2 :
                header('Location: Bracket2.php?tourneyId='.$_GET['tourneyId'].'&bracketR=0');
                break;

            case 4 :
                header('Location: Bracket4.php?tourneyId='.$_GET['tourneyId'].'&bracketR=0');
                break;

            case 8 :
                header('Location: Bracket8.php?tourneyId='.$_GET['tourneyId'].'&bracketR=0');
                break;
                
            case 16 :
                header('Location: Bracket16.php?tourneyId='.$_GET['tourneyId'].'&bracketR=0');
                break;

        }
    
    }




?>