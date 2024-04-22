<?php
// Include your database connection file
include 'db_connection.php';

// Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Example: Check if the email is in the admin table
    if (strpos($email, '@adm') !== false) {
        $sql = "SELECT * FROM admins WHERE EMAIL = '$email' AND PASSWORD = '$password'";
        $redirectPage = "admin/admin_home.php";
        $userType = "admin";
    } elseif (strpos($email, '@emp') !== false) {
        $sql = "SELECT * FROM employees WHERE EMAIL = '$email' AND PASSWORD = '$password'";
        $redirectPage = "Employee/employee_home.php";
        $userType = "employee";
    } else {
        // Query the customers table
        $sql = "SELECT * FROM customers WHERE EMAIL = '$email' AND PASSWORD = '$password'";
        $redirectPage = "customer/customer_home.php";
        $userType = "customer";
    }

    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        // Login successful, start a PHP session
        session_start();

        while ($row = $result->fetch_assoc()) {
            // Store the user ID based on the user type
            if ($userType == "admin") {
                $_SESSION["admins_ID"] = $row["ID"];
            } elseif ($userType == "employee") {
                $_SESSION["employees_ID"] = $row["ID"];
            } elseif ($userType == "customer") {
                $_SESSION["customers_ID"] = $row["ID"];
            }

            // Common session variable for email
            $_SESSION["email"] = $row["email"];
            $_SESSION["user_type"] = $userType;
        }

        // Redirect to the appropriate home page
        header("Location: $redirectPage");
        exit();
    } else {
        // Invalid email or password, redirect to the login page with an error message
        header("Location: login.php?error=Invalid email or password");
        exit();
    }
}

// Close the database connection when done
$connection->close();
?>
