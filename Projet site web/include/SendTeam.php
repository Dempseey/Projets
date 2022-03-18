<?php 

    if(isset($_POST['teamsend'])){ 
        
        $teamname = $_POST['teamname'];
        $teamphone = $_POST['teamphone'];
        $team_email = $_POST['team_email'];
        $nb_players = $_POST['nb_players'];
        $teamlvl = $_POST['teamlvl'];
        $login = $_SESSION['login'];

        if(!empty($teamname) && !empty($teamphone) && !empty($team_email) && ($nb_players != 0)){//test si les valeurs ne sont pas vides
            
                $t = $db->prepare("SELECT * FROM tournament_t WHERE tourneyId = :tourneyId");
                $t->execute(['tourneyId'=> $_GET['tourneyId']]);
                $tt = $t->fetch();
                $TourneyType = $tt['tourneyType'];
            
                $c = $db->prepare("SELECT teamName FROM team_t WHERE teamName = :teamName"); //Vérifie que le nom n'existe pas (Pour ça on compte combien de fois le même mail existe)
                $c->execute(['teamName'=> $teamname]);
                $result = $c->rowCount();
                
                $d = $db->prepare("SELECT address FROM team_t WHERE address = :address"); //Vérifie que le login n'existe pas (Pour ça on compte combien de fois le même login existe)
                $d->execute(['address'=> $team_email]);
                $result2 = $d->rowCount();
            
                $e = $db->prepare("SELECT phone FROM team_t WHERE phone = :phone"); //Vérifie que le login n'existe pas (Pour ça on compte combien de fois le même  login existe)
                $e->execute(['phone'=> $teamphone]);
                $result3 = $e->rowCount();
            if(strlen($teamname) > 12){
                echo "<p>Error: The Name of the team is too long !</p>";
            }else{
            if($result == 0){
                if($result2 == 0){
                   if($result3 == 0){
                       if($TourneyType == 1){
                           $insertB = "INSERT INTO team_t (teamName,tourneyId,levelT,phone,address,playerList,IdProfile,bracket) VALUES(:teamName,:tourneyId,:levelT,:phone,:address,:playerList,:IdProfile,:bracket)";
                           $result5 = $db->prepare($insertB); 
                       }else{
                           $insert = "INSERT INTO team_t (teamName,tourneyId,levelT,phone,address,playerList,IdProfile) VALUES(:teamName,:tourneyId,:levelT,:phone,:address,:playerList,:IdProfile)";
                           $result4 = $db->prepare($insert); 
                       }
                        
            
            
             
                    function player_list()
                    {
                        $nb_players = $_POST['nb_players'];
                        $cpt = 0;
                        $team_list = '[';
                         
                        $prenom = 'p_joueur'.$cpt ;
                        $nom = 'n_joueur'.$cpt;
                        echo $prenom;
                        $esp = ' ';
                        $prenom = $_POST[$prenom];
                        $nom = $_POST[$nom];
                        $team_list = $team_list.$prenom.$esp.$nom;
                            
                        if ($nb_players == 1)
                        {
                            $team_list = $team_list.']';
                            return $team_list;
                        }
                        
                        else
                        {
                            $cpt = 1;

                            while($cpt != $nb_players)
                            {
                                
                                $prenom = 'p_joueur'.$cpt ;
                                $nom = 'n_joueur'.$cpt;
                                $esp = ' ';
                                $vir = ', ';
                                $prenom = $_POST[$prenom];
                                $nom = $_POST[$nom];

                                $cpt += 1;

                                $team_list = $team_list.$vir.$prenom.$esp.$nom;
                            }
                        }

                        $team_list = $team_list.']';
                        return $team_list;
                    }

                    $list = player_list();
                       
                    if($TourneyType == 1){
                        $result5    ->execute([ 
                    'teamName'=> $teamname,
                    'tourneyId'=>$_GET['tourneyId'],
                    'levelT' => $teamlvl,
                    'phone'=> $teamphone,
                    'address'=>$team_email,
                    'playerList' => $list,
                    'IdProfile' => $login,
                    'bracket' => 0
                    ]);
                    }else{
                        $result4->execute([ 
                    'teamName'=> $teamname,
                    'tourneyId'=>$_GET['tourneyId'],
                    'levelT' => $teamlvl,
                    'phone'=> $teamphone,
                    'address'=>$team_email,
                    'playerList' => $list,
                    'IdProfile' => $login
                    ]);
                    }

                    

                    header('Location: WaitingPage.php'); //Permet de retourner à la PremierePage
                   }else{
                echo "<p>Error: The phone number is already in use!</p>";
            } 
                }else{
                echo "<p>Error: The Mail is already in use!</p>";
            }
            }else{
                echo "<p>Error: The Name is already in use!</p>";
            }
        }
        }
    }
?>
