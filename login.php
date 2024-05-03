<?php
session_start();
include("DBconnect.php");

// Initialization
$sunwayID = "";
$password = "";

if (isset($_POST['submit'])) {
    if (!empty($_POST['sunwayID']) && !empty($_POST['pass'])) {
        $sunwayID = $_POST['sunwayID'];
        $password = $_POST['pass'];

        $sql = "SELECT * FROM Account WHERE AccountID = '$sunwayID'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $count = mysqli_num_rows($result);
            if ($count == 1) {
                $row = mysqli_fetch_assoc($result);
                if (password_verify($password,$row['Password'])) {
                    $_SESSION['loginSuccess'] = true;
                    if ($row['AccountType'] == "Admin") {
                        $_SESSION['sunwayID'] = $row['AccountID'];
                        $_SESSION['pass'] = $row['Password'];
                        $_SESSION['accountType'] = $row['AccountType'];
                        header("Location: AdminPanel.php");
                        exit();
                    } else {
                        $_SESSION['sunwayID'] = $row['AccountID'];
                        $_SESSION['pass'] = $row['Password'];
                        $_SESSION['accountType'] = $row['AccountType'];
                        header("Location: homepage.php");
                        exit();
                    }
                } else {
                    $passerror = "Incorrect password";
                }
            } else {
                $errormsg = "Sunway ID not found";
            }
        } else {
            // Handle database query error
            $errormsg = "Error occurred while retrieving data from the database";
        }
    } else {
        // Handle empty fields
        if (empty($_POST['sunwayID'])) {
            $userIDError = "Sunway ID is required";
        }
        if (empty($_POST['pass'])) {
            $passerror = "Password is required";
        }
    }
}
?>


<!--Header-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Form Login and Register</title>
    <link rel="stylesheet" href="CSS/login.css"/>
    <!-- Font awesome icon (links) -->
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <script>function showMessage(message) {alert(message);}</script>
</head>
<body>
<script>
      const toggle = () => {
        document.getElementById("nav").classList.toggle("navactive");
      };
    </script>

    <header>
      <div class="brand">
        <span class="fa fa-cutlery"></span>
        <h1>Food Pickup Service</h1>
      </div>

      <span class="fa fa-bars" id="menuIcon" onclick="toggle()"></span>

      <div class="navbar" id="nav">
        <ul>
          <li>
            <span class="fa fa-home" id="headIcon"></span>
            <a href="homepage.php">Home </a>
          </li>
          <li>
            <span class="fa fa-bars" id="headIcon"></span>
            <a href="Menu.php"> Menu </a>
          </li>
          <li>
            <span class="fa fa-crosshairs" id="headIcon"></span>
            <a href="accept.php"> Pickup </a>
          </li>
          <li>
            <span class="fa fa-user-circle" id="headIcon"></span>
            <a href="Account.php"> Profile </a>
          </li>
          <li>
            <span class="fa fa-question-circle" id="headIcon"></span>
            <a href="aboutUs.php"> Help </a>
          </li>
          <li>
            <span class="fa fa-sign-out" id="headIcon"></span>
            <a href="logout.php"> Signout </a>
          </li>
        </ul>
      </div>
    </header>


<!--Login Form-->
<div class="login">
    <h1 id="title">Login To Your Account</h1>
    <p id="subtitle">Login with Your Sunway ID to login </p>
    <form method="POST" id="loginform">
        <label for="" class="sunwaylabel">Sunway ID:</label>
        <input type="text" name="sunwayID" placeholder="Enter your Sunway ID" value="<?= !empty($sunwayID) ? $sunwayID : '' ?>" />

        <?php if (!empty($userIDError)) echo "<p class='error'>$userIDError</p>"; ?>

        <label for="" class="passwordlabel">Password:</label>
        <input type="password" name="pass" placeholder="Enter your password"/>

        <?php if (!empty($passerror)) echo "<p class='error'>$passerror</p>"; ?>
        <?php if (!empty($errormsg)) echo "<p class='error'>$errormsg</p>"; ?>

        <input type="submit" class="loginbtn" name="submit" value="Login"/>
    </form>
    <p class="psignup">Not have an account? <a href="signup.php">Sign Up here</a></p>
</div>


<!-- Footer -->
<dl class="footer-container">
      <section class="footer">
        <h4>Sunway College Food Pickup Service</h4>
        <p>
        Welcome to Sunway Pickup Service! For further information can check on below!
        </p>
        <div class="footer-ul">
          <ul>
            <li><a href="aboutUs.php">About Us</a></li>
            <li><a href="aboutUs.php">Term of Use</a></li>
            <li><a href="aboutUs.php">Privacy Policy</a></li>
            <li><a href="aboutUs.php">How do I pay for my food?</a></li>
          </ul>
        </div>
        <br />
        <div class="icons">
          <a href="https://www.facebook.com/" target="blank"
            ><i class="fa fa-facebook"></i
          ></a>
          <a href="https://www.twitter.com/" target="blank"
            ><i class="fa fa-twitter"></i
          ></a>
          <a href="https://www.instagram.com/" target="blank"
            ><i class="fa fa-instagram"></i
          ></a>
        </div>
        <p>Restaurant Location</p>
        <hr />
        <p>
          Sunway Velocity Level 3. Lot B31-34 <br />Sunway Pyramid Level 5, Lot
          B 101-106
        </p>
        <p>Made with <i class="fa fa-heart-o"></i> by Ernest Group</p>
      </section>
    </dl>
</body>
</html>
