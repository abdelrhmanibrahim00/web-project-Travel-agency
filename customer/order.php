<?php
// Include your database connection file
include '../db_connection.php';

// Start the session
session_start();

// Check if the customer_id is set in the session
if (isset($_SESSION["customers_ID"])) {
    // Retrieve the customer_id from the session
    $customerID = $_SESSION["customers_ID"];
} else {
    // If customer_id is not set, handle this case (e.g., redirect to a previous page)
    echo "Error: Customer ID not found in the session.";
    exit();
}

// Retrieve TravelPackageID from localStorage
$travelPackageID = isset($_GET["TravelPackageID"]) ? $_GET["TravelPackageID"] : null;

// Check if TravelPackageID is set
if (!$travelPackageID) {
    // If TravelPackageID is not set, handle this case (e.g., redirect to a previous page)
    echo "Error: TravelPackageID not found in the URL.";
    exit();
}

// Generate a random 4-digit Invoice Number
$invoiceNumber = mt_rand(1000, 9999);

// Initialize payment message variable
$paymentMessage = '';

// Handle payment submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pay"])) {
    // Insert data into the orders table
    $orderDate = date("Y-m-d");
    $sqlOrder = "INSERT INTO orders (CustomerID, OrderDate, InvoiceNumber) VALUES ('$customerID', '$orderDate', '$invoiceNumber')";

    if ($connection->query($sqlOrder) === TRUE) {
        // Get the OrderID of the inserted order
        $orderID = $connection->insert_id;

        // Insert data into the orderpackages table
        $sqlOrderPackages = "INSERT INTO orderpackages (OrderID, TravelPackageID) VALUES ('$orderID', '$travelPackageID')";

        if ($connection->query($sqlOrderPackages) === TRUE) {
            $paymentMessage = "Payment successful. Invoice Number: $invoiceNumber";
        } else {
            // Display detailed error message and halt script
            die("Error inserting into orderpackages: " . $sqlOrderPackages . "<br>" . $connection->error);
        }

        // Close the database connection
        $connection->close();
    } else {
        // Display detailed error message and halt script
        die("Error inserting into orders: " . $sqlOrder . "<br>" . $connection->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your head content remains unchanged -->
</head>
<body>

<div class="payment-info">
    <h2>Payment Information</h2>
    <p>Bank Name: Swed Bank</p>
    <p>Address: Vilnius, Lithuania</p>
    <p>IBAN: LT 4XXXXXXXXXX</p>
    <p>Swift Code: SwedXXX</p>
    <p>Invoice Number: <?php echo $invoiceNumber; ?></p>
</div>

<!-- Form for payment submission -->
<form method="post">
    <!-- Use a regular button instead of a submit button -->
    <button type="submit" name="pay">Pay</button>
</form>

<!-- Placeholder for payment message -->
<div id="paymentMessage"><?php echo $paymentMessage; ?></div>
<button type="button" onclick="redirectAfterPayment()">Done</button>

<script>
    function redirectAfterPayment() {
        // Simulate payment success message
        var paymentMessage = "Payment successful. Invoice Number: <?php echo $invoiceNumber; ?>";

        // Update the payment message on the page
        document.getElementById('paymentMessage').innerHTML = paymentMessage;

        // Set a timeout to redirect after 5 seconds
        setTimeout(function () {
            window.location.href = 'myorders.php';
        }, 500); // 5000 milliseconds = 5 seconds
    }
</script>

</body>
</html>
