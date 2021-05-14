<?php 
require_once 'core/connection.php';
session_start();
$tid = $_SESSION['t_id'];
mysqli_query($con, "DELETE FROM teacher_cards WHERE id = '".$_GET['del_card']."'");
header('location: teacher.php');
?>