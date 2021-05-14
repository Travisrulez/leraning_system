<?php 
$fname = $_FILES['file']['name'];
$temp = $_FILES['file']['tmp_name'];
$fsize = $_FILES['file']['size'];
$extension = explode('.',$fname);
$extension = strtolower(end($extension));  
$fnew = uniqid().'.'.$extension;
$store = "img/teachers/".basename($fnew);  
if($extension == 'jpg'||$extension == 'png'||$extension == 'gif') {
  $sqql = "UPDATE teachers SET img='$fnew' WHERE id = '$tid'";
  mysqli_query($con, $sqql); 
  move_uploaded_file($temp, $store);
} 
?>