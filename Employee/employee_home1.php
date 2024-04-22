<?php
// Include your database connection file
include '../db_connection.php';

// Start the session
session_start();

// Initialize variables for search criteria
$searchName = $searchSurname = $searchID = "";

// Check if the search form is submitted
if (isset($_POST['apply_search'])) {
    // Get search criteria from the form
    $searchName = $_POST['search_name'];
    $searchSurname = $_POST['search_surname'];
    $searchID = $_POST['search_id'];

    // Construct the SQL query based on the entered criteria
    $sql = "SELECT * FROM customers WHERE 
            (Name LIKE ? OR ? = '') AND
            (Surname LIKE ? OR ? = '') AND
            (ID LIKE ? OR ? = '')";

    // Use prepared statements to prevent SQL injection
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssss", $searchName, $searchName, $searchSurname, $searchSurname, $searchID, $searchID);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        echo "Error: " . $stmt->error;
    }
}

// Check if the "Manage Customers" button is clicked
if (isset($_POST['manage_customers'])) {
    // Retrieve a list of all customers
    $allCustomersSql = "SELECT * FROM customers";
    $allCustomersResult = $connection->query($allCustomersSql);

    if (!$allCustomersResult) {
        echo "Error: " . $allCustomersSql . "<br>" . $connection->error;
    }
}

// Check if the "Pending Orders" button is clicked
if (isset($_POST['pending_orders'])) {
    // Retrieve a list of orders with status 'pending' and associated details
    $pendingOrdersSql = "SELECT orders.OrderID, orders.CustomerID, orders.OrderDate, customers.Name, customers.Surname, orderpackages.TravelPackageID
                     FROM orders
                     JOIN customers ON orders.CustomerID = customers.ID
                     JOIN orderpackages ON orders.OrderID = orderpackages.OrderID
                     WHERE orders.status = 'pending'";

    $pendingOrdersResult = $connection->query($pendingOrdersSql);

    if (!$pendingOrdersResult) {
        echo "Error: " . $pendingOrdersSql . "<br>" . $connection->error;
    }
}

// Check if the "Edit" or "Save" button is clicked
if (isset($_POST['edit_customer']) || isset($_POST['save_customer'])) {
    $editedCustomerId = $_POST['customer_id'];

    // Retrieve the customer data for editing
    $editCustomerSql = "SELECT * FROM customers WHERE ID = ?";
    $stmt = $connection->prepare($editCustomerSql);
    $stmt->bind_param("s", $editedCustomerId);
    $stmt->execute();
    $editedCustomerResult = $stmt->get_result();

    if (!$editedCustomerResult) {
        echo "Error: " . $stmt->error;
    }

    // Check if the "Save" button is clicked
    if (isset($_POST['save_customer'])) {
        // Update the customer data in the database
        $updatedName = $_POST['updated_name'];
        $updatedSurname = $_POST['updated_surname'];
        $updatedEmail = $_POST['updated_email'];
        $updatedPassword = $_POST['updated_password'];
        $updatedAddress = $_POST['updated_address'];
        $updatedPhone = $_POST['updated_phone'];

        $updateCustomerSql = "UPDATE customers SET Name=?, Surname=?, EMAIL=?, PASSWORD=?, ADDRESS=?, PHONE=? WHERE ID=?";
        $stmt = $connection->prepare($updateCustomerSql);
        $stmt->bind_param("sssssss", $updatedName, $updatedSurname, $updatedEmail, $updatedPassword, $updatedAddress, $updatedPhone, $editedCustomerId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Customer data updated successfully.";
        } else {
            echo "Error updating customer data: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Webpage Title</title>
    <!-- Add any other head content you need -->
</head>
<body>

<!-- Search Form -->
<form method="post" action="">
    <label for="search_name">Name:</label>
    <input type="text" name="search_name" value="<?php echo $searchName; ?>">
    <label for="search_surname">Surname:</label>
    <input type="text" name="search_surname" value="<?php echo $searchSurname; ?>">
    <label for="search_id">ID:</label>
    <input type="text" name="search_id" value="<?php echo $searchID; ?>">
    <input type="submit" name="apply_search" value="Apply Search">
</form>
<!-- Manage Customers Button -->
<form method="post" action="">
    <input type="submit" name="manage_customers" value="Manage Customers">
</form>
<!-- Manage Customers Table -->
<!-- Manage Customers Table -->
<?php
if (isset($allCustomersResult)) {
    echo "<h2>Manage Customers</h2>";

    if ($allCustomersResult->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>";

        while ($row = $allCustomersResult->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["ID"] . "</td>
                    <td>" . $row["NAME"] . "</td>
                    <td>" . $row["SURNAME"] . "</td>
                    <td>" . $row["EMAIL"] . "</td>
                    <td>" . $row["PASSWORD"] . "</td>
                    <td>" . $row["ADDRESS"] . "</td>
                    <td>" . $row["PHONE"] . "</td>
                    <td>";

            // Check if "Edit" button is clicked
            if (isset($_POST['edit_customer']) && $_POST['customer_id'] == $row['ID']) {
                // Display form fields for editing
                echo "<form method='post' action=''>
                        <input type='hidden' name='customer_id' value='" . $row["ID"] . "'>
                        Name: <input type='text' name='updated_name' value='" . $row["NAME"] . "'><br>
                        Surname: <input type='text' name='updated_surname' value='" . $row["SURNAME"] . "'><br>
                        Email: <input type='text' name='updated_email' value='" . $row["EMAIL"] . "'><br>
                        Password: <input type='text' name='updated_password' value='" . $row["PASSWORD"] . "'><br>
                        Address: <input type='text' name='updated_address' value='" . $row["ADDRESS"] . "'><br>
                        Phone: <input type='text' name='updated_phone' value='" . $row["PHONE"] . "'><br>
                        <input type='submit' name='save_customer' value='Save'>
                      </form>";
            } else {
                // Display "Edit" button
                echo "<form method='post' action=''>
                        <input type='hidden' name='customer_id' value='" . $row["ID"] . "'>
                        <input type='submit' name='edit_customer' value='Edit'>
                      </form>";
            }

            echo "</td></tr>";
        }

        echo "</table>";
    } else {
        echo "No customers found";
    }
}
?>




<!-- Pending Orders Button -->
<form method="post" action="">
    <input type="submit" name="pending_orders" value="Pending Orders">
</form>

<!-- Display Search Results -->
<?php
if (isset($result)) {
    echo "<h2>Search Results</h2>";
    // Display search results table here using $result
}

// Display Pending Orders
if (isset($_POST['pending_orders'])) {
    // Retrieve a list of orders with status 'pending' and associated details
    $pendingOrdersSql = "SELECT orders.OrderID, orders.CustomerID, customers.Name, customers.Surname, orderpackages.TravelPackageID
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
            echo "<table border='1'>
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>CustomerID</th>
                        <th>OrderID</th>
                        <th>Travel Package Details</th>
                    </tr>";

            while ($row = $pendingOrdersResult->fetch_assoc()) {
                // Retrieve additional details from the packages table using TravelPackageID
                $travelPackageSql = "SELECT * FROM packages WHERE TravelPackageID = " . $row['TravelPackageID'];
                $travelPackageResult = $connection->query($travelPackageSql);

                if (!$travelPackageResult) {
                    echo "Error: " . $travelPackageSql . "<br>" . $connection->error;
                }

                // Display row data
                echo "<tr>
                        <td>" . $row["Name"] . "</td>
                        <td>" . $row["Surname"] . "</td>
                        <td>" . $row["CustomerID"] . "</td>
                        <td>" . $row["OrderID"] . "</td>
                        <td>" . $row["TravelPackageID"] . "</td>
                      </tr>";
            }

            echo "</table>";
        } else {
            echo "No pending orders found";
        }
    }
}
?>

</body>
</html>
