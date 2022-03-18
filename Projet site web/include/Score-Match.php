<?php session_start(); ?>
<?php include ('include/database.php');
global $db;
?>
<?php 
$scoreTeam1 = 'scoreTeam1';
$scoreTeam2 = 'scoreTeam2';

if ($scoreTeam1 > $scoreTeam2){
    $winner = $teamId1;
    echo "The winner is Team 1";
}
else {
    $winner = $teamId2;
    echo "The winner is Team 2";
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Score </title>
    <link rel="stylesheet" type="text/css" href = "css/CreateTourney.css">
    <link rel="stylesheet" type="text/css" href = "css/Main.css">
    <meta charset="utf-8" />
</head>

<?php  include 'include/Header.php'; ?>    
    
<body>
    <div id="main">
        <?php include "include/Arrow.php"?>
        <div class="center">
            <form method = "post">
                <div class = "container"></div>
                <div class="row">
                    <h1> Input The scores of the match </h1><br/>
                    <label id="color"> Score Team1  </label>  <input type="number" name="scoreTeam1" id="scoreTeam1" autofocus required/> <br/><br/>
                    <label id="color"> Score Team2  </label> <input type="number" name="scoreTeam2" id="scoreTeam2" required /> <br/><br/>
                </div>
                <input type="submit" id="ResultsSend" name="ResultsSend" value="Validate" /><br/>
            </form>
            
        </div>
    </div>
</body>  
    
<?php  include 'include/Footer.php'; ?>


</html>