<?php
session_start();
require_once 'DBconnect.php';

$sunwayID = $_SESSION['sunwayID'];
$password = $_SESSION['pass'];
$accountType = $_SESSION['accountType']; 

?>

<!--Header-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />
    <!-- Font awesome icon (links) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <!-- Styling css file -->
    <link rel="stylesheet" href="CSS/header&footer.css" />
    <link rel="stylesheet" href="CSS/Cart.css" />
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
            <a href="login.php"> Signout </a>
          </li>
        </ul>

      </div>
    </body>
</header>

<!---Cart Php--->
<title>Cart</title>
<div class='MainContent'>
    <h2>Cart</h2>
    <div class="Cart">

    <?php
    $total = 0;

    if (!empty($_SESSION['cart'])) {
    ?>
        <table>
          <div class='CartContent'>
            <tr>
                <th>Item Name</th>
                <th>Item Price</th>
                <th>Item Quantity</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>

            <?php
            foreach ($_SESSION['cart'] as $key => $value) {
                if (is_array($value)) {
            ?>
                    <tr>
                        <td><?= isset($value['name']) ? $value['name'] : '' ?></td>
                        <td>RM<?= isset($value['price']) ? $value['price'] : '' ?></td>
                        <td><?= isset($value['quantity']) ? $value['quantity'] : '' ?></td>
                        <td>RM<?= isset($value['price']) && isset($value['quantity']) ? number_format($value['price'] * $value['quantity'],2): '' ?></td>
                        <td>
                            <a href='Cart.php?action=remove&id=<?= isset($value['id']) ? $value['id'] : '' ?>'>
                                <button class='btnRemove'>Remove</button>
                            </a>
                        </td>
                    </tr>
                </div>
            <?php
                    $total = ($total + (isset($value['quantity']) && isset($value['price']) ? $value['quantity'] * $value['price'] : 0));
                } else {
                }
            }
            $total += 4.00;
            ?>
            <tr>
              <td colspan='3'><b>Delivery Fee</b></td>
              <td>RM4.00</td>
              <td> </td>
            </tr>
            <tr>
                <td colspan='3'><b>Total Price</b></td>
                <td>RM<?= number_format($total,2) ?></td>
                <td>
                    <a href='Cart.php?action=clearall'>
                        <button class='btnClear'>Clear All</button>
                    </a>
                </td>       
            </tr>

        </table>
          
        <form action="Cart.php" method="GET">
            <label for="collectTime">Meet Up Time:</label>
            <input class='time' type="time" name="collectTime" id="collectTime" min="10:00" max="18:00" required><br>
            <label for="collectLocation">Meet Up Location:</label>
            <select class='location' name="collectLocation" id="collectLocation" required>
                <option value="Student Hub">Student Hub</option>
                <option value="Library">Library</option>
                <option value="V01-07-08">V01-07-08</option>
                <option value="Computer Lab 1">Computer Lab 1</option>
            </select><br>
            <input class='submit' type="submit" name="submitOrder" value="Submit Order">
        </form>
        </div>
  </div>


<!---Php Submit Order Function--->
    <?php
        if (isset($_GET['submitOrder']))
        {
            if (!empty($_GET['collectTime']) && !empty($_GET['collectLocation']))
            {
                $currentDate = date('Y-m-d H-i-s');
                $collectTime = $_GET['collectTime'];
                $collectLocation = $_GET['collectLocation'];
                $orderId = date ('YmdHis');

                $sql = "INSERT INTO foodorder (`OrderID`, `Date`, `CollectionTime`, `CollectionLocation`, `Status`, `totalPrice`, `AccountID`) 
                        VALUES ('$orderId', '$currentDate', '$collectTime', '$collectLocation', 'pending', '$total', '$sunwayID');";
                $result = mysqli_query($conn,$sql);

                if ($result){

                    foreach ($_SESSION['cart']  as $key => $value){
                        $menuId = $value['id'];
                        $quantity = $value['quantity'];
    
                        $sql = "INSERT INTO orderrecord (`quantity`, `OrderID`, `MenuID`) 
                                VALUES ('$quantity', '$orderId', '$menuId');";
                        
                        $result = mysqli_query($conn,$sql);

                    }
                    unset($_SESSION['cart']);
                    echo "<script>alert('Order Placed Successfully!'); window.location.href='waitingProcess.php?orderID=$orderId'</script>";
                  

      
                }                
            }

        }

    
    ?>

            
<!---Php Remove and Clear function--->
    <?php
    }else{
        echo 'Cart is Empty';
    }

  
    if (isset($_GET['action'])){
        if ($_GET['action'] == "remove"){
           foreach ($_SESSION['cart'] as $key => $value) {
               if (is_array($value) && $value['id'] == $_GET['id']) {
                unset($_SESSION['cart'][$key]);
                echo '<script>alert("Item Removed from Cart"); window.location.href="Cart.php";</script>';
                break;
                }
            }
        }
        else{
          unset($_SESSION['cart']);
          echo '<script>alert("Cart Cleared Successfully"); window.location.href="Cart.php";</script>';
        }
    }
    ?>


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
