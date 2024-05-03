<?php
include "DBconnect.php";
if (isset($_GET['orderID'])) {
    $orderID = $_GET['orderID'];
    $currentStatus = '';

    // Fetch the current status of the order from the database
    $sql = "SELECT PickupStatus 
            FROM pickupservice 
            WHERE orderID = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('s', $orderID);
        if ($stmt->execute()) {
            $stmt->bind_result($pickupStatus); // Bind the result of the query to $pickupStatus
            if ($stmt->fetch()) {
                $currentStatus = $pickupStatus; // Assign the fetched PickupStatus to $currentStatus
            } else {
                echo "Order not found.";
                exit(); // Exit script if order not found
            }
            $stmt->close();
        } else {
            echo "Error executing SQL statement: " . $stmt->error;
            exit(); // Exit script on SQL error
        }
    } else {
        echo "Error preparing SQL statement: " . $conn->error;
        exit(); // Exit script on SQL error
    }
    
    // Now $currentStatus contains the fetched PickupStatus
    echo "$currentStatus";
} else {
    echo "Order ID not provided.";
}

?>