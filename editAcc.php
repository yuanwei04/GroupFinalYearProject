<?php
session_start(); // Start session
require_once 'DBconnect.php'; // Include database connection

// Retrieve user ID from the session
$UserID = $_SESSION['sunwayID'];

if (isset($_POST['submit'])) {
    $newName = $_POST['Name'];
    $newGender = $_POST['gender'];
    $newEmail = $_POST['Email'];
    $newContactNo = $_POST['ContactNo'];
    $newCourse = $_POST['course'];
    $newIntakeYear = $_POST['intakeYear'];
    $newPassword = $_POST['Password'];

    // Check if password field is empty
    if (!empty($newPassword)) {
        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        // Update user information in the database including password
        $updateQuery = "UPDATE Account SET Name='$newName', Gender='$newGender', Email='$newEmail', ContactNo='$newContactNo', Course='$newCourse', IntakeYear='$newIntakeYear', Password='$hashedPassword' WHERE AccountID='$UserID'";
    } else {
        // Update user information in the database excluding password
        $updateQuery = "UPDATE Account SET Name='$newName', Gender='$newGender', Email='$newEmail', ContactNo='$newContactNo', Course='$newCourse', IntakeYear='$newIntakeYear' WHERE AccountID='$UserID'";
    }

    $result = mysqli_query($conn, $updateQuery);

    if ($result) {
        // Display a JavaScript alert and redirect
        echo "<script>";
        echo "alert('Thank you for updating your details!');";
        echo "window.location.href = 'Account.php';"; // Redirect to the profile page
        echo "</script>";
    } else {
        echo "Error updating user information: " . mysqli_error($conn);
    }
}

// Close the connection
mysqli_close($conn);
?>
