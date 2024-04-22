<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Home Page</title>
</head>
<body>
    <h1>Welcome to the Admin Home Page!</h1>
    <section>
        <h2>Logout</h2>
        <p>Click the button below to log in:</p>
        <a href="../index.php"><button>Logout</button></a>
    </section>
    

    <!-- Button to redirect to Customers page -->
    <a href="employee_customers.php">
        <button>Manage Customers</button>
    </a>

    <!-- Button to redirect to Employees page -->
    <a href="orders.php">
        <button>Manage orders</button>
    </a>
    <a href="packages.php">
        <button>Manage Travel packages</button>
    </a>
    <a href="Add packages.php">
        <button>Add Travel packages</button>
    </a>

    <!-- Add any additional content specific to the admin's home page if needed -->
</body>
</html>
