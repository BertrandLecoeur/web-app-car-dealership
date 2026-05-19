<?php
session_start();

$_SESSION["isconnect"] = 0; 
header('Location: compte.PHP'); //redirection vers compte.PHP
exit; 
?>
