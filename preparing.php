<?php
session_start();
include "DBconnect.php";

$orderStatus = "";
$orderID = "";
if(isset($_GET['orderID'])){
  $orderID = $_GET['orderID'];
}
  // Fetch order status
  $queryStatus = "SELECT PickupStatus FROM PickupService WHERE OrderID = '$orderID'";
  $resultStatus = mysqli_query($conn, $queryStatus);
  if ($resultStatus && mysqli_num_rows($resultStatus) > 0) {
    $rowStatus = mysqli_fetch_assoc($resultStatus);
    $orderStatus = $rowStatus['PickupStatus'];
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
    <link rel="stylesheet" href="CSS/preparing.css" />
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

    <!--Preparing-->
    <section class="preparing">
      <div class="preparing__container">
        <?php if($orderStatus == 'collected') {?>
        <p>Your food is On the Way!</p>
        <?php } 
        else { ?>
          <p>Wait for your delivery guy to meet up with you</p>
        <?php }?>
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


            $query = "SELECT Menu.FoodName, Menu.Price, OrderRecord.Quantity 
                      FROM Menu 
                      JOIN OrderRecord ON Menu.MenuID = OrderRecord.MenuID
                      JOIN FoodOrder ON OrderRecord.OrderID = FoodOrder.OrderID
                      WHERE FoodOrder.OrderID = '$orderID';";
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
              $total += $subtotal; // Add subtotal to total
              $counter++; // Increment row counter
            }
            // Calculate delivery fee
            $deliveryFee = 4; // RM4 for delivery fee
            $total += $deliveryFee; // Add delivery fee to total
            
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
          

          if(isset($_GET['action']))
          {
            if($_GET['action'] === "orderReceive"){
              $orderID = $_GET['orderID'];
        
              $sql = "UPDATE FoodOrder SET Status = 'done' WHERE OrderID = '$orderID'";
              $result = mysqli_query($conn,$sql);
        
              if($result){
                echo '<script>
                        alert("Thank you for using our pickup service! Hope to see you soon.");
                        window.location.href="homepage.php";
                      </script>';
              }
            }
            
          }
          ?>
        </tbody>
        </table>
          <div class="button">
          <?php if($orderStatus == 'collected') {?>
            <a href="preparing.php?action=orderReceive&orderID=<?php echo $orderID?>"><button class="order-received">Order Received</button></a>
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
    <script> 
      function showNotification(orderID){
        const notification = document.createElement('div');
        notification.textContent = "Your order has been placed! Click here to reload.";
        notification.classList.add('notification');

        notification.addEventListener('click',function(){
          window.location.href="preparing.php?orderID=" + orderID;
        });

        document.body.appendChild(notification);

        setTimeout(function(){
          document.body.removeChild(notification);
        },60000);
      }

      function showNotificationCancel(){
        const notification = document.createElement('div');
        notification.textContent = "Your order has been cancel. The pickup person will come look for you to return the money.";
        notification.classList.add('notification');

        notification.addEventListener('click',function(){
          window.location.href="homepage.php";
        });

        document.body.appendChild(notification);

        setTimeout(function(){
          document.body.removeChild(notification);
        },60000);
      }

      
      function orderPlaced(){
        var xhttp = new XMLHttpRequest();
        xhttp.onload = function ()
        {
          if(this.status == 200){
            var responseParts = this.responseText.split(';');
            var status = responseParts[responseParts.length - 1].trim();
            if(status === 'order_placed'){
              if(responseParts.length > 1){
                var orderID = responseParts[0].trim();
                showNotification(orderID);
                console.log('Order has been placed.');
              }
              else{
                console.error('No OrderID found in the response');
              }
            }
            else{
              console.error('No Order has been placed');
            }
          }
          else{
            console.error('Failed to retrieve status server.');
          }

        };
        xhttp.open("GET","checkOrderPrepared.php?orderID=<?php echo urlencode($orderID)?>");
        xhttp.send();
      }

      function checkForCancel(){
      var xhttp = new XMLHttpRequest();
      xhttp.onload = function()
      {
        if(this.status == 200){
          if (this.responseText.trim() === 'cancel'){
            showNotificationCancel();
            console.log('Order has been Cancel');
          }
          else{
            console.error('Order has not been cancel');
          }
        }
        else{
          console.error('Failed to retrieve status server.');
        }
      };
      xhttp.open("GET","checkOrderCancel.php?orderID=<?php echo urlencode($orderID);?>");
      xhttp.send();
    }

      orderPlaced();
      checkForCancel();

      setInterval(orderPlaced,10000);
      setInterval(checkForCancel,10000);
    </script>
  </body>
</html>

