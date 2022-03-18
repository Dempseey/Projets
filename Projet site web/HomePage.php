<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href ="css/HomePage.css"> <!-- Mettre le lien du fichier css (PremierePage.css) -->
        <link rel="stylesheet" href="css/MainBig.css">
        <link href='http://fonts.googleapis.com/css?family=Crete+Round'rel="stylesheet">
        <meta charset="utf-8" />
        <title>Yourney</title>
    </head>
    
    <?php  include 'include/Header.php'; ?>   <!-- Inclut le HEADER -->
    
    <body>
       
        <div id="main">
            <div class="container-2">
                <section id= "ManageTournament">
                    <?php  if(isset($_SESSION['category']) && $_SESSION['category'] == 1){ echo '<a href ="ManageTournament.php" class="button-2">Manage your Tournament</a>'; } ?> <!-- Test si la personne est enregistré et si elle est Gestionnaire, si oui elle fais apparaitre le bouton Gerer Ses Tournois -->
                </section>
       
            
      
                <section id= "CreateTourney">
                    <?php  if(isset($_SESSION['category']) && $_SESSION['category'] == 1){include 'include/MenuCreation.php'; } else{                           if(isset($_SESSION['category']) && $_SESSION['category'] == 0){ include 'include/RegistrationButton.php'; } } ?> <!-- Test si la personne     est enregistré et si elle est Joueur ou Gestionnaire, si elle est gestionnaire elle effectue le premier if, sinon le deuxième -->
                </section>
       
            
       
                <section id= "CurrentTournament">
                    <a href ="CurrentTournament.php" class="button-2">Current Tournaments</a><br/><br/><br/>
                    <a href ="FinishedTournament.php" class="button-2">Finished tournaments</a> <!-- Lien vers tous les tournois en cours ou déjà finis (etat 1 ou 2) -->
                </section>
            </div>
            
            <div class="container">
                <section id = "Benefits">
                    <ul>
                        <li id="Benefits-1">
                            <h4>Save time</h4>
                            <p>Free yourself from all the long and tedious tasks: registration of participants, establishment of tables and pools, entry of scores, calculation of rankings ... The software takes care of everything. You will finally be able to concentrate on the essential: sport.</p>
                        </li>     
                        <li id="Benefits-2">
                            <h4>Stay calm</h4>
                            <p>Stop stressing during your sporting events! No error will spoil its progress: Yourney allows you to create tables and pools according to the rules of your sport. In case of withdrawal, no problem: Yourney will adapt in one click. </p>

                        </li>
                    </ul>
            </section>
            </div>
            
            <div class="container-3">
                <div class="img-tourney">
                </div>
            </div>
            
            <div class="container">
                <section id = "Benefits">
                    <ul>
                        <li id="Benefits-1">
                            <h4>Be on top</h4>
                            <p>Add value to your club using a modern and professional solution. Your participant will be delighted to use such an effective solution, making your event a success.</p>
                        </li>
                        <li id="Benefits-2">
                            <h4>Management</h4>
                            <p>Add teams, players and referees yourself or open a registration page. Combine pools, tournament trees and individual matches to get the perfect setup.</p>
                        </li>
                    </ul>
            </section>
            </div>
            
            <div class="container-image">
                <h1><u>All the sport available :</u></h1>
	
                <span id="sl_play" class="sl_command">&nbsp;</span>
                <span id="sl_pause" class="sl_command">&nbsp;</span>
                <section id="slideshow">

                    <a class="play_commands pause" href="#sl_pause" title="Maintain paused">Pause</a>
                    <a class="play_commands play" href="#sl_play" title="Play the animation">Play</a>

                    <div class="container-4">
                        <div class="c_slider"></div>
                        <div class="slider">
                            <figure>
                                <img src="css/img/TourneyBasketball.jpg" alt="" width="640" height="310" />
                                <figcaption>Basketball</figcaption>
                            </figure><!--
                            --><figure>
                                <img src="css/img/TourneyFootball.jpg" alt="" width="640" height="310" />
                                <figcaption>Football</figcaption>
                            </figure><!--
                            --><figure>
                                <img src="css/img/TourneyHandball.jpg" alt="" width="640" height="310" />
                                <figcaption>Handball</figcaption>
                            </figure><!--
                            --><figure>
                                <img src="css/img/TourneyTennis.jpg" alt="" width="640" height="310" />
                                <figcaption>Tennis</figcaption>
                            </figure>
                        </div>
                    </div>

                    <span id="timeline"></span>
                </section>
	
            </div>
            
        </div>
    </body>
    
<?php  include 'include/Footer.php'; ?>  <!-- Inclut le FOOTER -->

</html>

