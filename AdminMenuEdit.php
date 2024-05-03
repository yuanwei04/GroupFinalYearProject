<title>Admin Edit Menu</title>
<link rel="stylesheet" href="CSS/AdminMenuEdit.css">
<link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
<script>function showMessage(message) {alert(message);}</script>

<!--Edit Menu Php-->
<?php
require_once 'DBconnect.php';

if(isset($_GET['editMenu'])){
    $MenuID = $_GET['editMenu'];
    $sql="SELECT * FROM menu WHERE MenuID='$MenuID' "; 
    $upd_food = mysqli_query($conn,$sql);
    if($row=mysqli_fetch_assoc($upd_food)){
        $MenuID=$row['MenuID'];
        $FoodName=$row['FoodName'];
        $Type=$row['Type'];
        $ShopName=$row['ShopName'];
        $Description=$row['Description'];
        $Pic=$row['FoodPic'];
        $Price=$row['Price'];
        $Remark=$row['Remark'];
    }else{
        $message = "Food & Beverage not Found!";
        echo "<script type='text/javascript'>showMessage('$message'); window.location.href = 'AdminMenu.php';</script>";
    }
}
?>

<div class="AdminPanel">
<!--Navigation-->

<div class="AdminHeader">
<div class="brand">
        <span class="fa fa-cutlery"></span>
        <h1>Food Pickup Service</h1>
      </div>
<h3>Edit Menu Form</h3>
</div>

<div class="SideBar">
<h2>Admin Panel</h2>
  <ul>
    <li><a href="AdminMenu.php">Admin Menu</a><li><br>
    <li><a href="AdminUserList.php">User List</a></li><br>
    <li><a href="AdminPanel.php">Upload Food & Beverage</a></li><br>
  </ul>
</div>

<!--Edit Menu Form-->
<div class="MainContent">
   <div class="FoodEdit">
   <form action="AdminMenuEdit.php?id=<?=$MenuID?>" method="post">
   <div class='EditMenuPic'>
   <?php echo "<img src='Menu Pictures/".$row['FoodPic']."'alt='Current Picture'>" ?>
   </div>
   <text>Menu ID:</text>
   <input class="Pinput" type="text" name="MenuID" value="<?=$MenuID?>" readOnly><br>
   <text>Food & Beverage Name:</text>
   <input class="Pinput" type="text" name="FoodName" value="<?=$FoodName?>" placeholder="Edit F&B Name" required><br>
   <text>Food or Beverage:</text>
   <select name='Type' placeholder='Food or Beverage' required>
     <option value="">Select Food or Beverage</option>
     <option value="Food" <?= ($Type == 'Food') ? 'selected' : '' ?>>Food</option>
     <option value="Beverage" <?= ($Type == 'Beverage') ? 'selected' : '' ?>>Beverage</option>
   </select><br>
   <text>Shop Name:</text>
   <input class="Pinput" type="text" name="ShopName" value="<?=$ShopName?>" placeholder="Edit Shop Name" required><br>
   <text>Description:</text><br>
   <textarea name='Description' placeholder="Description"><?=$Description?></textarea><br>
   <text>Price:</text>
   <input class="Pinput" type="text" name="Price" value="<?=$Price?>" placeholder="Edit Price" required><br>
   <text>Remark:</text>
   <input class="FoodRemark" type="text" name="Remark" value="<?=$Remark?>" placeholder="Update Remark"><br>
   <a class="Cancel" href="AdminMenu.php">Cancel</a>
   <input class="Update" type="submit" name="updMenu" value="Update">
   </form>
   </div>
</div>

</div>


<!--Update Menu Php-->
<?php
if(isset($_POST['updMenu'])){

    $Price = $_POST['Price'];
    if($Price <= 0){
        $message = "Menu Update Unsuccesful, Price cannot be Zero and Negative!";
        echo "<script type='text/javascript'>showMessage('$message'); window.location.href = 'AdminMenu.php';</script>";
    }

    else if($Price >= 100){
        $message = "Menu Update Unsuccesful, Price cannot be Three Digits!";
        echo "<script type='text/javascript'>showMessage('$message'); window.location.href = 'AdminMenu.php';</script>";
    }
  
    else {    
    $Pic=$row['FoodPic'];
    $MenuID=$_POST['MenuID'];
    $Type=$_POST['Type'];
    $FoodName=$_POST['FoodName'];
    $ShopName=$_POST['ShopName'];
    $Description=$_POST['Description'];
    $Remark=$_POST['Remark'];

    $sql = "UPDATE menu SET Type='$Type', FoodName ='$FoodName', ShopName='$ShopName', Description='$Description', Price='$Price', Remark='$Remark' WHERE MenuID='$MenuID' ";
    $upd_result=mysqli_query($conn,$sql);
    if($upd_result){
        $message = "Menu Updated Succesful!";
        echo "<script type='text/javascript'>showMessage('$message'); window.location.href = 'AdminMenu.php';</script>";
    }else{
        $message = "Error Occurred, Menu Update Unsuccesful, Please Try Again!";
        echo "<script type='text/javascript'>showMessage('$message'); window.location.href = 'AdminMenu.php';</script>";
    }
  }
}
?>

