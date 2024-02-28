<?php
// Database connection settings
$servername = "185.114.98.6";
$username = "csadleruoswebco_";
$password = "password";
$dbname = "airTravelDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect airport code from the form
    $airportCode = $_POST["deleteAirportId"];

    // Update departures
    $sql_update_departures = "UPDATE departures SET departureAirportCode = NULL WHERE departureAirportCode = '$airportCode'";
    $conn->query($sql_update_departures);

    // Update arrivals
    $sql_update_arrivals = "UPDATE arrivals SET arrivalAirportCode = NULL WHERE arrivalAirportCode = '$airportCode'";
    $conn->query($sql_update_arrivals);

    // Delete the airport
    deleteAirport($conn, $airportCode);
}

// Close connection
$conn->close();

function deleteAirport($conn, $airportCode) {
    // Delete the airport
    $sql_delete_airport = "DELETE FROM airport WHERE airport_code = '$airportCode'";
    if ($conn->query($sql_delete_airport) !== TRUE) {
        echo "Error deleting airport: " . $conn->error;
    } else {
        echo "Airport with code $airportCode updated successfully!";
    }
}
?>
