<?php session_start(); ?>
<html>
    <head>
        <link rel="stylesheet" href ="css/Main.css"><!-- Mettre le lien du fichier css (Main.css) -->
        <link rel="stylesheet" href ="css/WaitingPage.css">
        <meta charset="utf-8" />
        <title>Yourney</title>
    </head>
    
    <?php  include 'include/Header.php'; ?>   <!-- Inclut le HEADER -->
    
    <body>
         <div id="main">
             <div class="center">
                <h1>Congratulations !</h1>
                <p>You will be redirected to the home page in a few seconds</p>
             </div>
        </div>
    </body>
    
    <?php header("Refresh:3; url=HomePage.php"); ?>
    
    <?php  include 'include/Footer.php'; ?>  <!-- Inclut le FOOTER -->