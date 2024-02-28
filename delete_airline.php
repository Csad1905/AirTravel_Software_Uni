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
    // Collect airline ID from the form
    $airlineId = $_POST["deleteAirlineId"];

    // SQL query to find all flights associated with the airline ID
    $sql_flights = "SELECT flight_no FROM flights WHERE airline_id = '$airlineId'";
    $result_flights = $conn->query($sql_flights);

    if ($result_flights->num_rows > 0) {
        while ($row_flights = $result_flights->fetch_assoc()) {
            $flightNumber = $row_flights["flight_no"];
            
            // SQL query to delete boarding passes for the flight
            $sql1 = "DELETE FROM boardingpass WHERE flight_no = '$flightNumber'";
            if ($conn->query($sql1) !== TRUE) {
                echo "Error deleting boarding passes: " . $conn->error;
                continue; // Skip to the next flight if an error occurs
            }

            // SQL queries to find departure and arrival IDs
            $sql_id_dep = "SELECT departure_id FROM flights WHERE flight_no = '$flightNumber'";
            $sql_id_arr = "SELECT arrival_id FROM flights WHERE flight_no = '$flightNumber'";
            $result_dep = $conn->query($sql_id_dep);
            $result_arr = $conn->query($sql_id_arr);
            // SQL query to delete the flight
            $sql4 = "DELETE FROM flights WHERE flight_no = '$flightNumber'";
            if ($conn->query($sql4) !== TRUE) {
                echo "Error deleting flight: " . $conn->error;
                continue; // Skip to the next flight if an error occurs
            }

            if ($result_dep->num_rows > 0 && $result_arr->num_rows > 0) {
                $dep_id = $result_dep->fetch_assoc()["departure_id"];
                $arr_id = $result_arr->fetch_assoc()["arrival_id"];

                // SQL queries to delete departure and arrival records
                $sql2 = "DELETE FROM departures WHERE departure_id = '$dep_id'";
                $sql3 = "DELETE FROM arrivals WHERE arrival_id = '$arr_id'";


                if ($conn->query($sql2) !== TRUE || $conn->query($sql3) !== TRUE) {
                    echo "Error deleting departure or arrival records: " . $conn->error;
                    continue; // Skip to the next flight if an error occurs
                }
            } else {
                echo "No matching departure or arrival records found!";
                continue; // Skip to the next flight if no records found
            }

            echo "Flight with number $flightNumber deleted successfully!<br>";
        }
    } else {
        echo "No flights associated with the provided airline ID!";
    }

    // SQL query to delete the airline
    $sql_delete_airline = "DELETE FROM airline WHERE airline_id = '$airlineId'";
    if ($conn->query($sql_delete_airline) !== TRUE) {
        echo "Error deleting airline: " . $conn->error;
    } else {
        echo "Airline with ID $airlineId deleted successfully!";
    }
}

// Close connection
$conn->close();
?>
