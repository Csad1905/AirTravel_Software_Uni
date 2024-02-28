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
    // Collect staff ID from the form
    $staffId = $_POST["deleteStaffId"];

    // Get person_id associated with the staff
    $sql_get_person_id = "SELECT person_id FROM staff WHERE staff_id = '$staffId'";
    $result_person_id = $conn->query($sql_get_person_id);

    if ($result_person_id->num_rows > 0) {
        $row_person_id = $result_person_id->fetch_assoc();
        $personId = $row_person_id["person_id"];

        // SQL query to delete associated payroll records
        $sql_delete_payroll = "DELETE FROM payroll WHERE staff_id = '$staffId'";
        if ($conn->query($sql_delete_payroll) !== TRUE) {
            echo "Error deleting payroll records: " . $conn->error;
        }

        // SQL query to delete staff
        $sql_delete_staff = "DELETE FROM staff WHERE staff_id = '$staffId'";
        if ($conn->query($sql_delete_staff) !== TRUE) {
            echo "Error deleting staff: " . $conn->error;
        }

        // SQL query to delete associated person
        $sql_delete_person = "DELETE FROM person WHERE person_id = '$personId'";
        if ($conn->query($sql_delete_person) !== TRUE) {
            echo "Error deleting person: " . $conn->error;
        } else {
            echo "Staff with ID $staffId and associated records deleted successfully!";
        }
    } else {
        echo "Person ID not found for staff ID: $staffId";
    }
}

// Close connection
$conn->close();
?>
