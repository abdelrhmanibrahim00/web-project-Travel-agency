<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Packages Page</title>
</head>
<body>
    <h1>Manage Packages</h1>
    <section>
        <h2>Home</h2>
        <p>Click the button below to go to home:</p>
        <a href="employee_home.php"><button>Home</button></a>
    </section>

    <?php
    // Include the database connection file
    include '../db_connection.php';

    // Fetch the list of packages from the database
    $sql = "SELECT * FROM packages";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        // Display a table with package data and modification form
        echo '<table border="1">';
        echo '<tr><th>TravelPackageID</th><th>Destination</th><th>DepartureDate</th><th>ReturnDate</th><th>FlightDetails</th><th>AccommodationDetails</th><th>Price</th><th>Action</th></tr>';

        while($row = $result->fetch_assoc()) {
            echo '<form method="post" action="admin_packages.php">';
            echo '<tr>';
            echo '<td>'.$row['TravelPackageID'].'</td>';
            echo '<td><input type="text" name="destination" value="'.$row['Destination'].'" required></td>';
            echo '<td><input type="date" name="departure_date" value="'.$row['DepartureDate'].'" required></td>';
            echo '<td><input type="date" name="return_date" value="'.$row['ReturnDate'].'" required></td>';
            echo '<td><input type="text" name="flight_details" value="'.$row['FlightDetails'].'" required></td>';
            echo '<td><input type="text" name="accommodation_details" value="'.$row['AccommodationDetails'].'" required></td>';
            echo '<td><input type="text" name="price" value="'.$row['Price'].'" required></td>';
            echo '<td>';
            echo '<input type="hidden" name="travel_package_id" value="'.$row['TravelPackageID'].'">';
            echo '<button type="submit" name="edit">Save</button>';
            echo '<button type="submit" name="delete" onclick="return confirm(\'Are you sure you want to delete this package?\')">Delete</button>';
            echo '</td>';
            echo '</tr>';
            echo '</form>';
        }

        echo '</table>';
    } else {
        echo 'No packages found.';
    }

    // Handle the form submission for editing package details
    if (isset($_POST['edit'])) {
        $travelPackageID = $_POST['travel_package_id'];
        $destination = $_POST['destination'];
        $departureDate = $_POST['departure_date'];
        $returnDate = $_POST['return_date'];
        $flightDetails = $_POST['flight_details'];
        $accommodationDetails = $_POST['accommodation_details'];
        $price = $_POST['price'];

        // Display confirmation button
        echo '<form method="post" action="admin_packages.php">';
        echo '<input type="hidden" name="travel_package_id" value="'.$travelPackageID.'">';
        echo '<input type="hidden" name="destination" value="'.$destination.'">';
        echo '<input type="hidden" name="departure_date" value="'.$departureDate.'">';
        echo '<input type="hidden" name="return_date" value="'.$returnDate.'">';
        echo '<input type="hidden" name="flight_details" value="'.$flightDetails.'">';
        echo '<input type="hidden" name="accommodation_details" value="'.$accommodationDetails.'">';
        echo '<input type="hidden" name="price" value="'.$price.'">';
        echo '<button type="submit" name="confirm">Confirm Edit</button>';
        echo '</form>';
    }

    // Handle the form submission for deleting a package
    if (isset($_POST['delete'])) {
        $travelPackageIDToDelete = $_POST['travel_package_id'];

        // Delete the package from the database
        $deleteQuery = "DELETE FROM packages WHERE TravelPackageID = $travelPackageIDToDelete";

        if ($connection->query($deleteQuery) === TRUE) {
            echo 'Package deleted successfully.';
        } else {
            echo 'Error deleting package: ' . $connection->error;
        }
    }

    // Handle the confirmation and update the database
    if (isset($_POST['confirm'])) {
        $travelPackageID = $_POST['travel_package_id'];
        $destination = $_POST['destination'];
        $departureDate = $_POST['departure_date'];
        $returnDate = $_POST['return_date'];
        $flightDetails = $_POST['flight_details'];
        $accommodationDetails = $_POST['accommodation_details'];
        $price = $_POST['price'];

        // Update the package details in the database
        $updateQuery = "UPDATE packages SET 
                        Destination = '$destination', 
                        DepartureDate = '$departureDate', 
                        ReturnDate = '$returnDate', 
                        FlightDetails = '$flightDetails', 
                        AccommodationDetails = '$accommodationDetails', 
                        Price = '$price' 
                        WHERE TravelPackageID = $travelPackageID";

        if ($connection->query($updateQuery) === TRUE) {
            echo 'Package details updated successfully.';
        } else {
            echo 'Error updating package details: ' . $connection->error;
        }
    }

    // Close the database connection
    $connection->close();
    ?>
</body>
</html>
