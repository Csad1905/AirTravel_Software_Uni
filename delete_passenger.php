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
    // Collect passenger ID from the form
    $passengerId = $_POST["deletePassengerId"];

    // Get person_id associated with the passenger
    $sql_get_person_id = "SELECT person_id FROM passengers WHERE passenger_id = '$passengerId'";
    $result_person_id = $conn->query($sql_get_person_id);

    if ($result_person_id->num_rows > 0) {
        $row_person_id = $result_person_id->fetch_assoc();
        $personId = $row_person_id["person_id"];

        // SQL query to delete associated boarding pass
        $sql_delete_boardingpass = "DELETE FROM boardingpass WHERE passenger_id = '$passengerId'";
        if ($conn->query($sql_delete_boardingpass) !== TRUE) {
            echo "Error deleting boarding pass: " . $conn->error;
        }

        // SQL query to delete passenger
        $sql_delete_passenger = "DELETE FROM passengers WHERE passenger_id = '$passengerId'";
        if ($conn->query($sql_delete_passenger) !== TRUE) {
            echo "Error deleting passenger: " . $conn->error;
        }

        // SQL query to delete associated person
        $sql_delete_person = "DELETE FROM person WHERE person_id = '$personId'";
        if ($conn->query($sql_delete_person) !== TRUE) {
            echo "Error deleting person: " . $conn->error;
        } else {
            echo "Passenger with ID $passengerId and associated records deleted successfully!";
        }
    } else {
        echo "Person ID not found for passenger ID: $passengerId";
    }
}

// Close connection
$conn->close();
?>
