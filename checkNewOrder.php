<?php
session_start();
include 'DBconnect.php';

$lastCheckTime = '';

if(isset($_GET['userID'])){
    $userID = $_GET['userID'];
} 
else{
    echo "nothing";
    exit;
}

// Set up an initial timestamp to track the last check time
if (isset($_SESSION['lastCheckTime'])){
    $lastCheckTime = $_SESSION['lastCheckTime'];
} 
else {
    $lastCheckTime = date('Y-m-d H:i:s');
}

// Query the database for new data inserted since the last check time
$sql = "SELECT COUNT(*) AS newOrders 
        FROM foodorder  
        WHERE Date > ?
        AND AccountID != ?";
$stmt =$conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param('ss', $lastCheckTime,$userID); 
    $stmt->execute();
    $stmt->bind_result($newOrders);
    $stmt->fetch();

    if ($newOrders > 0) {
        echo 'new_order';
    } else {
        echo 'no_new_order';
    }

    $stmt->close();
} else {
    echo 'Error preparing SQL statement: ' . $conn->error;
}

// Update the last check time to the current time
$_SESSION['lastCheckTime'] = date('Y-m-d H:i:s');

?>