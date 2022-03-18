<?php session_start(); ?>
<?php
    include 'include/database.php';
    global $db;
?><!-- Inclure le fichier database.php-->

<link href ="css/LoginAccount.css" rel="stylesheet"> <!-- Inclure le fichier Connexion.css -->
<link href ="css/Main.css" rel="stylesheet">
<link href ="bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" rel="stylesheet">
<?php  include 'include/Header.php'; ?>  

<div id="main" >
    <div class="center">
        <h1>Login</h1><br/>
        
    <form method="post">
    <div class="form-floating"> 
    <input type="text" class="form-control" name="login" id="login" placeholder="Login" autofocus required>
    <label for="login">Login</label>
    </div>
    <div class="form-floating">
    <input type="password" class="form-control" name="password2" id="password2" placeholder="Password" required><br/><br/>
    <label for="password2">Password</label>
    </div>
    
    <input type="submit" class="btn btn-primary" id="formlogin" name="formlogin" value="Connect">

</form>
    </div><!-- Création d'une div pour mieux gérer le formulaire en css -->
    

<?php 
    include 'include/LoginVerification.php';
?> <!-- Inclure le fichier Connexion.php-->
</div>

<?php  include 'include/Footer.php'; ?>