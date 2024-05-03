<?php
session_start();
$sunwayID = $_SESSION['sunwayID'];
$password = $_SESSION['pass'];
$accountType = $_SESSION['accountType']; 

// Check if the user is logged in
if (!isset($_SESSION['sunwayID'])) {
  echo "<script> alert('Please login to your account before you visit. Thankyou!');";
echo "window.location.replace('login.php');</script>";
  exit(); //redirect user to login page
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no"
    />
    <!-- Font awesome icon (links) -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />

    <!-- Styling css file -->
    <link rel="stylesheet" href="CSS/homepage.css" />
    <title>Home Page</title>
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

    <!--Home page-->
    <section class="home fade-in" id="home">
      <div class="logo"></div>
      <div class="homepage">
        <h3>Welcome to Sunway Velocity @ College</h3>
        <span>Pick Up Service</span>
        <h4>Not enough time to grab your lunch meals?</h4>
        <p>Order food here, and we'll handle the rest!</p>
        <a href="Menu.php" class="btn">Order Now</a>
      </div>
    </section>

    <!-- Address -->
    <section class="address fade-in" id="address">
      <div class="title">
        <h3>Address</h3>
        <h4>SUNWAY COLLEGE @Velocity (DK265-01(W))</h4>
        <p>
          V01-06-01, Lingkaran SV, <br />Sunway Velocity, <br />55100 Kuala
          Lumpur
        </p>
      </div>
      <div class="address-content">
        <div class="open-hours">
          <h3>Operating Hours</h3>
          <ul>
            <li><strong>Monday - Friday:</strong> 9:00 AM - 6:00 PM</li>
            <li><strong>Saturday:</strong> 10:00 AM - 4:00 PM</li>
            <li><strong>Sunday:</strong> Closed</li>
          </ul>
          <div class="contact_us">
            <h3>Contact Us</h3>
            <p>Tel:</p>
            <a href="tel:+60397701155">+6 03 9770 1155</a> <br><br>

            <p>Email:</p>
            <a href="mailto:SunwayCollegeVelocity@gmail.com">SunwayCollege@Velocity@gmail.com</a>
          </div>
        </div>
        <div class="map">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d63742.061008458746!2d101.683332!3d3.1267285!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc37bb455b4e61%3A0x7eebdcb9726d2ed2!2sSunway%20College%20%40%20Velocity!5e0!3m2!1sen!2smy!4v1712243413473!5m2!1sen!2smy"
            width="100%"
            height="450"
            style="border: 0; border-radius: 10px"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
          ></iframe>
        </div>
      </div>

      <hr class="address-separator">
      
      <!-- Address -->
      <div class="title">
        <h4>Sunway University</h4>
        <p>
        No. 5, Jalan Universiti, <br>Bandar Sunway, <br>47500 Selangor Darul Ehsan Malaysia
        </p>
      </div>
      <div class="address-content">
        <div class="open-hours">
          <h3>Operating Hours</h3>
          <ul>
            <li><strong>Monday - Friday:</strong> 9:00 AM - 6:00 PM</li>
            <li><strong>Saturday:</strong> 10:00 AM - 4:00 PM</li>
            <li><strong>Sunday:</strong> Closed</li>
          </ul>
          <div class="contact_us">
            <h3>Contact Us</h3>
            <p>Tel:</p>
            <a href="tel:+60374918622">+6 03 7491 8622</a> <br><br>

            <p>Email:</p>
            <a href="mailto:info@sunway.edu.my">info@sunway.edu.my</a>
          </div>
        </div>
        <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.102666846611!2d101.60384099999999!3d3.0672267!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc4c8f5912644b%3A0x77612fa0225cad69!2sSunway%20University!5e0!3m2!1sen!2smy!4v1713857819837!5m2!1sen!2smy" 
                width="600" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
        </div>
      </div>
    </section>

    <!-- JavaScript -->
    <script src="JS/homepage.js"></script>
    

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
