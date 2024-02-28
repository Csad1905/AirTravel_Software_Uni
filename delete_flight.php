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
    // Collect flight number from the form
    $flightNumber = $_POST["deleteFlightId"];

    // SQL query to delete from the boarding pass table
    $sql1 = "DELETE FROM boardingpass WHERE flight_no = '$flightNumber'";
    
    // Execute the first SQL query to delete the boarding pass records
    if ($conn->query($sql1) === TRUE) {
        // SQL query to delete from the flights table
        $sql_id_dep = "SELECT departure_id FROM flights WHERE flight_no = '$flightNumber'";
        $sql_id_arr = "SELECT arrival_id FROM flights WHERE flight_no = '$flightNumber'";
        $dep_id = mysqli_query($conn, $sql_id_dep);
        $arr_id = mysqli_query($conn, $sql_id_arr);
        $dep_id = mysqli_fetch_assoc($dep_id);
        $arr_id = mysqli_fetch_assoc($arr_id);
        $dep_id = $dep_id['departure_id'];
        $arr_id = $arr_id['arrival_id'];
        $sql4 = "DELETE FROM flights WHERE flight_no = '$flightNumber'";
        
        // Execute the second SQL query to delete the flight
        if ($conn->query($sql4) === TRUE or $conn->query($sql4) === FALSE) {
            // SQL query to get departure and arrival IDs

            if ($dep_id !== '' && $arr_id !== '') {
                $sql2 = "DELETE FROM departures WHERE departure_id = '$dep_id'";
                if ($conn->query($sql2) !== TRUE) {
                    echo "Error deleting from departure table: " . $conn->error;
                }

                $sql3 = "DELETE FROM arrivals WHERE arrival_id = '$arr_id'";
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
