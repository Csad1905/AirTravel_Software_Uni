<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $addressLine = $_POST["addressLine"];
    $postcode = $_POST["postcode"];
    $city = $_POST["city"];
    $county = $_POST["county"];
    $fullName = $firstName . " " . $lastName;
    $flightNumber = $_POST["fNo"];
    $seatNumber = $_POST["seatNo"];

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

    // Insert data into the person table
    $sql = "INSERT INTO person (forename, surname, email, phone_number, address_line_1, postcode, city, county)
    VALUES ('$firstName', '$lastName', '$email', '$phoneNumber', '$addressLine', '$postcode', '$city', '$county')";

    if ($conn->query($sql) === TRUE) {
        echo "Person added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Get the ID of the inserted person
    $personId = $conn->insert_id;

    // Insert data into the passenger table
    $sql_passenger = "INSERT INTO passengers (fullname, person_id)
    VALUES ('$fullName', '$personId')";

    if ($conn->query($sql_passenger) === TRUE) {
        echo "Passenger added successfully!";
    } else {
        echo "Error: " . $sql_passenger . "<br>" . $conn->error;
    }

    $passengerId = $conn->insert_id;

    // Insert data into the boarding pass table
    $sql_boarding_pass = "INSERT INTO boardingpass (passenger_id, passengerName, flight_no, seatNo)
    VALUES ('$passengerId', '$fullName', '$flightNumber', '$seatNumber')";

    if ($conn->query($sql_boarding_pass) === TRUE) {
        echo "Boarding pass added successfully!";
    } else {
        echo "Error: " . $sql_boarding_pass . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
