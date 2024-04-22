<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $password = $_POST["password"];  // Add this line for the password

    // Check if the email already exists in the customers table
    $checkEmailQuery = "SELECT * FROM customers WHERE EMAIL = '$email'";
    $result = $connection->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        // Email already used, display a message and ask to change the email
        echo "The email is already used. Please choose a different email.";
    } else {
        // Insert the new user into the customers table
        // Modify the column names based on your database structure
        $insertQuery = "INSERT INTO customers (NAME, SURNAME, PHONE, EMAIL, ADDRESS, PASSWORD)
                        VALUES ('$name', '$surname', '$phone', '$email', '$address', '$password')";

        if ($connection->query($insertQuery) === TRUE) {
            // Registration successful, redirect to login page
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $insertQuery . "<br>" . $connection->error;
        }
    }

    // Close the database connection when done
    $connection->close();
}
?>
