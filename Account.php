<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['sunwayID'])) {
  echo "<script> alert('You need to log in to access the profile page.');";
echo "window.location.replace('login.php');</script>";
  exit(); //redirect user to login page
}


?>
<!--Header-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />
    <!-- Font awesome icon (links) -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <!-- Styling css file -->
    <link rel="stylesheet" href="CSS/header&footer.css" />
    <link rel="stylesheet" href="CSS/Account.css" />
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




<!--Main Content-->
<?php
require_once 'DBconnect.php';

$UserID = $_SESSION['sunwayID'];
$Password = $_SESSION['pass'];
$status = "";

$sql = "SELECT Name, Gender, Email, ContactNo, Course, IntakeYear FROM Account WHERE AccountID = '$UserID'";
$user_results = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($user_results)) {
    $Name = $row['Name'];
    $Gender = $row['Gender'];
    $Email = $row['Email'];
    $ContactNo = $row['ContactNo'];
    $Course = $row['Course'];
    $IntakeYear = $row['IntakeYear'];
?>

<div class="MainContent">
    <div class="Account">
        <!-- Icon -->
        <div class="icon">
            <i class="fa fa-user" aria-hidden="true"></i>
        </div>
        <ul>
            <li><text>User ID: <?=$UserID?></text></li>
            <li><text>Name: <?=$Name?></text></li>
            <li><text>Gender: <?=$Gender?></text></li>
            <li><text>Email: <?=$Email?></text></li>
            <li><text>ContactNo: <?=$ContactNo?></text></li>
            <li><text>Course: <?=$Course?></text></li>
            <li><text>IntakeYear: <?=$IntakeYear?> </text></li>
        </ul>
    <!-- Add button to trigger edit form pop-up -->
    <button class="editbtn" onclick="showEditForm()">Edit Profile</button>
    </div>

    <!-- Pop-up Edit form -->
    <div id="editFormContainer" class="edit-form-container" style="display: none;">
        <div class="edit-form-content">
        <span class="close" id="closeEditForm" onclick="closeEditForm()">&times;</span>
            <h2>Update Personal Details</h2>
            <form action="editAcc.php" method="post" id="editForm">
                <!-- Edit form fields -->
                <label for="UserID"><b>User ID:  (User ID cannot be change when user is logined)</b></label>
                    <input type="text" name="UserID" placeholder="Enter Your new ID" value="<?= $UserID ?>" disabled><br>
			          <label for="name"><b>Name:</b></label>
                    <input type="text" name="Name" placeholder="Enter your new name" value="<?= $Name ?>" ><br>
                <label for="Gender" class="Gender"><b>Gender:</b></label>
                <div class="gender-radio">
                    <input type="radio" id="male" name="gender" value="Male" <?=($Gender === 'Male') ? 'checked' : ''?>>
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender" value="Female" <?=($Gender === 'Female') ? 'checked' : ''?>>
                    <label for="female">Female</label>
                </div>
                <label for="Email"><b>Email:</b></label>
                    <input type="email" name="Email" placeholder="Enter your new email" value="<?= $Email ?>" required><br>
                <label for="ContactNo"><b>Contact No:</b></label>
                    <input type="text" name="ContactNo" placeholder="Enter your new contact no" value="<?= $ContactNo ?>" required><br>
                <label for="Course" class="Course"><b>Course:</b></label>
                    <select id="course" name="course" required>
                        <option value="<?= $Course ?>"><?= $Course ?></option>
                        <option value="Diploma In Computer Science">Diploma In Computer Science</option>
                        <option value="Diploma In Information Technology">Diploma In Information Technology</option>
                        <option value="Diploma In New Media">Diploma In Communication</option>
                        <option value="Diploma In Business Administration">Diploma In Business Administration</option>
                        <option value="Diploma In Accounting">Diploma In Accounting</option>
                        <option value="Foundation In Accountancy (ACCA FIA)">Foundation In Accountancy (ACCA FIA)</option>
                        <option value="Association of Chartered Certified Accountants (ACCA)">Association of Chartered Certified Accountants (ACCA)</option>
                        <option value="Certificate In Business Studies">Certificate In Business Studies</option>
                    </select><br>
                <label for="IntakeYear" class="IntakeYear"><b>Intake Year:</b></label>
                    <input type="date" id="start" name="intakeYear" value="<?= $IntakeYear ?>" required ><br>
			          <label for="password"><b>Password:</b></label>
                    <input type="password" name="Password" placeholder="Enter your new password" >
                <!-- Change button type to "button" to prevent automatic form submission -->
                <button class="updatebtn" name="submit" id="updateBtn" type="submit" onclick="editAcc()"><strong>SAVE CHANGES</strong></button>
        </form>
        </div>
    </div>
</div>

<!-- JavaScript to show the edit form when the button is clicked -->
<script>
    function showEditForm() {
        document.getElementById('editFormContainer').style.display = 'block';
    }

    function closeEditForm() {
        document.getElementById('editFormContainer').style.display = 'none';
    }
    function submitForm() {
    document.getElementById("editAcc.php").submit();
}

</script>

<?php } ?>

<div class="Order Status">
</div>
<div class="pickup-history">
    <h2>Order History</h2> 

<!-- View -->
<?php
$mysql = "SELECT fo.OrderID, fo.Date, fo.CollectionTime, fo.CollectionLocation, fo.Status, fo.totalPrice, ps.pickupStatus
          FROM foodorder fo
          LEFT JOIN pickupservice ps ON fo.OrderID = ps.OrderID
          WHERE fo.Status != 'cancel'
          AND fo.AccountID = '$UserID'
          AND (fo.Status != 'accepted' OR ps.pickupStatus IS NOT NULL)";

$user_history = mysqli_query($conn,$mysql); 

if (mysqli_num_rows($user_history) > 0) {
    echo "<table class='reqTable'>";
    echo "<tr>
            <th>Date</th>
            <th>Collection Time</th>
            <th>Collection Location</th>
            <th>Status</th>
            <th>Total Price</th>
            <th>View</th>
          </tr>";

    while ($record = mysqli_fetch_array($user_history)) {
        echo "<tr>";
        echo "<td>" . $record['Date'] . "</td>";
        echo "<td>" . $record['CollectionTime'] . "</td>";
        echo "<td>" . $record['CollectionLocation'] . "</td>";
        if ($record['pickupStatus'] == null) {
          echo "<td>" . $record['Status'] . "</td>";
      } else {
          echo "<td>" . $record['pickupStatus'] . "</td>";
      }
        echo "<td>" . $record['totalPrice'] . "</td>";
        if($record['pickupStatus'] == 'collected' || $record['pickupStatus'] == 'processing'){
          $destinationPage = "preparing.php";
        }
        else if($record['pickupStatus'] == 'completed'){
          $destinationPage = "orderDetails.php";
          $status = "order";
        }
        else{
          $destinationPage = "waitingProcess.php";
        }
        // Pass the OrderID to the order process page
        echo "<td><a href='$destinationPage?orderID=". $record['OrderID']."&status=$status'><i class='fa fa-info-circle' style='color:#252525'></i></a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No donation history found.";
}
?>
</div>

<div class="pickup-history">
    <h2>Pickup History</h2>

<!-- View -->
<?php
$mysql = "SELECT fo.OrderID, fo.Date, fo.CollectionTime, fo.CollectionLocation, fo.Status,fo.totalPrice
          FROM foodorder fo, pickupservice ps 
          WHERE fo.OrderID = ps.OrderID
          AND ps.AccountID = '$UserID'
          AND fo.Status != 'cancel'";
$user_history = mysqli_query($conn,$mysql); 

if (mysqli_num_rows($user_history) > 0) {
    echo "<table class='reqTable'>";
    echo "<tr>
            <th>Date</th>
            <th>Collection Time</th>
            <th>Collection Location</th>
            <th>Status</th>
            <th>Total Price</th>
            <th>View</th>
          </tr>";

    while ($record = mysqli_fetch_array($user_history)) {
        echo "<tr>";
        echo "<td>" . $record['Date'] . "</td>";
        echo "<td>" . $record['CollectionTime'] . "</td>";
        echo "<td>" . $record['CollectionLocation'] . "</td>";
        echo "<td>" . $record['Status'] . "</td>";
        echo "<td>" . $record['totalPrice'] . "</td>";
        if($record['Status'] == 'done'){
          $destinationPage = "orderDetails.php";
          $status="pickup";
        }
        else{
          $destinationPage = "pickupProcess.php";
        }
        // Pass the OrderID to the order process page
        echo "<td><a href='$destinationPage?orderID=". $record['OrderID']."&status=$status'><i class='fa fa-info-circle' style='color:#252525'></i></a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No donation history found.";
}
?>
</div>



<!-- Footer -->
    <dl class="footer-container">
      <section class="footer">
        <h4>Sunway College Food Pickup Service</h4>
        <p>
        Welcome to Sunway Pickup Service! For further information can check on below.
        </p>
        <div class="footer-ul">
          <ul>
            <li><a href="aboutUs.php">About Us</a></li>
            <li><a href="aboutUs.php">Term of Use</a></li>
            <li><a href="aboutUs.php">Privacy Policy</a></li>
            <li><a href="aboutUs.php">How do I pay for my food?</a></li>
          </ul>
        </div>
        <br>
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
    <script src="js/profile.js"></script>
  </body>
</html>