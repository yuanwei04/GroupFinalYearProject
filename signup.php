<?php
session_start();

include("DBconnect.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $sunwayID = $_POST['sunwayID'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $cnum = $_POST['cnum'];
    $email = $_POST['email']; 
    $password = $_POST['pass'];
    $course = $_POST['course'];
    $intakeYear = $_POST['intakeYear'];

    // Check if email or sunwayID already exists in the database
    $check_query = "SELECT * FROM Account WHERE Email = '$email' OR AccountID = '$sunwayID'";
    $check_result = mysqli_query($conn, $check_query);
    if(mysqli_num_rows($check_result) > 0) {
        echo "<script type='text/javascript'> alert('Email or Sunway ID is already registered.')</script>";
    } else {
        // Neither email nor sunwayID exists, proceed with registration
        if(!empty($email) && !empty($password) && filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $hash_password = password_hash($password,PASSWORD_BCRYPT); 
            $query = "INSERT INTO Account (AccountID, Name, Gender, ContactNo, Email, Password, Course, IntakeYear) VALUES ('$sunwayID', '$name' ,'$gender', '$cnum', '$email', '$hash_password', '$course', '$intakeYear')";
            
            mysqli_query($conn, $query);
            
            echo "<script type='text/javascript'> alert('Successfully Registered'); window.location.href='login.php'</script>";
        }
        else{
            echo "<script type='text/javascript'> alert('Please Enter Valid Information')</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Login and Register</title>
    <!-- Font awesome icon (links) -->
      <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
      />
    <link rel="stylesheet" href="CSS/login.css">
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
            <a href="homepage.php"> Home </a>
          </li>
          <li>
            <span class="fa fa-bars" id="headIcon"></span>
            <a href="menu.php"> Menu </a>
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

    <div class="signup">
      <h1>Resgister Form</h1>
      <h4>It's free and only takes a minutes</h4>
      <form method="POST" id="registerform">
        <div class="data">
          <label for="" class="signup-label">Sunway ID:</label>
          <input type="text" name="sunwayID" required />
        </div>

        <div class="data">
          <label for="" class="signup-label">Name:</label>
          <input type="text" name="name" required />
        </div>

        <div class="data">
          <label for="" class="signup-label">Password:</label>
          <input type="password" name="pass" required />
        </div>

        <div class="data">
        <label for="" class="signup-label">Gender:</label>
          <div class="gender-radio">
            <input type="radio" id="male" name="gender" value="Male" checked />
            <label for="male">Male</label>

            <input type="radio" id="female" name="gender" value="Female" />
            <label for="female">Female</label>
          </div>
        </div>

        <div class="data">
          <label for="" class="signup-label">Email:</label>
          <input type="email" name="email" required />
        </div>
        
        <div class="data">
          <label for="" class="signup-label">Contact Number:</label>
          <input type="text" name="cnum" required />
        </div>

        <div class="data">
          <label for="" class="signup-label">Course:</label>
            <select id="course" name="course" required>
              <option value="">Select Course</option>
              <option value="Diploma In Computer Science">Diploma In Computer Science</option>
              <option value="Diploma In Information Technology">Diploma In Information Technology</option>
              <option value="Diploma In New Media">Diploma In Communication</option>
              <option value="Diploma In Business Administration">Diploma In Business Administration</option>
              <option value="Diploma In Accounting">Diploma In Accounting</option>
              <option value="Foundation In Accountancy (ACCA FIA)">Foundation In Accountancy (ACCA FIA)</option>
              <option value="Association of Chartered Certified Accountants (ACCA)">Association of Chartered Certified Accountants (ACCA)</option>
              <option value="Certificate In Business Studies">Certificate In Business Studies</option>
            </select>
        </div>

        <div class="data">
          <label for="" class="signup-label">Intake Year:</label>
          <input type="date" id="start" name="intakeYear" min="2018-03" value="2018-05" required />
        </div>

        <div class="registerbtn">
          <div class="inner"></div>
          <input type="submit" name="" value="Register" />
        </div>
      </form>
      <div class="login-here">
        <p>By clicking the Sign Up button, you agree to our<a href="aboutUs.php"><br>Term and Condition</a> and<a href="aboutUs.php">Policy Privacy</a></p>
        <p>Already have an account? <a href="login.php">Login Here</a></p>
      </div>
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
