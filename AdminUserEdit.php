<title>Admin Edit User</title>
<link rel="stylesheet" href="CSS/AdminUserEdit.css">
<link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
<script>function showMessage(message) {alert(message);}</script>

<!--Edit User Php-->
<?php
require_once 'DBconnect.php';

if(isset($_GET['editUser'])){
    $AccountID = $_GET['editUser'];
    $sql="SELECT * FROM account WHERE AccountID='$AccountID' "; 
    $upd_user = mysqli_query($conn,$sql);
    if($row=mysqli_fetch_assoc($upd_user)){
      $AccountID=$row['AccountID'];
      $Name=$row['Name'];
      $Password=$row['Password'];
      $ContactNo=$row['ContactNo'];
      $Course=$row['Course'];
      $IntakeYear=$row['IntakeYear'];
      $AccStatus=$row['AccStatus'];
      $AccountType=$row['AccountType'];
    }else{
        echo "User not found!";
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
<h3>Edit User Form</h3>
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
  <div class="EditUser">
    <form action="AdminUserEdit.php" method="post">
        <text>Account ID:</text>
        <input class="Pinput" type="text" name="AccountID" value="<?=$AccountID?>"  placeholder="Edit Account ID" readOnly><br>
        <text>Name:</text>
        <input class="Pinput" type="text" value="<?=$Name?> "name="Name" placeholder="Edit Name" required><br>
        <text>Gender:</text>
        <input type="radio" id="male" name="Gender" value="Male" checked />
            <label for="male">Male</label>
        <input type="radio" id="female" name="Gender" value="Female" />
            <label for="female">Female</label><br>
        <text>Contact No:</text>
        <input class="Pinput" type="text" value="<?=$ContactNo?>"  name="ContactNo" placeholder="Edit Contact No" required><br>
        <text>Course:</text>
        <select class="Select" id="course" name="Course" placeholder="Edit Course" required>
              <option value="">Select Course</option>
              <option value="Diploma In Computer Science" <?= ($Course == 'Diploma In Computer Science') ? 'selected' : '' ?>>Diploma In Computer Science</option>
              <option value="Diploma In Information Technology"<?= ($Course == 'Diploma In Information Technology') ? 'selected' : '' ?>>Diploma In Computer Science</option>
              <option value="Diploma In New Media"<?= ($Course == 'Diploma In New Media') ? 'selected' : '' ?>>Diploma In New Media</option>
              <option value="Diploma In Business Administration"<?= ($Course == 'Diploma In Business Administration') ? 'selected' : '' ?>>Diploma In Business Administration</option>
              <option value="Diploma In Accounting"<?= ($Course == 'Diploma In Accounting') ? 'selected' : '' ?>>Diploma In Accounting</option>
              <option value="Foundation In Accountancy (ACCA FIA)"<?= ($Course == 'Foundation In Accountancy (ACCA FIA)') ? 'selected' : '' ?>>Foundation In Accountancy (ACCA FIA)</option>
              <option value="Association of Chartered Certified Accountants (ACCA)"<?= ($Course == 'Association of Chartered Certified Accountants (ACCA)') ? 'selected' : '' ?>>Association of Chartered Certified Accountants (ACCA)</option>
              <option value="Certificate In Business Studies"<?= ($Course == 'Certificate In Business Studies') ? 'selected' : '' ?>>Certificate In Business Studies</option>
        </select>
        <text>Intake Date:</text>
        <input class="Tinput" type="date" value="<?=$IntakeYear?>" name="IntakeYear" required><br>
        <text>Status:</text>
        <select class="Select" name="AccStatus">
          <option value="Active" <?= ($AccStatus == 'Active') ? 'selected' : '' ?>>Active</option>
          <option value="Inactive" <?= ($AccStatus == 'Inactive') ? 'selected' : '' ?>>Inactive</option>
        </select>
        <text>Type:</text>
        <select class="Select" name="AccountType">
          <option value="User" <?= ($AccountType == 'User') ? 'selected' : '' ?>>User</option>
          <option value="Admin" <?= ($AccountType == 'Admin') ? 'selected' : '' ?>>Admin</option>
        </select><br>
        <a href="AdminUserList.php">Cancel</a>
        <input class="Update" type="submit" name="updUser" value="Update">
    </form>
  </div>
</div>

</div>


<!--Update Menu Php-->
<?php
if(isset($_POST['updUser'])){

    $AccountID=$_POST['AccountID'];
    $Name=$_POST['Name'];
    $Gender=$_POST['Gender'];
    $ContactNo=$_POST['ContactNo'];
    $Course=$_POST['Course'];
    $IntakeYear=$_POST['IntakeYear'];
    $AccStatus=$_POST['AccStatus'];
    $AccountType=$_POST['AccountType'];

    $sql = "UPDATE account SET Name='$Name', Gender='$Gender', ContactNo='$ContactNo', Course='$Course', 
            IntakeYear='$IntakeYear', AccStatus='$AccStatus', AccountType='$AccountType' WHERE AccountID='$AccountID' ";
    $upd_results=mysqli_query($conn,$sql);
    if($upd_results){
      $message = "User Updated Succesful!";
      echo "<script type='text/javascript'>showMessage('$message'); window.location.href = 'AdminUserList.php';</script>";
  }else{
      $message = "Error Occurred,User Update Unsuccesful, Please Try Again!";
      echo "<script type='text/javascript'>showMessage('$message'); window.location.href = 'AdminUserList.php';</script>";
  }
}
?>

