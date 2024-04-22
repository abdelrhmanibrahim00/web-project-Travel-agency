<?php
// Include your database connection file
include '../db_connection.php';

// Start the session
session_start();

// Check if the customer_id is set in the session
if (isset($_SESSION["customers_ID"])) {
    // Retrieve the customer_id from the session
    $customerID = $_SESSION["customers_ID"];

    // Check if the cancellation form is submitted
    if (isset($_POST['cancel_orders'])) {
        // Get the selected orders to cancel
        $ordersToCancel = $_POST['orders_to_cancel'];

        // Update the order status to 'cancelled' for each selected order
        foreach ($ordersToCancel as $orderToCancel) {
            $updateSql = "UPDATE orders SET status = 'Cancel request' WHERE OrderID = '$orderToCancel' AND CustomerID = '$customerID'";
            $updateResult = $connection->query($updateSql);
            if (!$updateResult) {
                echo "Error updating order status: " . $connection->error;
            }
        }
    }

    // Query the database for orders associated with the customer
    $sql = "SELECT o.*, p.Destination FROM `orders` o LEFT JOIN orderpackages op on o.OrderID = op.OrderID LEFT JOIN packages p ON op.TravelPackageID = p.TravelPackageID  WHERE o.CustomerID = '$customerID'";
    $result = $connection->query($sql);

    if (!$result) {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
} else {
    // If customer_id is not set, you may want to handle this case, e.g., redirect to a login page
    echo "Error: Customer ID not found in the session.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <style>
        /* Your CSS styles go here */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .cancel-btn {
            background-color: #ff6666;
            color: #fff;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }

        .nav-btn {
            margin: 10px;
            padding: 8px;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .logout-btn {
            margin: 10px;
            padding: 8px;
            text-decoration: none;
            background-color: #ff6666;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>My Orders</h2>

<!-- Navigation buttons -->
<a href="customer_home.php" class="nav-btn">Home</a>
<a href="../index.php" class="logout-btn">Logout</a>

<?php
if ($result->num_rows > 0) {
    // Display a table with order details and checkboxes
    echo '<form method="post" action="">';
    echo '<table>';
    echo '<tr><th>Order ID</th><th>Order Date</th><th>Invoice Number</th><th>Status</th><th>Action</th> <th>Destination</th></tr>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['OrderID'] . '</td>';
        echo '<td>' . $row['OrderDate'] . '</td>';
        echo '<td>' . $row['InvoiceNumber'] . '</td>';
        echo '<td>' . $row['status'] . '</td>';
        echo '<td>' . $row['Destination'] . '</td>';
        echo '<td>';
        // Display checkbox only if the order is not cancelled
        if ($row['status'] !== 'Cancel request') {
            echo '<input type="checkbox" name="orders_to_cancel[]" value="' . $row['OrderID'] . '">';
        }
        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';
    // Display single cancel button
    echo '<button type="submit" class="cancel-btn" name="cancel_orders">Cancel Selected Orders</button>';
    echo '</form>';
} else {
    echo 'No orders found.';
}

// Close the database connection
$connection->close();
?>

</body>
</html>
