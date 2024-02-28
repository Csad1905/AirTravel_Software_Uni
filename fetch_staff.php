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
        // Collect staff ID from the form
        $staffID = isset($_POST["fetchStaffId"]) ? $_POST["fetchStaffId"] : "";

        if (!empty($staffID)) {
            // SQL query to retrieve staff information along with additional details based on the provided ID
            $sql = "SELECT staff.staff_id, person.email, person.phone_number, person.address_line_1, person.postcode, person.city, person.county, payroll.salary, payroll.fullname, job.job, staff.airline_id_employer, staff.airport_code_employer
                    FROM staff
                    INNER JOIN person ON staff.person_id = person.person_id
                    INNER JOIN payroll ON staff.staff_id = payroll.staff_id
                    INNER JOIN job ON staff.job_id = job.job_id
                    WHERE staff.staff_id = '$staffID'";
        } else {
            // SQL query to retrieve all staff along with additional details
            $sql = "SELECT staff.staff_id, person.email, person.phone_number, person.address_line_1, person.postcode, person.city, person.county, payroll.salary, payroll.fullname, job.job, staff.airline_id_employer, staff.airport_code_employer
                    FROM staff
                    INNER JOIN person ON staff.person_id = person.person_id
                    INNER JOIN payroll ON staff.staff_id = payroll.staff_id
                    INNER JOIN job ON staff.job_id = job.job_id";
        }

        $result = $conn->query($sql);

        // Display staff information along with additional details
        if ($result->num_rows > 0) {
            echo "<div style='text-align: center'>";
            echo "<h2>Staff Information:</h2>";
            echo "<table border='1' style='margin-bottom: 20px'>";
            echo "<tr><th>Staff ID</th><th>Name</th><th>Email</th><th>Phone Number</th><th>Address Line</th><th>Postcode</th><th>City</th><th>County</th><th>Salary</th><th>Job</th><th>Airline Employer</th><th>Airport Employer</th></tr>";
            echo "</div>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["staff_id"] . "</td><td>" . $row["fullname"] . "</td><td>" . $row["email"] . "</td><td>" . $row["phone_number"] . "</td><td>" . $row["address_line_1"] . "</td><td>" . $row["postcode"] . "</td><td>" . $row["city"] . "</td><td>" . $row["county"] . "</td><td>" . $row["salary"] . "</td><td>" . $row["job"] . "</td><td>" . $row["airline_id_employer"] . "</td><td>" . $row["airport_code_employer"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            if (!empty($staffID)) {
                echo "No staff found with the provided ID: $staffID";
            } else {
                echo "No staff found.";
            }
        }
    }

    // Close connection
    $conn->close();
?>
