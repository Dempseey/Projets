<header>
    <link href ="css/Header.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Crete+Round'rel="stylesheet">
    <meta charset="utf-8" />
    <div id="header">
        <div class="left">
            <h1>Yourney<span class="yellow">.</span></h1>
            <div id="ProfileLogin">
                <a class="Profil" href="ProfileUser.php" ><strong><?php if(isset($_SESSION['login'])){ echo $_SESSION['login']; } ?></strong></a>
            </div>
        </div>
        <div class="right">
            <nav>
                    <ul>
                        <li><a href ="HomePage.php" class="hover">Home Page</a></li>
                        <li></li> <!-- Remplacer le # par le lien menant au profil de la personne -->
                        <?php  if(isset($_SESSION['login'])){; } else(include 'include/MenuRegisterAndLogin.php'); ?> <!-- Fais disparaitre les Menu Login et Register lorsque la personne est connecté -->
                        
                        <?php  if(isset($_SESSION['login'])){ include 'include/LinkLogOut.php'; } ?> <!-- Déconnecte la personne de son profil-->
                    </ul>
                </nav>
        </div>        
    </div>
</header>