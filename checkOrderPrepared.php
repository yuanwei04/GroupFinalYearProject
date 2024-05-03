<?php
session_start();
include "DBconnect.php";
$response = "";
$lastCheckTime="";

if (isset($_GET['orderID'])){
    $orderID = $_GET['orderID'];  
}
else{
    echo "nothing";
    exit();
}

if (isset($_SESSION['lastCheckTime'])){
    $lastCheckTime = $_SESSION['lastCheckTime'];
} 
else {
    $lastCheckTime = date('Y-m-d H:i:s');
}

  

    $sql = "SELECT OrderID
            FROM pickupservice
            WHERE orderID = ?
            AND PickupStatus ='collected'
            AND PickupTime > ?";
    $stmt = $conn->prepare($sql);

    if($stmt){
        $stmt->bind_param('ss',$orderID,$lastCheckTime);
        $stmt->execute();
        $stmt->bind_result($orderPlaced);
        $stmt->fetch();

        if($orderPlaced != null){
            $response = $orderPlaced . ';order_placed';
        }
        else{
            echo 'no_order_placed';
        }
        $stmt->close();
    }
    else{
        echo 'Error preparing SQL statement:' . $conn->error;
    }


$_SESSION['lastCheckTime'] = date('Y-m-d H:i:s');
echo $response;



?>