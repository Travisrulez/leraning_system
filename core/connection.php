<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$servername = "localhost";
$username = "root"; 
$password = "root"; 
$dbname = "search_teacher"; 

$con = mysqli_connect($servername, $username, $password, $dbname);
if (!$con) {    
    die("Connection failed: " . mysqli_connect_error());
}

?>