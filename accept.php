<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['sunwayID'])) {
  echo "<script> alert('Please login to your account before you visit. Thankyou!');";
echo "window.location.replace('login.php');</script>";
  exit(); //redirect user to login page
}


$sunwayID = $_SESSION['sunwayID'];
$password = $_SESSION['pass'];
$accountType = $_SESSION['accountType']; 



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/accept.css">
        <!-- Font awesome icon (links) -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/bell.css' rel='stylesheet'>
    <title>Pickup Service</title>
</head>
<body>

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

<!--pick up-->
<section class="pickup-section">
    <h1 class="PickupTitle">Pickup Service</h1>


<?php

include('DBconnect.php'); // Include database connection

    // Retrieve Food Order data
    function getFoodOrders($conn,$sunwayID) {
        $sql="SELECT a.Name, a.contactNo, b.*
              FROM account a, foodorder b
              WHERE b.accountID=a.accountID
              AND a.accountID != $sunwayID
              AND b.Status = 'pending'";
              
        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result); // Count data
        $foodOrders = array();

        if ($count > 0) 
        {
            while ($row = mysqli_fetch_assoc($result)){ 
                $foodOrders[] = $row; // Fetching values 
            }
        }

        return $foodOrders;
    }

    // Retrieve and display food order data
    $foodOrders = getFoodOrders($conn,$sunwayID);

    echo '<div class="order-container">';
    //  Order Content 
    echo '<div class="order-content">';

    if (!empty($foodOrders))
    {
        foreach ($foodOrders as $foodOrder)
        {
          

            $orderID = $foodOrder['OrderID'];
            $name = $foodOrder['Name'];
            $contactNo = $foodOrder['contactNo'];
            $date = date('j F Y',strtotime($foodOrder['Date']));
            $collectionTime = $foodOrder['CollectionTime'];
            $collectionLocation = $foodOrder['CollectionLocation'];
            $totalPrice = $foodOrder['totalPrice'];

            $collectionTime = date('g.i a',strtotime($collectionTime));

            echo '<div class="order-box">'; // Start the first Order row
            echo '<table class="order-detail">';
            echo '<tr>';
            echo      '<td>Date:</td>';
            echo      '<td>' . $date . '</td>';
            echo '</tr>';  
            echo '<tr>';
            echo      '<td>Name:</td>';
            echo      '<td>' . $name . '</td>';
            echo '</tr>';     
            echo '<tr>';
            echo      '<td>Contact No:</td>';
            echo      '<td>' . $contactNo . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo      '<td>Collection Time:</td>';
            echo      '<td>' . $collectionTime . '</td>';
            echo '</tr>';
   
            echo '<tr>';
            echo      '<td>Collection Location:</td>';
            echo      '<td>' . $collectionLocation . '</td>';
            echo '</tr>';

            echo '</table>';

            echo '<table class="order-detail">';
            echo '<thead>
                  <tr>
                    <th>Food Order</th>
                    <th>Shop</th>
                    <th>Price</th>
                  </tr>
                  </thead>';
              

            /* Retrieve Food Details */
            $sql="SELECT * 
                  FROM orderrecord
                  WHERE orderID='$orderID'";
            $result = mysqli_query($conn,$sql);
            $foodRecords = array();

            if  ($result)
            {
              $sql = "SELECT a.quantity, b.foodName, b.shopName, b.price
                      FROM orderrecord a, menu b
                      WHERE a.menuID=b.menuID
                      AND orderID = '$orderID';";
              $result = mysqli_query($conn,$sql);
              $count = mysqli_num_rows($result);

              if($count > 1){
                 while ($row = mysqli_fetch_assoc($result)){
                   $foodRecords[] = $row;
                 }

              }
              else{
                  $foodRecords[0] = mysqli_fetch_assoc($result);
              }
            }
            echo '<tbody>';

            foreach ($foodRecords as $foodRecord) 
            {
              $foodName = $foodRecord['foodName'];
              $quantity = $foodRecord['quantity'];
              $shopName = $foodRecord['shopName'];
              $price = $foodRecord['price'];

              echo '<tr>';
              echo '<td>'. $quantity . 'x ' . $foodName . '</td>';
              echo '<td>' . $shopName .'</td>';
              echo '<td>RM' . $price . '</td>';
              echo '</tr>';  
            }
            echo '<tr>
                  <td colspan="2">Delivery Fee Included:</td>
                  <td>RM4</td>
                  </tr>';
            echo '<tr>
                  <td colspan="2">Total Price:</td>
                  <td>RM' . $totalPrice . '</td>
                  </tr>';


            echo '</tbody>
                  </table>
                  <a onclick="acceptOrder(\'' . $orderID . '\')"><button class="accept-button">ACCEPT</button></a>
                  </div>';  
        }
        echo '</div>'; // Close the last column div
    }
    else{
        echo "<div class='emptyText'>";
        echo      "<p>You're up to date! No pending orders at the moment</p>";
        echo "</div>";
    }
    echo '</div>';

    //Get Order ID and User accept the order
    if (isset($_GET['orderID']))
    {
        $pickupID = "P" . $orderID;
        $pickupTime = date("Y-m-d H:i:s");

        $sql = "UPDATE foodorder 
                SET Status='accepted', RecordTime = '$pickupTime' 
                WHERE OrderID = '$orderID';";
        mysqli_query($conn,$sql);

        $sql = "INSERT INTO pickupservice (`PickupID`, `PickupStatus`,`Comment`, `AccountID`, `OrderID`) 
                VALUES ('$pickupID','processing','Your order has been accepted.','$sunwayID','$orderID');";
        $result = mysqli_query($conn,$sql);

        if ($result){
            echo '<script>
                    alert("Order accepted successfully!");
                    window.location.href="pickupProcess.php?orderID='.$orderID.'";  
                  </script>';

        }

    }
    
?>
        

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
<script>
    function acceptOrder(orderID) {
        // Confirm accept Order
        if (confirm('Are you sure you want to accept this order?')) {
            window.location.href = 'accept.php?orderID=' + orderID;
        }
    }

    function showNotification(){
      //Create a notification element
      const notification = document.createElement('div');
      notification.textContent = "New Order Available Now! Click here to reload.";
      notification.classList.add('notification');

      notification.addEventListener('click',function(){
        window.location.reload();
      });

      //Append the notification into body
      document.body.appendChild(notification);

      //Remove notification after 1mins
      setTimeout(function(){
        document.body.removeChild(notification);

      },60000);
    }

    function updateOrders(){
      var xhttp = new XMLHttpRequest();
      xhttp.onload = function()
      {
        if(this.status == 200){
          if (this.responseText.trim() === 'new_order'){
            showNotification();
            console.log('New Order Available');
          }
          else{
            console.error('No New Order Available');
          }
        }
        else{
          console.error('Failed to retrieve status server.');
        }
      };
      xhttp.open("GET","checkNewOrder.php?userID=<?php urlencode($sunwayID);?>");
      xhttp.send();
    }

    updateOrders();

    setInterval(updateOrders,10000);


</script>
</body>
</html>