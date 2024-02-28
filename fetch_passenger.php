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
        // Collect passenger ID from the form
        $passengerID = isset($_POST["fetchPassengerId"]) ? $_POST["fetchPassengerId"] : "";

        if (!empty($passengerID)) {
            // SQL query to retrieve passenger information, boarding pass details, and personal details based on the provided ID
            $sql = "SELECT passengers.passenger_id, passengers.fullname, boardingpass.pass_id, boardingpass.flight_no, boardingpass.seatNo, person.email, person.phone_number, person.address_line_1, person.postcode, person.city, person.county
                    FROM passengers
                    INNER JOIN boardingpass ON passengers.passenger_id = boardingpass.passenger_id
                    INNER JOIN person ON passengers.person_id = person.person_id
                    WHERE passengers.passenger_id = '$passengerID'";
        } else {
            // SQL query to retrieve all passengers, boarding pass details, and personal details
            $sql = "SELECT passengers.passenger_id, passengers.fullname, boardingpass.pass_id, boardingpass.flight_no, boardingpass.seatNo, person.email, person.phone_number, person.address_line_1, person.postcode, person.city, person.county
                    FROM passengers
                    INNER JOIN boardingpass ON passengers.passenger_id = boardingpass.passenger_id
                    INNER JOIN person ON passengers.person_id = person.person_id";
        }

        $result = $conn->query($sql);

        // Display passenger information, boarding pass details, and personal details
        if ($result->num_rows > 0) {
            echo "<div style='text-align: center'>";
            echo "<h2>Passenger Information:</h2>";
            echo "<table border='1' style='margin-bottom: 20px'>";
            echo "<tr><th>Passenger ID</th><th>Passenger Name</th><th>Boarding Pass ID</th><th>Flight Number</th><th>Seat Number</th><th>Email</th><th>Phone Number</th><th>Address Line</th><th>Postcode</th><th>City</th><th>County</th></tr>";
            echo "</div>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["passenger_id"] . "</td><td>" . $row["fullname"] . "</td><td>" . $row["pass_id"] . "</td><td>" . $row["flight_no"] . "</td><td>" . $row["seatNo"] . "</td><td>" . $row["email"] . "</td><td>" . $row["phone_number"] . "</td><td>" . $row["address_line_1"] . "</td><td>" . $row["postcode"] . "</td><td>" . $row["city"] . "</td><td>" . $row["county"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            if (!empty($passengerID)) {
                echo "No passenger found with the provided ID: $passengerID";
            } else {
                echo "No passengers found.";
            }
        }
    }

    // Close connection
    $conn->close();
?>
