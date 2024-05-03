<?php 
session_start();

include "DBconnect.php";
$sunwayID = $_SESSION['sunwayID'];
$orderID = "";

if(isset($_GET['orderID'])){
  $orderID = $_GET['orderID'];
}

if(isset($_GET['action']) && $_GET['action'] === "cancel"){
  $orderID = $_GET['orderID'];

  $sql="UPDATE FoodOrder SET Status = 'cancel' WHERE OrderID = '$orderID'";
  $result = mysqli_query($conn,$sql);

  if($result){
    echo '<script>
            alert("Your order has been cancel!");
            window.location.href="homepage.php";
          </script>';
  }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no"
    />
    <link rel="stylesheet" href="CSS/waitingProcess.css" />
    <link rel="stylesheet" href="CSS/header&footer.css" />
    <!-- Font awesome icon (links) -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    
    <title>Document</title>
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

    <!--Waiting Process-->
    <section class="waitingProcess">
      <div class="waitingProcess__container">
        <p>Waiting for your Delivery Guy to accept</p>
        <br />
        <p>(Will be auto cancel after 5 minutes, if nobody is accept)</p>
      </div>
      <div class="button">
          <a href="waitingProcess.php?action=cancel&orderID=<?php echo $orderID?>"><button id="cancelButton">Cancel</button></a>
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
        //Create a notification element
        const notification = document.createElement('div');
        notification.textContent = "Your order has been accepted! Click to view your order.";
        notification.classList.add('notification');

        notification.addEventListener('click',function(){
          window.location.href = "preparing.php?orderID=" + orderID;
        });

        //Append the notification into body
        document.body.appendChild(notification);

        //Remove notification after 1mins
        setTimeout(function(){
          document.body.removeChild(notification);

        },60000);
      }

      function orderAccept(){
        var xhttp = new XMLHttpRequest();
        xhttp.onload = function()
        {
          if(this.status == 200){
            // Split the response by the delimiter (;)
            var responseParts = this.responseText.split(';');
            var status = responseParts[responseParts.length - 1].trim();
            if (status === 'order_accepted'){
              // If there are multiple response parts, the first one is the OrderID
              if (responseParts.length > 1) {
                    var orderID = responseParts[0].trim();
                    showNotification(orderID);
                    console.log('Order (ID: ' + orderID + ') has been accepted');
                } else {
                    console.error('No OrderID found in the response');
                }
            }
            else{
              console.error('No Order has been accepted');
            }
          }
          else{
            console.error('Failed to retrieve status server.');
          }
        };
        xhttp.open("GET","checkOrderAccepted.php?userID=<?php echo urlencode($sunwayID);?>");
        xhttp.send();
      }

      orderAccept();

      setInterval(orderAccept,10000);

    </script>
  </body>
</html>
