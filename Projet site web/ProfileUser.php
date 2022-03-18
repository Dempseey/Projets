<?php session_start(); ?>
<?php
    include 'include/database.php';
    global $db;
?> <!-- Inclure le fichier database.php-->

 
<link rel="stylesheet" type="text/css" href = "css/ProfileUser.css"><!-- Inclure le fichier ProfilUser.css -->
<link rel="stylesheet" type="text/css" href = "css/Main.css">

<?php  include 'include/Header.php'; ?>  
<div id="main">
<div class="center"> <!-- Création d'une div pour mieux gérer le formulaire en css -->
    <h1>Profile</h1>
        
    <?php  if(isset($_SESSION['category']) && $_SESSION['category'] == 0){
    include 'include/ProfileUserPlayer.php';
}
    else{
        include 'include/ProfileUserManager.php';
    } ?>
     </div>       
</div> 

<?php  include 'include/Footer.php'; ?>