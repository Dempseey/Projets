<?php
    define('HOST','localhost');  
    define('DB_NAME','tourney');  //La base de donnée s'appelle "tourney"
    define('USER','root');
    define('PASS','');

try{
    $db = new PDO("mysql:host=". HOST .";dbname=" . DB_NAME, USER, PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo $e;
}


?>