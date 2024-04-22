<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
</head>
<body>
    <h1>Add Employee</h1>
    <section>
        <h2>Home</h2>
        <p>Click the button below to go to home:</p>
        <a href="admin_home.php"><button>Home</button></a>
    </section>

    <?php
    // Include the database connection file
    include '../db_connection.php';

    // Handle the form submission for adding a new employee
    if (isset($_POST['insert'])) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];

        // Insert the new employee into the database
        $insertQuery = "INSERT INTO employees (Name, Surname, Email, Password, Address, Phone) 
                        VALUES ('$name', '$surname', '$email', '$password', '$address', '$phone')";

        if ($connection->query($insertQuery) === TRUE) {
            echo 'Employee inserted successfully.';
        } else {
            echo 'Error inserting employee: ' . $connection->error;
        }
    }
    ?>

    <!-- Form for adding a new employee -->
    <form method="post" action="admin_employees.php">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="surname">Surname:</label>
        <input type="text" name="surname" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="address">Address:</label>
        <input type="text" name="address" required><br>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" required><br>

        <button type="submit" name="insert">Insert</button>
    </form>

    <?php
    // Close the database connection
    $connection->close();
    ?>
</body>
</html>
