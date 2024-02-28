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
        // Collect airport code from the form
        $airportCode = isset($_POST["fetchAirportId"]) ? $_POST["fetchAirportId"] : "";

        if (!empty($airportCode)) {
            // SQL query to retrieve airport information based on the provided code
            $sql = "SELECT * FROM airport WHERE airport_code = '$airportCode'";
        } else {
            // SQL query to retrieve all airports
            $sql = "SELECT * FROM airport";
        }

        $result = $conn->query($sql);

        // Display airport information
        if ($result->num_rows > 0) {
            echo "<div style='text-align: center'>";
            echo "<h2>Airport Information:</h2>";
            echo "<table border='1' style='margin-bottom: 20px'>";
            echo "<tr><th>Airport Code</th><th>Airport Name</th><th>Location</th><th>Capacity</th><th>Runway Length (meters)</th></tr>";
            echo "</div>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["airport_code"] . "</td><td>" . $row["airportName"] . "</td><td>" . $row["airportLocation"] . "</td><td>" . $row["airportCapacity"] . "</td><td>" . $row["runwayLengthInMeters"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            if (!empty($airportCode)) {
                echo "No airport found with the provided code: $airportCode";
            } else {
                echo "No airports found.";
            }
        }
    }

    // Close connection
    $conn->close();
?>
