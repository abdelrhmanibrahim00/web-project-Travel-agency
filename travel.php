<?php
// Replace these variables with your actual database credentials
include 'db_connection.php';

// Handle the form submission for date range and country filtering
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fromDate = $_POST["fromDate"];
    $toDate = $_POST["toDate"];

    // Add this condition to the SQL query to filter by date range
    $dateCondition = "";
    if ($fromDate && $toDate) {
        $dateCondition = "AND DepartureDate BETWEEN '$fromDate' AND '$toDate'";
    }

    // Handle country filtering
    $selectedCountry = $_POST["country"];
    $countryCondition = "";
    if (!empty($selectedCountry)) {
        $countryCondition = "AND Destination LIKE '%" . $selectedCountry . "%'";
    }

    // Fetch the list of packages from the database based on the selected date range and country
    $sql = "SELECT * FROM packages WHERE 1 $dateCondition $countryCondition";
    $result = $connection->query($sql);
} else {
    // Fetch all packages if no date range or country is selected
    $sql = "SELECT * FROM packages";
    $result = $connection->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: url('p4.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        header {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px;
            text-align: center;
        }

        h1, h2, h3, p {
            color: #fff;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
        }

        nav {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        nav a {
            color: #fff;
            margin: 0 10px;
            text-decoration: none;
            font-weight: bold;
        }

        .travel-package {
            border: 2px solid #fff;
            padding: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            background: rgba(0, 0, 0, 0.3); /* Darker background */
        }

        .travel-package-text {
            flex-grow: 1;
            margin-right: 10px;
            z-index: 1; /* Ensure text is above the background */
        }

        .travel-package button {
            width: 200px; /* Adjust the width as needed */
            height: 40px; /* Adjust the height as needed */
            background-color: blue; /* Set the button color to blue */
            color: #fff; /* Set text color to white */
            border: none;
            cursor: pointer;
        }

        .travel-package button:hover {
            background-color: #0066cc; /* Change the hover color if needed */
        }

        .travel-package-image {
            width: 50%;
            border-radius: 10px;
            overflow: hidden;
        }

        .travel-package img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px;
            text-align: center;
            color: #fff;
        }
    </style>
</head>
<body>

<header>
    <h1>Horizon Adventures</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="login.php">My Orders</a>
        <a href="insurance.php">Insurance</a>
        <a href="contact.php">Contact</a>
        <a href="about.php">About</a>
    </nav>
</header>

<section>
    <h2>Travel</h2>

    <!-- Add this HTML form for search criteria -->
    <form method="post" action="">
        <label for="fromDate">From Date:</label>
        <input type="date" id="fromDate" name="fromDate">

        <label for="toDate">To Date:</label>
        <input type="date" id="toDate" name="toDate">

        <label for="country">Select Country:</label>
        <select id="country" name="country">
            <option value="">Select a Country</option>
            <option value="France">France</option>
            <option value="Japan">Japan</option>
            <option value="Italy">Italy</option>
            <option value="United States">United States</option>
            <option value="United Kingdom">United Kingdom</option>
            <option value="Spain">Spain</option>
            <option value="Germany">Germany</option>
            <option value="Malta">Malta</option>
            <option value="Romania">Romania</option>
        </select>

        <button type="submit" name="applyFilter">Apply Filter</button>
    </form>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $photoFolder = 'Photos/';
            $photos = glob($photoFolder . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
            $randomPhoto = $photos[array_rand($photos)];

            echo '<div class="travel-package">';
            echo '<div class="travel-package-text">';
            echo '<h3>' . $row['Destination'] . '</h3>';
            echo '<p>Departure Date: ' . $row['DepartureDate'] . '</p>';
            echo '<p>Return Date: ' . $row['ReturnDate'] . '</p>';
            echo '<p>Flight Details: ' . $row['FlightDetails'] . '</p>';
            echo '<p>Accommodation Details: ' . $row['AccommodationDetails'] . '</p>';
            echo '<p>Price: ' . $row['Price'] . ' €</p>';
            echo '<button onclick="redirectToOrder()">Select</button>';
            echo '</div>';
            echo '<div class="travel-package-image">';
            echo '<img src="' . $randomPhoto . '" alt="Package Image">';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo 'No travel packages found.';
    }
    ?>
</section>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Abdelrhman_Ahmed_IFU1</p>
</footer>

<script>
    function redirectToOrder() {
        window.location.href = 'login.php';
    }
</script>

</body>
</html>

<?php
// Close the database connection when done
$connection->close();
?>
