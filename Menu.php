<script>function showMessage(message) {alert(message);}</script>

<!---Add to Cart Php--->
<?php
session_start();
require_once 'DBconnect.php';

// Check if the user is logged in
if (!isset($_SESSION['sunwayID'])) {
  echo "<script> alert('Please login to your account before you visit. Thankyou!');";
echo "window.location.replace('login.php');</script>";
  exit(); //redirect user to login page
}


if (isset($_POST['add_to_cart'])){
    if(isset($_SESSION['cart'])){

        $existingIndex = array_search($_GET['id'], array_column($_SESSION['cart'], 'id'));

        if($existingIndex === false){
            $session_array = array( 
                'id' => $_GET['id'],
                "name" => $_POST['name'],
                "price" => $_POST['price'],
                "quantity" => $_POST['quantity']
            );
            $_SESSION['cart'][$_GET['id']] = $session_array;
        } 
        else{
            $_SESSION['cart'][$_GET['id']]['quantity'] += $_POST['quantity'];
           }
    } 
    
    else {
        $session_array = array( 
            'id' => $_GET['id'],
            "name" => $_POST['name'],
            "price" => $_POST['price'],
            "quantity" => $_POST['quantity']
        );
        $_SESSION['cart'][$_GET['id']] = $session_array;
    }
    $message = "Add To Cart Successful!";
    echo "<script type='text/javascript'>showMessage('$message');</script>";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <!-- Styling css file -->
    <link rel="stylesheet" href="CSS/header&footer.css" />
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
    </body>
</header>


<!---Menu--->
<title>Menu</title>
<link rel="stylesheet" href="CSS/Menu.css">

<div class="MainContent">
<h1 class='Page'>Menu</h1>

<ul>
    <?php 
    $sql="SELECT * FROM menu WHERE Type = 'Food'";
    $menu_food=mysqli_query($conn,$sql);
    ?>
    <div class="F">
        <h2 class='Title'>Food</h2>
        <a class="fa-solid fa-cart-shopping" id='Cart' href='Cart.php'></a>
    <?php
    while ($row = mysqli_fetch_array($menu_food)){
        $FoodID=$row['MenuID'];
        $FoodName=$row['FoodName'];
        $FoodShop=$row['ShopName'];
        $FD=$row['Description'];
        $FoodPic=$row['FoodPic'];
        $FoodPrice=$row['Price'];
        $FoodRemark=$row['Remark'];
        ?>
        
        <div class="Menu">
           <form action="Menu.php?id=<?=$FoodID?>" method='POST'>
            <img src="Menu Pictures/<?=$FoodPic?>">
            <h2> <?=$FoodName?></h2>
            <h3> RM<?=$FoodPrice?></h3>
            <h3> Shop:<?=$FoodShop?></h3>
            <h5> <?=$FD?> </h5>
            <h4> Remark:<?=$FoodRemark?></h4>
            <input type='hidden' name='name' value='<?=$FoodName?>'>
            <input type='hidden' name='price' value='<?=$FoodPrice?>'>
            <text>Quantity:</text>
            <input type='number' min='1' max='10' name='quantity' value='1' class='num'><br>
            <input type='submit' name='add_to_cart' value='Add To Cart' class='AddToCart'>
           </form>
        </div>
        <?php } ?>
    </div>
    <?php 
    $sql="SELECT * FROM menu WHERE Type = 'Beverage'";
    $menu_beverage=mysqli_query($conn,$sql);
    ?>
    <div class="F">
        <h2 class='Title'>Beverage</h2>
    <?php
    while ($row = mysqli_fetch_array($menu_beverage)){
        $BeverageID=$row['MenuID'];
        $BeverageName=$row['FoodName'];
        $BeverageShop=$row['ShopName'];
        $BD=$row['Description'];
        $BeveragePic=$row['FoodPic'];
        $BeveragePrice=$row['Price'];
        $BeverageRemark=$row['Remark'];
        ?>
        
        <div class="Menu">
           <form action="Menu.php?id=<?=$BeverageID?>" method='POST'>
            <img src="Menu Pictures/<?=$BeveragePic?>">
            <h2> <?=$BeverageName?></h2>
            <h3> RM<?=$BeveragePrice?></h3>
            <h3> Shop:<?=$BeverageShop?></h3>
            <h5> <?=$BD?> </h5>
            <h4> Remark:<?=$BeverageRemark?></h4>
            <input type='hidden' name='name' value='<?=$BeverageName?>'>
            <input type='hidden' name='price' value='<?=$BeveragePrice?>'>
            <text>Quantity:</text>
            <input type='number' min='1' max='10' name='quantity' value='1' class='num'><br>
            <input type='submit' name='add_to_cart' value='Add To Cart' class='AddToCart'>
           </form>
        </div>
        <?php } ?>
    </div>
</ul>
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