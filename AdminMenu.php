<?php
session_start();
require_once 'DBconnect.php';
?>

<!---Admin Menu--->
<title>Admin Menu</title>
<link rel="stylesheet" href="CSS/AdminMenu.css">
<link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
<script>function showMessage(message) {alert(message);}</script>


<div class=AdminPanel>
<!--Navigation-->

<div class="AdminHeader">
<div class="brand">
        <span class="fa fa-cutlery"></span>
        <h1>Food Pickup Service</h1>
      </div>
<h3>Admin Menu</h3>
<ul>
  <a href="logout.php">Sign Out</a>
  <span class="fa fa-sign-out" id="headIcon"></span>
</ul>
</div>

<div class="SideBar">
<h2>Admin Panel</h2>
  <ul>
    <li><a href="AdminMenu.php">Admin Menu</a><li><br>
    <li><a href="AdminUserList.php">User List</a></li><br>
    <li><a href="AdminPanel.php">Upload Food & Beverage</a></li><br>
  </ul>
</div>


<!--Menu-->>
<div class="MainContent">
<ul>
    <?php 

    $sql="SELECT * FROM menu WHERE Type = 'Food' ";
    $menu_food=mysqli_query($conn,$sql);

    ?>
    <div class='F'>
          <h2 class='Title'>Food</h2>
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
            <form action="AdminMenu.php" method='GET'>
              <img src="Menu Pictures/<?=$FoodPic?>">
              <h4> ID:<?=$FoodID?></h4> 
              <h2> <?=$FoodName?></h2>
              <h3> RM<?=$FoodPrice?></h3>
              <h3> Shop:<?=$FoodShop?></h3>
              <h5> <?=$FD?> </h5>
              <h4> Remark:<?=$FoodRemark?></h4>
              <a class="Edit" href="AdminMenuEdit.php?editMenu=<?=$FoodID?>">Edit</a>
              <a class="Delete" href="AdminMenu.php?dltMenu=<?=$FoodID?>">Delete</a>
            </form>
          </div>
    <?php } ?>
    </div>

    <?php
    $sql="SELECT * FROM menu WHERE Type = 'Beverage' ";
    $menu_beverage=mysqli_query($conn,$sql);

    ?>
    <div class='B'>
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
            <form action="AdminMenu.php" method='GET'>
              <img src="Menu Pictures/<?=$BeveragePic?>">
              <h4> ID:<?=$BeverageID?></h4> 
              <h2> <?=$BeverageName?></h2>
              <h3> RM<?=$BeveragePrice?></h3>
              <h3> Shop:<?=$BeverageShop?></h3>
              <h5> <?=$BD?> </h5>
              <h4> Remark:<?=$BeverageRemark?></h4>
              <a class="Edit" href="AdminMenuEdit.php?editMenu=<?=$BeverageID?>">Edit</a>
              <a class="Delete" href="AdminMenu.php?dltMenu=<?=$BeverageID?>">Delete</a>
            </form>
          </div>
    <?php } ?>
    </div>

    </ul>
  </div>

</div>


<!--Delete Menu Php-->
<?php
if(isset($_GET['dltMenu'])){
    $MenuID = $_GET['dltMenu'];
    $sql="DELETE FROM menu WHERE MenuID='$MenuID' "; 
    $delete_food = mysqli_query($conn,$sql);
    if($delete_food){
      $message = "Menu Deleted Successful!";
      echo "<script type='text/javascript'>showMessage('$message'); window.location.href = 'AdminMenu.php';</script>";
    }else {
      $message = "Menu Deleted Unuccessful, Please Try Again!";
      echo "<script type='text/javascript'>showMessage('$message'); window.location.href = 'AdminMenu.php';</script>";
    }
}
?>


