<title>User List</title>
<link rel="stylesheet" href="CSS/AdminUserList.css">
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
<h3>User List</h3>
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

<!--User List-->
<div class="MainContent">
  <div class="UserList">
  <table>
    <tr>
      <th>Account ID</th>
      <th>Name</th>
      <th>Gender</th>
      <th>ContactNo</th>
      <th>Course</th>
      <th>Intake Year</th>
      <th>Acc Status</th>
      <th>Acc Type</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>

    <?php
    require_once 'DBconnect.php';

    $sql="SELECT * FROM account";
    $AccResults=mysqli_query($conn,$sql);

    while($row = mysqli_fetch_array($AccResults)){
      $AccountID=$row['AccountID'];
      $Name=$row['Name'];
      $Gender=$row['Gender'];
      $ContactNo=$row['ContactNo'];
      $Course=$row['Course'];
      $IntakeYear=$row['IntakeYear'];
      $AccStatus=$row['AccStatus'];
      $AccountType=$row['AccountType'];
    ?>

    <tr>
        <td><?=$AccountID?></td> 
        <td><?=$Name?></td>
        <td><?=$Gender?></td> 
        <td><?=$ContactNo?></td> 
        <td><?=$Course?></td> 
        <td><?=$IntakeYear?></td> 
        <td><?=$AccStatus?></td> 
        <td><?=$AccountType?></td> 
        <td><a class='Edit' href="AdminUserEdit.php?editUser=<?=$AccountID?>">EDIT</a></td>
        <td><a class='Delete' href="#" onclick="confirmDelete(<?php echo $AccountID; ?>)">DELETE</a></td>
    </tr>
<?php }?>
    </table>
  </div>
</div>

</div>


<!--JS pop up confirmation-->
<script>
function confirmDelete(AccountID) {
    var confirmation = confirm("Are you sure you want to delete this User?");
    if (confirmation) {
        window.location.href = "AdminUserList.php?dltUser=" + AccountID;
    } else {
        return false;
    }
}
</script>

<!--Delete User Php-->
<?php
if(isset($_GET['dltUser'])){
    $MenuID = $_GET['dltUser'];
    $sql="DELETE FROM account WHERE AccountID='$AccountID' "; 
    $delete_user = mysqli_query($conn,$sql);
    if($delete_user){
      $message = "User Deleted Successful!";
      echo "<script type='text/javascript'>showMessage('$message'); window.location.href = 'AdminUserList.php';</script>";
    }else {
      $message = "User Deleted Unuccessful, Please Try Again!";
      echo "<script type='text/javascript'>showMessage('$message'); window.location.href = 'AdminUserList.php';</script>";
    }
}
?>
