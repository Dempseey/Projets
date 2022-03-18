<?php session_start(); ?>

<?php  include 'include/Header.php'; ?>  

<?php
include 'include/database.php';
global $db;
?>

<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href = "css/TeamRegistration.css">
<link rel="stylesheet" type="text/css" href = "css/Main.css">
<div id="main">
    <?php include "include/Arrow3.php"?>
   <div class="center">
    <h1 id="color">Team registration :</h1>

<form method="post"> 

    <!-- Nom de l'équipe -->
    <input class="form-control "type="text" name="teamname" id="teamname" placeholder="Team name" required><br/><br/>
    

    <!-- Téléphone de l'équipe -->
    <input type="tel" name="teamphone" id="teamphone" placeholder="06 05 04 03 02" pattern="[0-9]{10}" required>
    <br/><br/>


    <!-- Email de l'équipe -->
    <input type="email" name="team_email" id="team_email" placeholder="Adresse mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required><br/><br/>



    <!-- Nombre de joueurs dans l'équipe -->
    <label for="nb_players" id="color">Number of players in the team:</label>
    <select name="nb_players" id="nb_players">
        <option value="0" selected> --- </option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
    </select>
    <br/>

    <!-- X champs pour renseigner les noms des joueurs -->
    <div style="width:50%;  float:left;">
        <div id="add_players_firstnames"></div>
        <br/>
    </div>
    <div style="width:50%;  float:left;">
        <div id="add_players_names"></div>
        <br/>
    </div>
    <script src="js/NbPlayers.js"></script>



    <!-- Niveau de l'équipe -->
    <label for="teamlvl" id="color">What is the level of the team ? 1 <span class="italic">(best level)</span> - 100 <span class="italic">(lowest level)</span> :</label>
    <input type="number" id="teamlvl" value="1" name="teamlvl" min="1" max="100">
    <br/><br/>
    <!-- Bouton submit -->
    <input type="submit" id="teamsend" name="teamsend" value="Send">
<?php 
    include 'include/SendTeam.php';
?>
       </form> 
    </div>
</div>




<?php  include 'include/Footer.php'; ?>