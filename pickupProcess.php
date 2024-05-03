<?php
  session_start();
  include "DBconnect.php";

  $sunwayID = $_SESSION['sunwayID'];
  include("DBconnect.php");

  if(isset($_GET['orderID'])){
    $orderID=$_GET['orderID'];
  }

  if(isset($_GET['action']) && $_GET['action'] === "pickup"){
    $pickupTime = date('Y-m-d H:i:s');
    $sql="UPDATE PickupService SET PickupStatus = 'collected', PickupTime = '$pickupTime' 
          WHERE OrderID = '$orderID'";
    $result = mysqli_query($conn,$sql);

    if($result){
      echo '<script>
            alert("You have updated the pickupstatus! User has been notify order is placed.");
            window.location.href="pickupProcess.php?orderID='.$orderID.'";
          </script>';
    }
  }

  if(isset($_GET['action']) && $_GET['action'] === "orderSent"){
    $sql="UPDATE PickupService SET PickupStatus = 'completed' WHERE OrderID = '$orderID'";
    $psresult = mysqli_query($conn,$sql);

    $sql ="UPDATE foodOrder SET Status = 'done' WHERE OrderID = '$orderID'";
    $foresult = mysqli_query($conn,$sql);

    if($psresult && $foresult){
      echo '<script>
            alert("Thank you for offering your service!");
            window.location.href="homepage.php";
          </script>';
    }
  }

  if(isset($_GET['action']) && $_GET['action'] == "cancel"){
    $sql="UPDATE PickupService SET PickupStatus = 'cancel' WHERE OrderID = '$orderID'";
    $psresult = mysqli_query($conn,$sql);

    $sql ="UPDATE foodOrder SET Status = 'cancel' WHERE OrderID= '$orderID'";
    $foresult = mysqli_query($conn,$sql);

    if($psresult && $foresult){
      echo '<script>
            alert("You have cancel the order! Please look for the order person and return the money.");
            window.location.href="homepage.php";
          </script>';
    }
  }
            
  //Set up Button Type
            
  $sql = "SELECT PickupStatus FROM PickupService WHERE OrderID = '$orderID'";          
  $result = mysqli_query($conn, $sql);           
  if ($result && mysqli_num_rows($result) > 0) {              
    $row = mysqli_fetch_assoc($result);          
    $pickupStatus = $row['PickupStatus'];
                
    // Check if PickupStatus is 'collected'
    if ($pickupStatus == 'collected') {
      // Change the button text to 'Order Sent'
      $buttonText = 'Order Sent';
      $buttonLink = "pickupProcess.php?action=orderSent&orderID=$orderID"; // Set the link for 'Order Sent' action if needed
      } 
      else {
      // Default button text for 'Pick Up'
      $buttonText = 'Order Placed';
      $buttonLink = "pickupProcess.php?action=pickup&orderID=$orderID"; // Link for 'Pick Up' action
      }
    } 
    else {
      echo "Error: Unable to fetch PickupStatus.";
    }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Font awesome icon (links) -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <title>Document</title>
    <link rel="stylesheet" href="CSS/pickupProcess.css" />
    <link rel="stylesheet" href="CSS/header&footer.css" />
  </head>
  <body>
    <!--Header-->
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
            <a href="#"> Home </a>
          </li>
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

    <?php
    $collectionLocation = "";
    $name = "";
    $contactNo = "";

    
    // Fetch account information from the database
    $query = "SELECT fo.CollectionLocation, a.Name, a.ContactNo, a.AccountType
              FROM FoodOrder fo
              JOIN Account a ON fo.AccountID = a.AccountID
              WHERE fo.OrderID = '$orderID';";
    $result = mysqli_query($conn, $query);
    
    // Check if query was successful
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the row
        $row = mysqli_fetch_assoc($result);
    
        // Assign values to variables
        $collectionLocation = $row['CollectionLocation'];
        $name = $row['Name'];
        $contactNo = $row['ContactNo'];
    } else {
        echo "Error: Unable to fetch account information.";
    }
    ?>
    
    <!--Preparing-->
    <section class="preparing">
      <div class="preparing__container">
        <h3>Order Details:</h3>
        <br />
        <!-- Display account name, contact number, and account type -->
        <p>Name: <?php echo $name; ?></p>
        <p>Contact Number: <?php echo $contactNo; ?></p>
        <p>Collection Location:<?php echo $collectionLocation; ?></p>
        <br>
      </div>
    </section>

    <section class="receipt">
      <div class="receipt__container">
        <table id="receipt-table">
          <thead>
            <tr>
              <td class=""><strong>No</strong></td>
              <td class=""><strong>Food Name</strong></td>
              <td class=""><strong>Price</strong></td>
              <td class=""><strong>Quantity</strong></td>
              <td class=""><strong>Total</strong></td>
            </tr>
          </thead>
        <tbody>

          <?php
          // Initialize variables
          $total = 0;
          $counter = 1;

          // Fetch data from the database
          $query = "SELECT Menu.FoodName, Menu.Price, OrderRecord.Quantity
          FROM Menu
          JOIN OrderRecord ON Menu.MenuID = OrderRecord.MenuID
          JOIN FoodOrder ON OrderRecord.OrderID = FoodOrder.OrderID
          WHERE FoodOrder.OrderID = '$orderID'";
          $result = mysqli_query($conn, $query);

          // Check if query was successful
          if ($result) {
          // Loop through the result set and create HTML table rows
          while ($row = mysqli_fetch_assoc($result)) {
            // Populate table rows with data from the database
            echo "<tr>";
            echo "<td>{$counter}</td>";
            echo "<td>{$row['FoodName']}</td>";
            echo "<td>RM {$row['Price']}</td>";
            // Retrieve quantity from the database
            $quantity = $row['Quantity'];
            echo "<td>{$quantity}</td>";
            // Calculate subtotal
            $subtotal = $row['Price'] * $quantity;
            echo "<td>RM {$subtotal}</td>";
            // Add more columns if needed
            echo "</tr>";
            $total += $subtotal; 
            $counter++; 
          }
          // Calculate delivery fee
          $deliveryFee = 4; 
          $total += $deliveryFee;
          
          // Display the final total
          echo "<tr>";
          echo "<td colspan='4'><strong>Delivery Fee</strong></td>";
          echo "<td><strong>RM {$deliveryFee}</strong></td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td colspan='4'><strong>Final Total</strong></td>";
          echo "<td><strong>RM {$total}</strong></td>";
          echo "</tr>";
          } else {
          // Handle the case when the query fails
          echo "Error: " . mysqli_error($conn);
          }
          
          // Close database connection
            mysqli_close($conn);
          ?>
        </tbody>
        </table>
          <div class="button">
          <a href="<?php echo $buttonLink?>"><button class="order-received" id="pickupButton"><?php echo $buttonText?></button></a>
          <?php if($pickupStatus != "collected") {?>
          <a href="pickupProcess.php?action=cancel&orderID=<?php echo $orderID?>"><button class="cancel-button">Cancel</a>
          <?php }?>
          </div>
      </div>
    </section>

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
  </body>
</html>
