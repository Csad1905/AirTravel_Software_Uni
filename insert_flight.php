<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $flightNumber = $_POST["flightNumber"];
    $aircraftId = $_POST["aircraftId"];
    $airlineId = $_POST["airlineId"];
    $departAp = $_POST["departAp"];
    $departGate = $_POST["departGate"];
    $departTime = $_POST["departTime"];
    $arrivAp = $_POST["arrivAp"];
    $arrivGate = $_POST["arrivGate"];
    $arrivTime = $_POST["arrivTime"];

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

    // Insert data into the departure table
    $sqlDepart = "INSERT INTO departures (departureAirportCode, departureGate, departureTime)
    VALUES ('$departAp', '$departGate', '$departTime')";
    
    if ($conn->query($sqlDepart) === FALSE) {
        echo "Error: " . $sqlDepart . "<br>" . $conn->error;
        $conn->close();
        exit();
    }

    // Get the ID of the inserted departure record
    $departId = $conn->insert_id;

    // Insert data into the arrival table
    $sqlArriv = "INSERT INTO arrivals (arrivalAirportCode, arrivalGate, arrivalTime)
    VALUES ('$arrivAp', '$arrivGate', '$arrivTime')";

    if ($conn->query($sqlArriv) === FALSE) {
        echo "Error: " . $sqlArriv . "<br>" . $conn->error;
        $conn->close();
        exit();
    }

    // Get the ID of the inserted arrival record
    $arrivId = $conn->insert_id;

    // Insert data into the flights table using the IDs of departure and arrival
    $sqlFlight = "INSERT INTO flights (flight_no, aircraft_id, airline_id, departure_id, arrival_id)
    VALUES ('$flightNumber', '$aircraftId', '$airlineId', '$departId', '$arrivId')";

    if ($conn->query($sqlFlight) === TRUE) {
        echo "Flight added successfully!";
    } else {
        echo "Error: " . $sqlFlight . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
