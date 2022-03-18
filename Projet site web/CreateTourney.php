<?php session_start(); ?>
<?php
include ('include/database.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Yourney</title>
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
    
    <h1> Create your Tourney </h1><br/>

            <label id="color">Manager   </label>  <input type="text" name="manager" id="manager" autofocus required/> <br/><br/>
            <label id="color">Tournament name   </label> <input type="text" name="nameT" id="nameT" required /> <br/><br/>
            <td><span class="color">Tournament type   </span></td>
            <td>
                <input type="radio" name="tourneyType"  class="demo1" id="demo1-a" value="1" checked>
                <label for="demo1-a">Championship</label>
                <input type="radio" name="tourneyType" class="demo1" id="demo1-b" value="2" >
                <label for="demo1-b">Pools</label><br/>
            </td> <br/>
            <td> <span class="color">Sport   </span></td>
            <td>
                <input type="radio" name="sport"  class="demo1" id="demo1-c" value="Tennis" checked>
                <label for="demo1-c">Tennis</label>
                <input type="radio" name="sport"  class="demo1" id="demo1-d" value="Football" checked>
                <label for="demo1-d">Football</label>
                <input type="radio" name="sport"  class="demo1" id="demo1-e" value="Basketball" checked>
                <label for="demo1-e">Basketball</label>
                <input type="radio" name="sport"  class="demo1" id="demo1-f" value="Handball" checked>
                <label for="demo1-f">Handball</label>
                <input type="radio" name="sport" class="demo1" id="demo1-g" value="Rugby" >
                <label for="demo1-g">Rugby</label>
            </td> <br/><br/>
            
            <label id="color">Tournament start date</label> <input type="date" name = "beginningDate" required /> <br/><br/>
            <label id="color">End of tournament date</label> <input type="date" name = "endingDate" required /> <br/><br/>
            <label id="color">Location (city)</label> <input type="text" name="location" id="location" placeholder="Ex : Paris" required/><br/><br/>
            <label id="color">Number of Teams  </label> <input type="number" id="NbTeams" value="1" name="NbTeams" min="1" max="50" required><label id="color2">(For a Championship the number of teams must be 2, 4, 8 or 16)</label><br/><br/>
        <input type="submit" id="formsend" name="formsend" value="Create" /><br/>
    <?php  include 'include/CreationTournament.php'; ?>
    </div>
</form>
</div>
</div>


    
    
<?php  include 'include/Footer.php'; ?>
</body>

</html>