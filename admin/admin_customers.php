<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Customers Page</title>
</head>
<body>
    <h1>Manage Customers</h1>
    <section>
        <h2>Home</h2>
        <p>Click the button below to go to home in:</p>
        <a href="admin_home.php"><button>Home</button></a>
    </section>

    <?php
    // Include the database connection file
    include 'db_connection.php';

    // Fetch the list of customers from the database
    $sql = "SELECT * FROM customers";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        // Display a table with customer data and modification form
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>Name</th><th>Surname</th><th>Email</th><th>Phone</th><th>Address</th><th>Action</th></tr>';

        while($row = $result->fetch_assoc()) {
            echo '<form method="post" action="admin_customers.php">';
            echo '<tr>';
            echo '<td>'.$row['ID'].'</td>';
            echo '<td><input type="text" name="name" value="'.$row['NAME'].'" required></td>';
            echo '<td><input type="text" name="surname" value="'.$row['SURNAME'].'" required></td>';
            echo '<td><input type="text" name="email" value="'.$row['EMAIL'].'" required></td>';
            echo '<td><input type="text" name="phone" value="'.$row['PHONE'].'" required></td>';
            echo '<td><input type="text" name="address" value="'.$row['ADDRESS'].'" required></td>';
            echo '<td>';
            echo '<input type="hidden" name="id" value="'.$row['ID'].'">';
            echo '<button type="submit" name="edit">Save</button>';
            echo '<button type="submit" name="delete" onclick="return confirm(\'Are you sure you want to delete this customer?\')">Delete</button>';
            echo '</td>';
            echo '</tr>';
            echo '</form>';
        }

        echo '</table>';
    } else {
        echo 'No customers found.';
    }

    // Handle the form submission for editing customer details
    if (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        // Display confirmation button
        echo '<form method="post" action="admin_customers.php">';
        echo '<input type="hidden" name="id" value="'.$id.'">';
        echo '<input type="hidden" name="name" value="'.$name.'">';
        echo '<input type="hidden" name="surname" value="'.$surname.'">';
        echo '<input type="hidden" name="email" value="'.$email.'">';
        echo '<input type="hidden" name="phone" value="'.$phone.'">';
        echo '<input type="hidden" name="address" value="'.$address.'">';
        echo '<button type="submit" name="confirm">Confirm Edit</button>';
        echo '</form>';
    }

    // Handle the form submission for deleting a customer
    if (isset($_POST['delete'])) {
        $idToDelete = $_POST['id'];

        // Delete the customer from the database
        $deleteQuery = "DELETE FROM customers WHERE ID = $idToDelete";

        if ($connection->query($deleteQuery) === TRUE) {
            echo 'Customer deleted successfully.';
        } else {
            echo 'Error deleting customer: ' . $connection->error;
        }
    }

    // Handle the confirmation and update the database
    if (isset($_POST['confirm'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        // Update the customer details in the database
        $updateQuery = "UPDATE customers SET NAME = '$name', SURNAME = '$surname', 
                        EMAIL = '$email', PHONE = '$phone', ADDRESS = '$address' WHERE ID = $id";

        if ($connection->query($updateQuery) === TRUE) {
            echo 'Customer details updated successfully.';
        } else {
            echo 'Error updating customer details: ' . $connection->error;
        }
    }

    // Close the database connection
    $connection->close();
    ?>
</body>
</html>
