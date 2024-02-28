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

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect flight number from the form
        $flightNumber = isset($_POST["fetchFlightId"]) ? $_POST["fetchFlightId"] : "";

        if (!empty($flightNumber)) {
            // SQL query to retrieve flight information with linked departures and arrivals
            $sql = "SELECT flights.flight_no, flights.airline_id, flights.aircraft_id, departures.departureAirportCode, departures.departureTime, arrivals.arrivalAirportCode, arrivals.arrivalTime
                    FROM flights
                    INNER JOIN departures ON flights.departure_id = departures.departure_id
                    INNER JOIN arrivals ON flights.arrival_id = arrivals.arrival_id
                    WHERE flights.flight_no = '$flightNumber'";
        } else {
            // SQL query to retrieve all flights with linked departures and arrivals
            $sql = "SELECT flights.flight_no, flights.airline_id, flights.aircraft_id, departures.departureAirportCode, departures.departureTime, arrivals.arrivalAirportCode, arrivals.arrivalTime
                    FROM flights
                    INNER JOIN departures ON flights.departure_id = departures.departure_id
                    INNER JOIN arrivals ON flights.arrival_id = arrivals.arrival_id";
        }

        $result = $conn->query($sql);

        // Display flight information with linked departures and arrivals
        if ($result->num_rows > 0) {
            echo "<div style='text-align: center'>";
            echo "<h2>Flight Information:</h2>";
            echo "<table border='1' style='margin-bottom: 20px'>";
            echo "<tr><th>Flight Number</th><th>Airline ID</th><th>Aircraft ID</th><th>Departure Location</th><th>Departure Time</th><th>Arrival Location</th><th>Arrival Time</th></tr>";
            echo "</div>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["flight_no"] . "</td><td>" . $row["airline_id"] . "</td><td>" . $row["aircraft_id"] . "</td><td>" . $row["departureAirportCode"] . "</td><td>" . $row["departureTime"] . "</td><td>" . $row["arrivalAirportCode"] . "</td><td>" . $row["arrivalTime"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            if (!empty($flightNumber)) {
                echo "No flight found with the provided flight number: $flightNumber";
            } else {
                echo "No flights found.";
            }
        }
    }

    // Close connection
    $conn->close();
?>
