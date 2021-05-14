<?php
session_start(); 
session_destroy(); 
$url = 'signin.php';
header('Location: ' . $url); 

?>