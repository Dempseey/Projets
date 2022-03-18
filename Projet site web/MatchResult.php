<?php session_start(); ?>
<?php
    include 'include/database.php';
    global $db;
?> <!-- Inclure le fichier database.php-->

<!-- <link href ="css/ResultatMatch.css" rel="stylesheet">  Inclure le fichier ResultatMatch.css (pas encore fait)-->
<div id="main">
    <div class="center"> <!-- Création d'une div pour mieux gérer le formulaire en css -->
    <h1>Result of the Match</h1>

<form method="post"> 
    
    <!-- J'ai mis les id a remplir mais on pourra les enlever si jamais on peut les mettre avant dans la sélection du match -->
    <input type="text" name="teamId1" id="teamId1" placeholder="Id team 1" required><br/>
    
    <input type="text" name="teamId2" id="teamId2" placeholder="Id team 2" required><br/>

    <input type="number" name="scoreTeam1" id="scoreTeam1" placeholder="Score team 1" required><br/>

    <input type="number" name="scoreTeam2" id="scoreTeam2" placeholder="Score team 2" required><br/>
    
    <!-- <input type="date" name="dateAndTime" id="DateAndTime" placeholder="Date" required ><br/> Pas sur de mettre la date ou si elle sera mise avant-->
    
    <td>
    Gagnant du match <br/>
        <input type="radio" name="winner" value="1" required > 1
        <input type="radio" name="winner" value="2" required > 2
    </td> <br/>
    
    <input type="submit" id="formresult" name="formresult" value="Confirm">

</form>

<?php 
    include 'include/MatchResultVerification.php';
?> <!-- Inclure le fichier ResultatMatch.php-->
    </div>
</div>


<?php  include 'include/Footer.php'; ?>