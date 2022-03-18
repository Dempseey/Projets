<form method="post">
    <input type="submit" id="Detail" name="<?php echo "Detail$IdTeam"; ?>"  value="Team Detail">
</form><br/><br/><br/>

<?php

    $Detail = "Detail$IdTeam";
    if(isset($_POST[$Detail])){
        echo "<table id = table>";
        echo "<tr id = tablecolor >";
        echo "<td> Level </td>";
        echo "<td> Phone </td>";
        echo "<td> Address </td>";
        echo "<td> PlayerList </td>";
        echo "</tr>";
        echo "<tr id = tablecolor>";
        echo "<td> $result[levelT] </td>";
        echo "<td> 0$result[phone] </td>";
        echo "<td> $result[address] </td>";
        echo "<td> $result[playerList] </td>";
        echo "</tr>";
        echo "</table>";
        
    }
?>