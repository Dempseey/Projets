<?php
header('Location: ../HomePage.php');
session_start();
unset($_SESSION);
unset($_COOKIE);
session_destroy();

?>
