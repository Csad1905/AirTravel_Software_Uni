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
    $employerIDAirline = $_POST["employerIDAirline"];
    $employerIDAirport = $_POST["employerIDAirport"];
    $jobid = $_POST["employeePosID"];
    $salary = $_POST["employeeSalary"];

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

    // First, insert data into the person table
    $sql = "INSERT INTO person (forename, surname, email, phone_number, address_line_1, postcode, city, county)
    VALUES ('$firstName', '$lastName', '$email', '$phoneNumber', '$addressLine', '$postcode', '$city', '$county')";

    if ($conn->query($sql) === TRUE) {
        // Fetch the person ID after the person is added
        $personId = $conn->insert_id;

        // Next, insert data into the staff table based on the employer ID values
        if ($employerIDAirline === '' && $employerIDAirport !== '') {
            $sql = "INSERT INTO staff (person_id, job_id, airline_id_employer, airport_code_employer)
            VALUES ('$personId', '$jobid', null, '$employerIDAirport')";

        } elseif ($employerIDAirline !== '' && $employerIDAirport === '') {
            $sql = "INSERT INTO staff (person_id, job_id, airline_id_employer, airport_code_employer)
            VALUES ('$personId', '$jobid', '$employerIDAirline', null)";
        }

        if ($conn->query($sql) === TRUE) {
            // Insert data into the payroll table
            $staffId = $conn->insert_id;
            $fullName = $firstName . " " . $lastName;
            $sql = "INSERT INTO payroll (staff_id, fullname, salary)
            VALUES ('$staffId', '$fullName', '$salary')";

            if ($conn->query($sql) === TRUE) {
                echo "Staff added successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
