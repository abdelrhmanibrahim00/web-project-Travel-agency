<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 300px;
            padding: 16px;
            margin: 0 auto;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        .register-btn {
            background-color: #008CBA;
        }

        .error-message {
            color: red;
            font-size: small;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Login Form</h2>
    <form action="login_process.php" method="post">
        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <?php
    // Include the database connection file
    include 'db_connection.php';

    // Your login logic here
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve user input
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Redirect to the appropriate home page based on user type
        include 'login_process.php';

        // Close the database connection when done
        $connection->close();
    }
    ?>

    <button class="register-btn" onclick="window.location.href='register.php'">Register</button>
</div>

</body>
</html>