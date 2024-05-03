<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['sunwayID'])) {
    echo "<script> alert('You need to be logged in to be able to logout! Try logging in first, thank you.');";
  echo "window.location.replace('login.php');</script>";
    exit(); //redirect user to login page
 }

  

// Destroy the session
session_unset();
session_destroy();

// Redirect to login page
header("Location: login.php");
exit();
?>
