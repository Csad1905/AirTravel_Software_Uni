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
        // Collect airline ID from the form
        $airlineID = isset($_POST["fetchAirlineId"]) ? $_POST["fetchAirlineId"] : "";

        if (!empty($airlineID)) {
            // SQL query to retrieve airline information based on the provided ID
            $sql = "SELECT * FROM airline WHERE airline_id = '$airlineID'";
        } else {
            // SQL query to retrieve all airlines
            $sql = "SELECT * FROM airline";
        }

        $result = $conn->query($sql);

        // Display airline information
        if ($result->num_rows > 0) {
            echo "<div style='text-align: center'>";
            echo "<h2>Airline Information:</h2>";
            echo "<table border='1' style='margin-bottom: 20px'>";
            echo "<tr><th>Airline ID</th><th>Airline Name</th></tr>";
            echo "</div>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["airline_id"] . "</td><td>" . $row["airlineName"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            if (!empty($airlineID)) {
                echo "No airline found with the provided ID: $airlineID";
            } else {
                echo "No airlines found.";
            }
        }
    }

    // Close connection
    $conn->close();
?>
