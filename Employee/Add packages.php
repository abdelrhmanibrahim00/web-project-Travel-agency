<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Package</title>
</head>
<body>
    <h1>Add Package</h1>
    <section>
        <h2>Home</h2>
        <p>Click the button below to go to home:</p>
        <a href="employee_home.php"><button>Home</button></a>
    </section>

    <?php
    // Include the database connection file
    include '../db_connection.php';

    // Handle the form submission for adding a new package
    if (isset($_POST['insert'])) {
        $destination = $_POST['destination'];
        $departureDate = $_POST['departure_date'];
        $returnDate = $_POST['return_date'];
        $flightDetails = $_POST['flight_details'];
        $accommodationDetails = $_POST['accommodation_details'];
        $price = $_POST['price'];

        // Insert the new package into the database
        $insertQuery = "INSERT INTO packages (Destination, DepartureDate, ReturnDate, FlightDetails, AccommodationDetails, Price) 
                        VALUES ('$destination', '$departureDate', '$returnDate', '$flightDetails', '$accommodationDetails', '$price')";

        if ($connection->query($insertQuery) === TRUE) {
            echo 'Package inserted successfully.';
        } else {
            echo 'Error inserting package: ' . $connection->error;
        }
    }
    ?>

    <!-- Form for adding a new package -->
    <form method="post" action="admin_packages.php">
        <label for="destination">Destination:</label>
        <input type="text" name="destination" required><br>

        <label for="departure_date">Departure Date:</label>
        <input type="date" name="departure_date" required><br>

        <label for="return_date">Return Date:</label>
        <input type="date" name="return_date" required><br>

        <label for="flight_details">Flight Details:</label>
        <input type="text" name="flight_details" required><br>

        <label for="accommodation_details">Accommodation Details:</label>
        <input type="text" name="accommodation_details" required><br>

        <label for="price">Price:</label>
        <input type="text" name="price" required><br>

        <button type="submit" name="insert">Insert</button>
    </form>

    <?php
    // Close the database connection
    $connection->close();
    ?>
</body>
</html>
