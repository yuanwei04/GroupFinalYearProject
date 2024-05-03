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

if (isset($_SESSION['lastCheckTime'])){
    $lastCheckTime = $_SESSION['lastCheckTime'];
} 
else {
    $lastCheckTime = date('Y-m-d H:i:s');
}

$response = "";

// Query the database for new data inserted since the last check time
$sql = "SELECT OrderID  
        FROM foodorder 
        WHERE AccountID = ?
        AND Status='accepted'
        AND RecordTime > ?";
$stmt = $conn->prepare($sql);

if($stmt){
    $stmt->bind_param('ss', $userID,$lastCheckTime); 
    $stmt->execute();
    $stmt->bind_result($orderAccept);
    $stmt->fetch();

    if($orderAccept != null){
        $response=$orderAccept . ';order_accepted';
    }
    else{
        echo 'no_order_accepted';
    }
    $stmt->close();
}
else{
    echo 'Error preparing SQL statement: ' . $conn->error;
}

// Update the last check time to the current time
$_SESSION['lastCheckTime'] = date('Y-m-d H:i:s');

echo $response;
?>