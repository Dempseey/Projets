<?php 

$a = $db->prepare("SELECT * FROM tournament_t WHERE logT = :logT ORDER BY tourneyId DESC");
$a->execute(['logT'=> $_SESSION['login']]);
$result = $a->rowCount();

$result2 = $a->fetch();
$ID = $result2['tourneyId'];
$date = date("Y-m-d");

$Progress = 0; $End = 0; $NotStart = 0;

for($i= $ID; $i > 0; $i--){
    
    $b = $db->prepare("SELECT * FROM tournament_t WHERE logT = :logT AND tourneyId = $i");
    $b->execute(['logT'=> $_SESSION['login']]);
    $result2 = $b->fetch();
    
    if($result2['beginningDate'] < $date && $result2['endingDate'] > $date){
       $Progress = $Progress+1; 
    }
    
    if($result2['endingDate'] < $date){
        $End = $End+1;
    }
    
    if($result2['beginningDate'] > $date){
        $NotStart = $NotStart+1;
    }
}

?>

<p>Number of tournaments created : <strong><?php echo $result?></strong></p>
<p>Number of tournaments in progress : <strong><?php echo $Progress?></strong></p>
<p>Number of finished tournaments : <strong><?php echo $End?></strong></p>
<p>Number of tournaments not started : <strong><?php echo $NotStart?></strong></p>
