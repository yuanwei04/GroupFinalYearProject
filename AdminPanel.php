<title>Admin Panel</title>
<link rel="stylesheet" href="CSS/AdminPanel.css">
<link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
<script>function showMessage(message) {alert(message);}</script>

<div class="AdminPanel">
<!--Navigation-->

<div class="AdminHeader">
<div class="brand">
        <span class="fa fa-cutlery"></span>
        <h1>Food Pickup Service</h1>
      </div>
<h3>Upload Food & Beverage</h3>
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


<!--Uploading Form-->
<div class="MainContent">
  <div class="FoodUpload">
   <form action='AdminPanel.php' method='post' enctype='multipart/form-data'>
   <text>Food & Beverage Name:</text><br>
   <input type='text' name='FoodName' placeholder='F&B Name' required><br>
   <text class='FOB'>Food or Beverage:</text>
   <select name='Type' placeholder='Food or Beverage' required>
   <option value="">Select Food or Beverage</option>
   <option value="Food">Food</option>
   <option value="Beverage">Beverage</option>
   </select><br>
   <text>Shop Name:</text><br>
   <input type='text' name='ShopName' placeholder='Shop Name' required><br>
   <text>Description:</text><br>
   <textarea name='Description' placeholder='Description'></textarea><br>
   <text>Price:</text>
   <input class='Pinput' type='text' name='Price' placeholder='RM' required><br>
   <text>Picture:</text>
   <input class='Pinput' type='file' name='FoodImage'><br>
   <input class="Foodbtn" type='submit' name='submit' value='Upload'></input>
   </form>
  </div>
</div>
 
</div>

<!--Admin Panel Php-->
<?php
require_once 'DBconnect.php';
session_start();
$AdminID = $_SESSION['sunwayID'];
$Password = $_SESSION['pass'];
$AccType = $_SESSION['accountType'];

function generateMenuID($alphabet, $length = 8) {
  $characters = '0123456789';
  $randomString = $alphabet;
  for ($i = strlen($alphabet); $i < $length; $i++) {
      $randomString .= $characters[rand(0, strlen($characters) - 1)];
  }
  return $randomString;
}


if (isset($_POST['submit']) && isset($_FILES['FoodImage'])){

  $Price = $_POST['Price'];
  if (!is_numeric($Price)) {
    $message = "Menu Upload Unsuccessful! Price must be Numeric Value.";
    echo "<script type='text/javascript'>showMessage('$message');</script>";
  }
  
  else if($Price <= 0){
    $message = "Menu Upload Unsuccessful! Price cannot be Zero and Negative.";
    $message = str_replace("\n", "\\n", $message);
    echo "<script type='text/javascript'>showMessage('$message');</script>";
  }

  else if($Price >= 100){
    $message = "Menu Upload Unsuccessful! Price cannot be Three Digits.";
    echo "<script type='text/javascript'>showMessage('$message');</script>";
  }

  else {            

    $img_name = $_FILES['FoodImage']['name'];
    $img_size = $_FILES['FoodImage']['size'];
    $tmp_name = $_FILES['FoodImage']['tmp_name'];
    $error = $_FILES['FoodImage']['error'];

    if ($error === 0){
        if ($img_size < 500000 ){
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg","jpeg","png","webp","avif");
        
            if (in_array($img_ex_lc, $allowed_exs)){
                $image = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = 'Menu Pictures/'.$image;
                move_uploaded_file($tmp_name, $img_upload_path);

                $Type=$_POST['Type'];
                $FoodName=$_POST['FoodName'];
                $ShopName=$_POST['ShopName'];
                $MenuID= generateMenuID ('');
                $Description=$_POST['Description'];
            
                $sql = "INSERT INTO menu (MenuID, Type, FoodName, ShopName, Description, FoodPic, Price) 
                VALUES ('$MenuID', '$Type', '$FoodName', '$ShopName', '$Description', '$image', '$Price')";
                $result=mysqli_query($conn,$sql);

                if ($result) {
                  $message = "Menu Uploaded Succesful!";
                  echo "<script type='text/javascript'>showMessage('$message'); window.location.href = 'AdminMenu.php';</script>";
              } else{
                  $message = "Menu Upload Unsuccessful! Please Try Again.";
                  echo "<script type='text/javascript'>showMessage('$message');</script>";
              }

            } else{
                $message = "Menu Upload Unsuccessful! This type of file are Not Allow.\nOnly allow jpg, jpeg, png, webp and avif.";
                $message = str_replace("\n", "\\n", $message);
                echo "<script type='text/javascript'>showMessage('$message');</script>";
            }
            
        } else{
            $message = "Menu Upload Unsuccessful! your file is too Large.";
            echo "<script type='text/javascript'>showMessage('$message');</script>";
          }
    }
    else{
      $message = "Upload Unsuccessful! Please select your menu Picture.";
      echo "<script type='text/javascript'>showMessage('$message');</script>";
    }
  }
}
?>