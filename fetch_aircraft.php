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
        // Collect aircraft ID from the form
        $aircraftID = isset($_POST["fetchAircraftId"]) ? $_POST["fetchAircraftId"] : "";

        if (!empty($aircraftID)) {
            // SQL query to retrieve aircraft information based on the provided ID
            $sql = "SELECT * FROM aircraft WHERE aircraft_id = '$aircraftID'";
        } else {
            // SQL query to retrieve all aircraft
            $sql = "SELECT * FROM aircraft";
        }

        $result = $conn->query($sql);

        // Display aircraft information
        if ($result->num_rows > 0) {
            echo "<div style='text-align: center'>";
            echo "<h2>Aircraft Information:</h2>";
            echo "<table border='1' style='margin-bottom: 20px'>";
            echo "<tr><th>Aircraft ID</th><th>Aircraft Type</th><th>Manufacturer</th><th>Capacity</th></tr>";
            echo "</div>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["aircraft_id"] . "</td><td>" . $row["aircraftType"] . "</td><td>" . $row["manufacturer"] . "</td><td>" . $row["capacity"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            if (!empty($aircraftID)) {
                echo "No aircraft found with the provided ID: $aircraftID";
            } else {
                echo "No aircraft found.";
            }
        }
    }

    // Close connection
    $conn->close();
?>
