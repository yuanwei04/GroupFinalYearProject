<?php
$conn= mysqli_connect("localhost", "root", "", "studentpickupservice"); 
 
if (!$conn){
    die("Connection failed:".mysqli_connect_error());
}
?>
