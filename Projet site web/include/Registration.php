<?php 

    if(isset($_POST['formsend'])){ //test si le bouton a était appuyé
        
        extract($_POST); //Crée des variables en php (par exemple '$email') et les initialise aves les valeurs écrit par la personne qui remplit sont formulaire
        
        if(!empty($signin) && !empty($email) && !empty($password) && !empty($cpassword) ){ //test si les valeurs ne sont pas vides
            if(strlen($password) > 7 && preg_match("#[A-Z ]#",$password) && preg_match("#[0-9 ]#",$password)){
				
				if($password == $cpassword)
				{ //test si les 2 mdp sont identiques
                	$option = [
                    	'cost' => 12,
                	];
                
                	$hashpass = password_hash($password, PASSWORD_BCRYPT, $option); //Crypt le mdp et le met  dans la variable $hashpass
                
                
					$c = $db->prepare("SELECT email FROM user_t WHERE email = :email"); //Vérifie que le mail n'existe pas (Pour ça on compte combien de fois le même mail existe)
					$c->execute(['email'=> $email]);
					$result = $c->rowCount();

					$d = $db->prepare("SELECT login FROM user_t WHERE login = :login"); //Vérifie que le login n'existe pas (Pour ça on compte combien de fois le même login existe)
					$d->execute(['login'=> $signin]);
					$result2 = $d->rowCount();

					if($result == 0 && $result2 == 0)
						{ //Test si l'email et le login apparraissent 0 fois dans la base de données
						$q = $db->prepare("INSERT INTO user_t(login,email,password,category) VALUES(:login,:email,:password,:category)"); 
						//Cette table est composée de : id | login | email | password | category (id s'incremente tout seul, c'est la PRIMARY KEY, login et email sont uniques, category définit si la personne est 0 : Joueur; 1 : Gestionnaire, 2 : Admin)
						$q->execute([ //Met les valeurs de l'utilisateur dans la Table Utilisateurs et donne des valeurs au variables de SESSION (login et category) qui nous serons utilise pour plus tard
						'login'=> $signin,
						'email'=>$email,
						'password'=> $hashpass,
						'category'=>$category
						]);
						$_SESSION['login'] = $signin;
						$_SESSION['category'] = $category;
						header('Location: WaitingPage.php'); //Permet de retourner à la PremierePage
						}
					else
					{
						echo "<p>This name or email already exists!</p>";
					}
				}
				else
				{
					echo "<p>Passwords are not the same</p>";
            	}
			}
			else
			{
				echo "<p>The password must contain at least 8 characters, a capital letter and a number</p>";
			} 
        }
        
    }
?>