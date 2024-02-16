<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $aircraftType = $_POST["aircraftType"];
    $aircraftManufacturer = $_POST["aircraftManufacturer"];
    $aircraftCapacity = $_POST["aircraftCapacity"];

    // Database connection settings
    $servername = "46.183.8.124";
    $username = "csadleruoswebco_";
    $password = "password";
    $dbname = "airTravelDB";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to insert data into the database
    $sql = "INSERT INTO aircraft (aircraftType, manufacturer, capacity)
    VALUES ('$aircraftType', '$aircraftManufacturer', '$aircraftCapacity')";

    if ($conn->query($sql) === TRUE) {
        echo "Aircraft added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
