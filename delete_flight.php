<?php
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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect flight number from the form
    $flightNumber = $_POST["deleteFlightId"];

    // SQL query to delete from the boarding pass table
    $sql1 = "DELETE FROM boardingpass WHERE flight_no = '$flightNumber'";
    
    // Execute the first SQL query to delete the boarding pass records
    if ($conn->query($sql1) === TRUE) {
        // SQL query to delete from the flights table
        $sql4 = "DELETE FROM flights WHERE flight_no = '$flightNumber'";
        
        // Execute the second SQL query to delete the flight
        if ($conn->query($sql4) === TRUE or $conn->query($sql4) === FALSE) {
            // SQL query to get departure and arrival IDs
            $sql_id_dep = "SELECT departure_id FROM flights WHERE flight_no = '$flightNumber'";
            $sql_id_arr = "SELECT arrival_id FROM flights WHERE flight_no = '$flightNumber'";

            if ($sql_id_dep !== '' && $sql_id_arr !== '') {
                // Delete from departure table
                $departure_id = $sql_id_dep;
                $sql2 = "DELETE FROM departures WHERE departure_id = '$departure_id'";
                if ($conn->query($sql2) !== TRUE) {
                    echo "Error deleting from departure table: " . $conn->error;
                }

                // Delete from arrival table
                $arrival_id = $sql_id_arr;
                $sql3 = "DELETE FROM arrivals WHERE arrival_id = '$arrival_id'";
                if ($conn->query($sql3) !== TRUE) {
                    echo "Error deleting from arrival table: " . $conn->error;
                }
            } else {
                echo "No matching flight found!";
            }

            echo "Flight with number $flightNumber deleted successfully!";
        } else {
            echo "Error deleting flight: " . $sql4 . "<br>" . $conn->error;
        }
    } else {
        echo "Error deleting boarding passes: " . $sql1 . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
