<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Customers Page</title>
</head>
<body>
    <h1>Pending Orders</h1>
    <h1>Requested Orders</h1>
    <section>
        <h2>Home</h2>
        <p>Click the button below to go to home in:</p>
        <a href="employee_home.php"><button>Home</button></a>
    </section>

    <?php
    // Include your database connection file
    include '../db_connection.php';

    // Check if the "Pending Orders" button is clicked
    if (isset($_POST['pending_orders'])) {
        // Retrieve a list of orders with status 'pending' and associated details
        $pendingOrdersSql = "SELECT orders.OrderID, orders.CustomerID, customers.Name, customers.Surname, orderpackages.TravelPackageID, orders.status
                             FROM orders
                             JOIN customers ON orders.CustomerID = customers.ID
                             JOIN orderpackages ON orders.OrderID = orderpackages.OrderID
                             WHERE orders.status = 'pending'";

        $pendingOrdersResult = $connection->query($pendingOrdersSql);

        if (!$pendingOrdersResult) {
            echo "Error: " . $pendingOrdersSql . "<br>" . $connection->error;
        }
    }
    ?>

    <!-- Pending Orders Button -->
    <form method="post" action="">
        <input type="submit" name="pending_orders" value="Pending Orders">
    </form>

    <!-- Display Search Results -->
    <?php
    // Display Pending Orders
    if (isset($_POST['pending_orders'])) {
        // Retrieve a list of orders with status 'pending' and associated details
        $pendingOrdersSql = "SELECT orders.OrderID, orders.CustomerID, customers.Name, customers.Surname, orderpackages.TravelPackageID, orders.status
                             FROM orders
                             JOIN customers ON orders.CustomerID = customers.ID
                             JOIN orderpackages ON orders.OrderID = orderpackages.OrderID
                             WHERE orders.status = 'pending'";
        $pendingOrdersResult = $connection->query($pendingOrdersSql);

        if (!$pendingOrdersResult) {
            echo "Error: " . $pendingOrdersSql . "<br>" . $connection->error;
        } else {
            // Display the pending orders table
            echo "<h2>Pending Orders</h2>";

            if ($pendingOrdersResult->num_rows > 0) {
                echo "<form method='post' action=''>
                        <table border='1'>
                            <tr>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>CustomerID</th>
                                <th>OrderID</th>
                                <th>Travel Package Details</th>
                                <th>Status</th>
                            </tr>";

                while ($row = $pendingOrdersResult->fetch_assoc()) {
                    // Retrieve additional details from the packages table using TravelPackageID
                    $travelPackageSql = "SELECT * FROM packages WHERE TravelPackageID = " . $row['TravelPackageID'];
                    $travelPackageResult = $connection->query($travelPackageSql);

                    if (!$travelPackageResult) {
                        echo "Error: " . $travelPackageSql . "<br>" . $connection->error;
                    }

                    // Display row data with input fields for updating status
                    echo "<tr>
                            <td>" . $row["Name"] . "</td>
                            <td>" . $row["Surname"] . "</td>
                            <td>" . $row["CustomerID"] . "</td>
                            <td>" . $row["OrderID"] . "</td>
                            <td>" . $row["TravelPackageID"] . "</td>
                            <td>
                                <input type='text' name='status[]' value='" . $row["status"] . "'>
                                <input type='hidden' name='orderID[]' value='" . $row["OrderID"] . "'>
                            </td>
                        </tr>";
                }

                echo "</table>
                      <input type='submit' name='save_changes' value='Save Changes'>
                      </form>";
            } else {
                echo "No pending orders found";
            }
        }
    }

    // Process the form submission to update the database
    if (isset($_POST['save_changes'])) {
        $statuses = $_POST['status'];
        $orderIDs = $_POST['orderID'];

        // Loop through each order and update the status
        for ($i = 0; $i < count($statuses); $i++) {
            $status = $connection->real_escape_string($statuses[$i]);
            $orderID = $connection->real_escape_string($orderIDs[$i]);

            $updateStatusSql = "UPDATE orders SET status = '$status' WHERE OrderID = $orderID";
            $updateStatusResult = $connection->query($updateStatusSql);

            if (!$updateStatusResult) {
                echo "Error updating status: " . $updateStatusSql . "<br>" . $connection->error;
            }
        }

        // Refresh the page to display updated data
        header("Location: orders.php");
        exit();
    }













    if (isset($_POST['Requested_Orders'])) {
        // Retrieve a list of orders with status 'pending' and associated details
        $pendingOrdersSql = "SELECT orders.OrderID, orders.CustomerID, customers.Name, customers.Surname, orderpackages.TravelPackageID, orders.status
                             FROM orders
                             JOIN customers ON orders.CustomerID = customers.ID
                             JOIN orderpackages ON orders.OrderID = orderpackages.OrderID
                             WHERE orders.status = 'Cancel request'";

        $pendingOrdersResult = $connection->query($pendingOrdersSql);

        if (!$pendingOrdersResult) {
            echo "Error: " . $pendingOrdersSql . "<br>" . $connection->error;
        }
    }
    ?>

    <!-- Pending Orders Button -->
    <form method="post" action="">
        <input type="submit" name="Requested_Orders" value="Requested Orders">
    </form>

    <!-- Display Search Results -->
    <?php
    // Display Pending Orders
    if (isset($_POST['Requested_Orders'])) {
        // Retrieve a list of orders with status 'pending' and associated details
        $pendingOrdersSql = "SELECT orders.OrderID, orders.CustomerID, customers.Name, customers.Surname, orderpackages.TravelPackageID, orders.status
                             FROM orders
                             JOIN customers ON orders.CustomerID = customers.ID
                             JOIN orderpackages ON orders.OrderID = orderpackages.OrderID
                             WHERE orders.status = 'Cancel request'";
        $pendingOrdersResult = $connection->query($pendingOrdersSql);

        if (!$pendingOrdersResult) {
            echo "Error: " . $pendingOrdersSql . "<br>" . $connection->error;
        } else {
            // Display the pending orders table
            echo "<h2>Requested Orders</h2>";

            if ($pendingOrdersResult->num_rows > 0) {
                echo "<form method='post' action=''>
                        <table border='1'>
                            <tr>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>CustomerID</th>
                                <th>OrderID</th>
                                <th>Travel Package Details</th>
                                <th>Status</th>
                            </tr>";

                while ($row = $pendingOrdersResult->fetch_assoc()) {
                    // Retrieve additional details from the packages table using TravelPackageID
                    $travelPackageSql = "SELECT * FROM packages WHERE TravelPackageID = " . $row['TravelPackageID'];
                    $travelPackageResult = $connection->query($travelPackageSql);

                    if (!$travelPackageResult) {
                        echo "Error: " . $travelPackageSql . "<br>" . $connection->error;
                    }

                    // Display row data with input fields for updating status
                    echo "<tr>
                            <td>" . $row["Name"] . "</td>
                            <td>" . $row["Surname"] . "</td>
                            <td>" . $row["CustomerID"] . "</td>
                            <td>" . $row["OrderID"] . "</td>
                            <td>" . $row["TravelPackageID"] . "</td>
                            <td>
                                <input type='text' name='status[]' value='" . $row["status"] . "'>
                                <input type='hidden' name='orderID[]' value='" . $row["OrderID"] . "'>
                            </td>
                        </tr>";
                }

                echo "</table>
                      <input type='submit' name='save_changes' value='Save Changes'>
                      </form>";
            } else {
                echo "No pending orders found";
            }
        }
    }

    // Process the form submission to update the database
    if (isset($_POST['save_changes'])) {
        $statuses = $_POST['status'];
        $orderIDs = $_POST['orderID'];

        // Loop through each order and update the status
        for ($i = 0; $i < count($statuses); $i++) {
            $status = $connection->real_escape_string($statuses[$i]);
            $orderID = $connection->real_escape_string($orderIDs[$i]);

            $updateStatusSql = "UPDATE orders SET status = '$status' WHERE OrderID = $orderID";
            $updateStatusResult = $connection->query($updateStatusSql);

            if (!$updateStatusResult) {
                echo "Error updating status: " . $updateStatusSql . "<br>" . $connection->error;
            }
        }

        // Refresh the page to display updated data
        header("Location: orders.php");
        exit();
    }
    ?>

</body>
</html>
