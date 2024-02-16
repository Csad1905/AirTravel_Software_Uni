<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $airportCode = $_POST["airportCode"];
    $airportName = $_POST["airportName"];
    $airportLocation = $_POST["airportLocation"];
    $airportCapacity = $_POST["airportCapacity"];
    $runwayLength = $_POST["runwayLength"];

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
    $sql = "INSERT INTO airport (airport_code, airportName, airportLocation, airportCapacity, runwayLengthInMeters)
    VALUES ('$airportCode', '$airportName', '$airportLocation', '$airportCapacity', '$runwayLength')";

    if ($conn->query($sql) === TRUE) {
        echo "Airport added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
