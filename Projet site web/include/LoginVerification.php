<?php 

     
    if(isset($_POST['formlogin'])){ //test si le bouton a était appuyé
        
        extract($_POST); //Crée des variables en php (par exemple '$email') et les initialise aves les valeurs écrit par la personne qui remplit sont formulaire
        
        if(!empty($login) && !empty($password2)){ //test si les valeurs ne sont pas vides
            
            $d = $db->prepare("SELECT * FROM user_t WHERE login = :login"); //Crée un fetch avec les informations de l'utilisateur
            $d->execute(['login'=> $login]);
            $result = $d->fetch();
            
            if($result){ //Vérifie si le login existe
                
                $hashpassword = $result['password'];
                
                if(password_verify($password2,$hashpassword)){ //Test si le mdp et le mdp crypté sont identiques
                    header('Location: HomePage.php'); //Permet de retourner à la PremierePage
                    $_SESSION['login'] = $result['login']; //Donne des valeurs au variables de SESSION (login et category) qui nous serons utilise pour plus tard
                    $_SESSION['category'] = $result['category'];
                    
                }else{
                    echo "Password is incorrect";
                }
                
            } else{
                echo "One of the information requested is incorrect";
            }
            
        } else{
            echo "One of the requested information is missing";
        }
    }
?>