<?php session_start(); ?>

<?php  include 'include/Header.php'; ?>  

<?php

include 'include/database.php';
global $db;

$d = $db->prepare("SELECT * FROM tournament_t WHERE logT = :logT ORDER BY tourneyId DESC");
$d->execute(['logT'=> $_SESSION['login']]);
$result = $d->fetch();
$tournoiID = $result['tourneyId'];
?>

<link rel="stylesheet" type="text/css" href = "css/ManageTournament.css">
<link rel="stylesheet" type="text/css" href = "css/MainBig.css">


<div id="main">
    <?php include "include/Arrow.php"?><br/>
    <div class="center">

<?php
if($result){
    for($result; $tournoiID != 0; $tournoiID = $tournoiID - 1 ){
        
        $e = $db->prepare("SELECT * FROM tournament_t  WHERE tourneyId = :tourneyId AND logT = :logT AND stateT = :stateT");
        $e->execute(['tourneyId'=> $tournoiID,'logT'=> $_SESSION['login'], 'stateT'=>0 ]);
        $result2 = $e->fetch();
        
        if($result2){
            echo "<div class=tourney><div class=PlaceImage style=background-image:url(css/img/$result2[sport].jpg)></div>";
            echo "<p id=color>$result2[nameT] ";
            echo "is a ";
            echo "$result2[sport] ";
            echo " tournament organized by ";
            echo "$result2[manager] ";
            echo "from  "; echo "$result2[beginningDate] "; 
            echo "to "; echo "$result2[endingDate] "; 
            echo "in ";
            echo "$result2[location] </p> ";
            $ID = $result2['tourneyId'];
            $TT = $result2['tourneyType'];
            $NumberTeam = $result2['NbTeam'];
            include 'include/ClosingRegistration.php';
            echo "</div>";
        }
    
    }
}

$tournoiID2 = $result['tourneyId'];

if($result){
    for($result; $tournoiID2 != 0; $tournoiID2 = $tournoiID2 - 1 ){
        
        $e = $db->prepare("SELECT * FROM tournament_t  WHERE tourneyId = :tourneyId AND logT = :logT AND stateT = :stateT");
        $e->execute(['tourneyId'=> $tournoiID2,'logT'=> $_SESSION['login'], 'stateT'=>1 ]);
        $result2 = $e->fetch();
        
        if($result2){
            echo "<div class=tourney><div class=PlaceImage style=background-image:url(css/img/$result2[sport].jpg)></div>";
            echo "<p id=color>$result2[nameT] ";
            echo "is a ";
            echo "$result2[sport] ";
            echo " tournament organized by ";
            echo "$result2[manager] ";
            echo "from "; echo "$result2[beginningDate] "; 
            echo "to "; echo "$result2[endingDate] "; 
            echo "in ";
            echo "$result2[location] ";
            $ID = $result2['tourneyId'];
            $TT = $result2['tourneyType'];
            $NumberTeam = $result2['NbTeam'];
            echo "<br/>";
            echo " (This tournament is closed to registrations) </p>";
            include 'include/LinkTourney.php';
            echo "</div>";
            
        }
    
    }
}
	
	$tournoiID3 = $result['tourneyId'];
	
	if($result){
    for($result; $tournoiID3 != 0; $tournoiID3 = $tournoiID3 - 1 ){
        
        $e = $db->prepare("SELECT * FROM tournament_t  WHERE tourneyId = :tourneyId AND logT = :logT AND stateT = :stateT");
        $e->execute(['tourneyId'=> $tournoiID3,'logT'=> $_SESSION['login'], 'stateT'=>2 ]);        
        $result2 = $e->fetch();
        
        if($result2){
            echo "<div class=tourney><div class=PlaceImage style=background-image:url(css/img/$result2[sport].jpg)></div>";
            echo "<p id=color>$result2[nameT] ";
            echo "is a ";
            echo "$result2[sport] ";
            echo " tournament organized by ";
            echo "$result2[manager] ";
            echo "from  "; echo "$result2[beginningDate] "; 
            echo "to "; echo "$result2[endingDate] "; 
            echo "in ";
            echo "$result2[location] </p> ";
			$NbPls = $result2['NbPls'];
			$NbTeam = $result2['NbTeam'];
            $ID = $result2['tourneyId'];
            $TT = $result2['tourneyType'];
            include 'include/ManageTourney.php';
            echo "</div>";
        }
    
    }
}
    
    $tournoiID4 = $result['tourneyId'];
	
	if($result){
    for($result; $tournoiID4 != 0; $tournoiID4 = $tournoiID4 - 1 ){
        
        $ee = $db->prepare("SELECT * FROM tournament_t  WHERE tourneyId = :tourneyId AND logT = :logT AND stateT = :stateT");
        $ee->execute(['tourneyId'=> $tournoiID4,'logT'=> $_SESSION['login'], 'stateT'=>3 ]);
        $result3 = $ee->fetch();
        
        if($result3){
            echo "<div class=tourney><div class=PlaceImage style=background-image:url(css/img/$result3[sport].jpg)></div>";
            echo "<p id=color>$result3[nameT] ";
            echo "is a ";
            echo "$result3[sport] ";
            echo " tournament organized by ";
            echo "$result3[manager] ";
            echo "from  "; echo "$result3[beginningDate] "; 
            echo "to "; echo "$result3[endingDate] "; 
            echo "in ";
            echo "$result3[location] </p> ";
			$NbPls = $result3['NbPls'];
			$NbTeam = $result3['NbTeam'];
            $ID = $result3['tourneyId'];
            $TT = $result3['tourneyType'];
            include 'include/ManageTourney.php';
            echo "</div>";
        }
    
    }
}
    
        $tournoiID5 = $result['tourneyId'];
	
	if($result){
    for($result; $tournoiID5 != 0; $tournoiID5 = $tournoiID5 - 1 ){
        
        $ee = $db->prepare("SELECT * FROM tournament_t  WHERE tourneyId = :tourneyId AND logT = :logT AND stateT = :stateT");
        $ee->execute(['tourneyId'=> $tournoiID5,'logT'=> $_SESSION['login'], 'stateT'=>4 ]);
        $result3 = $ee->fetch();
		
		$zz = $db->prepare("SELECT * FROM team_t  WHERE tourneyId = :tourneyId AND bracket = :bracket");
        $zz->execute(['tourneyId'=> $tournoiID5,'bracket'=> 1 ]);
        $Number = $zz->rowCount();
        
        if($result3){
            echo "<div class=tourney><div class=PlaceImage style=background-image:url(css/img/$result3[sport].jpg)></div>";
            echo "<p id=color>$result3[nameT] ";
            echo "is a ";
            echo "$result3[sport] ";
            echo " tournament organized by ";
            echo "$result3[manager] ";
            echo "from  "; echo "$result3[beginningDate] "; 
            echo "to "; echo "$result3[endingDate] "; 
            echo "in ";
            echo "$result3[location] </p> ";
			$NbPls = $result3['NbPls'];
			$NbTeam = $result3['NbTeam'];
            $ID = $result3['tourneyId'];
            $TT = $result3['tourneyType'];
            include 'include/ManageTourney2.php';
            echo "</div>";
        }
    
    }
}
    
    
	
?>
    </div>
</div>

<?php  include 'include/Footer.php'; ?>
