<?php
session_start();

if(!$_SESSION['user_data']) {
    header("Location: http://csadler.uosweb.co.uk/index.php?notAuthorised=1");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airport Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <nav class="navbar">
        <div class="navbar-left">
            <div class="hamburger-menu" id="hamburger-menu">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </div>
        <div class="navbar-right">
            <button id="logout">Logout</button>
            <h1>Airport Management System</h1>
            <script>
                document.getElementById("logout").addEventListener("click", function() {
                    window.location.href = "logout.php"; // Redirect to logout.php
                });
            </script>
    </nav>
    <div class="left-nav" id="left-nav">
        <ul>
            <li><a class="leftnavitem" id="add" href="#">Add</a></li>
            <li><a class="leftnavitem" id="remove" href="#">Remove</a></li>
            <li><a class="leftnavitem" id="fetch" href="#">Fetch</a></li>
        </ul>
    </div>
    <div class="left-nav-plus" id="left-nav-plus">
        <ul>
            <li><a class="leftnavplusitem" id="flight" href="#">Flight</a></li>
            <li><a class="leftnavplusitem" id="aircraft" href="#">Aircraft</a></li>
            <li><a class="leftnavplusitem" id="airport" href="#">Airport</a></li>
            <li><a class="leftnavplusitem" id="airline" href="#">Airline</a></li>
            <li><a class="leftnavplusitem" id="passenger" href="#">Passenger</a></li>
            <li><a class="leftnavplusitem" id="staff" href="#">Staff</a></li>
        </ul>
    </div>

    <div class="flightformcont-invisible" id="flightformcont">
        <form id="flightForm" action="insert_flight.php" method="post">
            <label for="flightNumber">Flight Number:</label>
            <input type="text" id="flightNumber" name="flightNumber" required>

            <label for="aircraftId">Aircraft ID:</label>
            <input type="text" id="aircraftId" name="aircraftId" required>

            <label for="airlineId">Airline ID:</label>
            <input type="text" id="airlineId" name="airlineId" required>

            <label for="departAp">Departure Airport Code:</label>
            <input type="text" id="departAp" name="departAp" required>

            <label for="departGate">Departure Gate:</label>
            <input type="text" id="departGate" name="departGate" required>

            <label for="departTime">Departure Time:</label>
            <input type="datetime-local" id="departTime" name="departTime" required>

            <label for="arrivAp">Arrival Airport Code:</label>
            <input type="text" id="arrivAp" name="arrivAp" required>

            <label for="arrivGate">Arrival Gate:</label>
            <input type="text" id="arrivGate" name="arrivGate" required>

            <label for="arrivTime">Arrival Time:</label>
            <input type="datetime-local" id="arrivTime" name="arrivTime" required>
            <button type="submit" class="button" id="addflight">Add Flight</button>
        </form>
        <div id="successMessage" style="display: none;">Flight added<br> successfully!</div>
    </div>
    
    <div class="aircraftformcont-invisible" id="aircraftformcont">
        <form id="aircraftForm" action="insert_aircraft.php" method="post">
            <label for="aircraftType">Aircraft Type:</label>
            <input type="text" id="aircraftType" name="aircraftType" required>
    
            <label for="aircraftManufacturer">Aircraft Manufacturer:</label>
            <input type="text" id="aircraftManufacturer" name="aircraftManufacturer" required>
    
            <label for="aircraftCapacity">Aircraft Capacity:</label>
            <input type="number" id="aircraftCapacity" name="aircraftCapacity" required>
    
            <button type="submit" class="button" id="addAircraft">Add Aircraft</button>
        </form>
        <div id="aircraftSuccessMessage" style="display: none;">Aircraft added<br> successfully!</div>
    </div>
    
    <div class="airportformcont-invisible" id="airportformcont">
        <form id="airportForm" action="insert_airport.php" method="post">
            <label for="airportCode">Airport Code:</label>
            <input type="text" id="airportCode" name="airportCode" required>
    
            <label for="airportName">Airport Name:</label>
            <input type="text" id="airportName" name="airportName" required>
    
            <label for="airportLocation">Airport Location:</label>
            <input type="text" id="airportLocation" name="airportLocation" required>
    
            <label for="airportCapacity">Airport Capacity:</label>
            <input type="number" id="airportCapacity" name="airportCapacity" required>
    
            <label for="runwayLength">Runway Length:</label>
            <input type="number" id="runwayLength" name="runwayLength" required>
    
            <button type="submit" class="button" id="addAirport">Add Airport</button>
        </form>
        <div id="airportSuccessMessage" style="display: none;">Airport added<br> successfully!</div>
    </div>

    <div class="airlineformcont-invisible" id="airlineformcont">
        <form id="airlineForm" action="insert_airline.php" method="post">
            <label for="airlineName">Airline Name:</label>
            <input type="text" id="airlineName" name="airlineName" required>
    
            <button type="submit" class="button" id="addAirline">Add Airline</button>
        </form>
        <div id="airlineSuccessMessage" style="display: none;">Airline added<br> successfully!</div>
    </div>
    
    <div class="passengerformcont-invisible" id="passengerformcont">
        <form id="passengerForm" action="insert_passenger.php" method="post">
    
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required>
    
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
    
            <label for="phoneNumber">Phone Number:</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" required>
    
            <label for="addressLine">Address Line:</label>
            <input type="text" id="addressLine" name="addressLine" required>
    
            <label for="postcode">Postcode:</label>
            <input type="text" id="postcode" name="postcode" required>
    
            <label for="city">City:</label>
            <input type="text" id="city" name="city" required>
    
            <label for="county">County:</label>
            <input type="text" id="county" name="county" required>

            <label for="fNo">Flight no:</label>
            <input type="text" id="fNo" name="fNo" required>

            <label for="seatNo">Seat no:</label>
            <input type="text" id="seatNo" name="seatNo" required>
    
            <button type="submit" class="button" id="addPassenger">Add Passenger</button>
        </form>
        <div id="passengerSuccessMessage" style="display: none;">Passenger added<br> successfully!</div>
    </div>
    
    <div class="staffformcont-invisible" id="staffformcont">
        <form id="staffForm" action="insert_staff.php" method="post">
    
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="lastName">last Name:</label>
            <input type="text" id="lastName" name="lastName" required>
    
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
    
            <label for="phoneNumber">Phone Number:</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" required>
    
            <label for="addressLine">Address Line:</label>
            <input type="text" id="addressLine" name="addressLine" required>
    
            <label for="postcode">Postcode:</label>
            <input type="text" id="postcode" name="postcode" required>
    
            <label for="city">City:</label>
            <input type="text" id="city" name="city" required>
    
            <label for="county">County:</label>
            <input type="text" id="county" name="county" required>
    
            <label for="employerIDAirline">Employer ID Airline:</label>
            <input type="text" id="employerIDAirline" name="employerIDAirline">

            <label for="employerIDAirport">Employer Airport Code:</label>
            <input type="text" id="employerIDAirport" name="employerIDAirport">

            <label for="employeePosID">Employee Position ID:</label>
            <input type="text" id="employeePosID" name="employeePosID" required>

            <label for="employeeSalary">Employee Salary:</label>
            <input type="text" id="employeeSalary" name="employeeSalary" required>
    
            <button type="submit" class="button" id="addStaff">Add Staff</button>
        </form>
        <div id="staffSuccessMessage" style="display: none;">Staff added<br> successfully!</div>
    </div>

    <div class="fetch-form-cont-invisible" id="fetchFlightFormCont">
        <form id="fetchFlightForm" action="fetch_flight.php" method="post">
            <label for="fetchFlightId">Flight Number:</label>
            <input type="text" id="fetchFlightId" name="fetchFlightId" placeholder="leave blank for all records">
            <button type="submit" class="button" id="fetchFlight" style="margin-bottom: 20px;">Fetch Flight</button>
        </form>
    <div id="flightInfo">
        <script>
            document.getElementById('fetchFlightForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
                document.getElementById('staffInfo').innerHTML = '';
                document.getElementById('passengerInfo').innerHTML = '';
                document.getElementById('airlineInfo').innerHTML = '';
                document.getElementById('aircraftInfo').innerHTML = '';
                document.getElementById('airportInfo').innerHTML = '';
                document.getElementById('staffInfo').style = '';
                document.getElementById('passengerInfo').style = '';
                document.getElementById('airlineInfo').style = '';
                document.getElementById('aircraftInfo').style = '';
                document.getElementById('airportInfo').style = '';
                
                var formData = new FormData(this);
    
                // Send form data to PHP script using AJAX
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        if (xhr.status == 200) {
                            document.getElementById('flightInfo').innerHTML = xhr.responseText; // Display result
                            document.getElementById('flightInfo').style = 'display: flex; justify-content: center; background-color: #f6f4f4; border-radius: 5px;';
                        } else {
                            console.error('Error:', xhr.status);
                        }
                    }
                };
                xhr.open('POST', 'fetch_flight.php', true);
                xhr.send(formData);
            });
        </script>
    </div>
    </div>
    
    <div class="fetch-form-cont-invisible" id="fetchAircraftFormCont">
        <form id="fetchAircraftForm" action="fetch_aircraft.php" method="post">
            <label for="fetchAircraftId">Aircraft ID:</label>
            <input type="text" id="fetchAircraftId" name="fetchAircraftId" placeholder="leave blank for all records">
            <button type="submit" class="button" id="fetchAircraft" style="margin-bottom: 20px;">Fetch Aircraft</button>
        </form>
    <div id="aircraftInfo">
        <script>
            document.getElementById('fetchAircraftForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
                document.getElementById('staffInfo').innerHTML = '';
                document.getElementById('passengerInfo').innerHTML = '';
                document.getElementById('airlineInfo').innerHTML = '';
                document.getElementById('flightInfo').innerHTML = '';
                document.getElementById('airportInfo').innerHTML = '';
                document.getElementById('staffInfo').style = '';
                document.getElementById('passengerInfo').style = '';
                document.getElementById('airlineInfo').style = '';
                document.getElementById('flightInfo').style = '';
                document.getElementById('airportInfo').style = '';
                var formData = new FormData(this);
    
                // Send form data to PHP script using AJAX
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        if (xhr.status == 200) {
                            document.getElementById('aircraftInfo').innerHTML = xhr.responseText; // Display result
                            document.getElementById('aircraftInfo').style = 'display: flex; justify-content: center; background-color: #f6f4f4; border-radius: 5px;';
                        } else {
                            console.error('Error:', xhr.status);
                        }
                    }
                };
                xhr.open('POST', 'fetch_aircraft.php', true);
                xhr.send(formData);
            });
        </script>
    </div>
    </div>
    
    <div class="fetch-form-cont-invisible" id="fetchAirportFormCont">
        <form id="fetchAirportForm" action="fetch_airport.php" method="post">
            <label for="fetchAirportId">Airport Code:</label>
            <input type="text" id="fetchAirportId" name="fetchAirportId" placeholder="leave blank for all records">
            <button type="submit" class="button" id="fetchAirport" style="margin-bottom: 20px;">Fetch Airport</button>
        </form>
    <div id="airportInfo">
        <script>
            document.getElementById('fetchAirportForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
                document.getElementById('staffInfo').innerHTML = '';
                document.getElementById('passengerInfo').innerHTML = '';
                document.getElementById('airlineInfo').innerHTML = '';
                document.getElementById('aircraftInfo').innerHTML = '';
                document.getElementById('flightInfo').innerHTML = '';
                document.getElementById('staffInfo').style = '';
                document.getElementById('passengerInfo').style = '';
                document.getElementById('airlineInfo').style = '';
                document.getElementById('aircraftInfo').style = '';
                document.getElementById('flightInfo').style = '';
                var formData = new FormData(this);
    
                // Send form data to PHP script using AJAX
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        if (xhr.status == 200) {
                            document.getElementById('airportInfo').innerHTML = xhr.responseText; // Display result
                            document.getElementById('airportInfo').style = 'display: flex; justify-content: center; background-color: #f6f4f4; border-radius: 5px;';
                        } else {
                            console.error('Error:', xhr.status);
                        }
                    }
                };
                xhr.open('POST', 'fetch_airport.php', true);
                xhr.send(formData);
            });
        </script>
    </div>
    </div>
    
    <div class="fetch-form-cont-invisible" id="fetchAirlineFormCont">
        <form id="fetchAirlineForm" action="fetch_airline.php" method="post">
            <label for="fetchAirlineId">Airline Name:</label>
            <input type="text" id="fetchAirlineId" name="fetchAirlineId" placeholder="leave blank for all records">
            <button type="submit" class="button" id="fetchAirline" style="margin-bottom: 20px;">Fetch Airline</button>
        </form>
    <div id="airlineInfo">
        <script>
            document.getElementById('fetchAirlineForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
                document.getElementById('staffInfo').innerHTML = '';
                document.getElementById('passengerInfo').innerHTML = '';
                document.getElementById('flightInfo').innerHTML = '';
                document.getElementById('aircraftInfo').innerHTML = '';
                document.getElementById('airportInfo').innerHTML = '';
                document.getElementById('staffInfo').style = '';
                document.getElementById('passengerInfo').style = '';
                document.getElementById('flightInfo').style = '';
                document.getElementById('aircraftInfo').style = '';
                document.getElementById('airportInfo').style = '';
                var formData = new FormData(this);
    
                // Send form data to PHP script using AJAX
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        if (xhr.status == 200) {
                            document.getElementById('airlineInfo').innerHTML = xhr.responseText; // Display result
                            document.getElementById('airlineInfo').style = 'display: flex; justify-content: center; background-color: #f6f4f4; border-radius: 5px;';
                        } else {
                            console.error('Error:', xhr.status);
                        }
                    }
                };
                xhr.open('POST', 'fetch_airline.php', true);
                xhr.send(formData);
            });
        </script>
    </div>
    </div>
    
    <div class="fetch-form-cont-invisible" id="fetchPassengerFormCont">
        <form id="fetchPassengerForm" action="fetch_passenger.php" method="post">
            <label for="fetchPassengerId">Passenger ID:</label>
            <input type="text" id="fetchPassengerId" name="fetchPassengerId" placeholder="leave blank for all records">
            <button type="submit" class="button" id="fetchPassenger" style="margin-bottom: 20px;">Fetch Passenger</button>
        </form>
    <div id="passengerInfo">
        <script>
            document.getElementById('fetchPassengerForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
                document.getElementById('staffInfo').innerHTML = '';
                document.getElementById('flightInfo').innerHTML = '';
                document.getElementById('airlineInfo').innerHTML = '';
                document.getElementById('aircraftInfo').innerHTML = '';
                document.getElementById('airportInfo').innerHTML = '';
                document.getElementById('staffInfo').style = '';
                document.getElementById('flightInfo').style = '';
                document.getElementById('airlineInfo').style = '';
                document.getElementById('aircraftInfo').style = '';
                document.getElementById('airportInfo').style = '';
                var formData = new FormData(this);
    
                // Send form data to PHP script using AJAX
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        if (xhr.status == 200) {
                            document.getElementById('passengerInfo').innerHTML = xhr.responseText; // Display result
                            document.getElementById('passengerInfo').style = 'display: flex; justify-content: center; background-color: #f6f4f4; border-radius: 5px;';
                        } else {
                            console.error('Error:', xhr.status);
                        }
                    }
                };
                xhr.open('POST', 'fetch_passenger.php', true);
                xhr.send(formData);
            });
        </script>
    </div>
    </div>
    
    <div class="fetch-form-cont-invisible" id="fetchStaffFormCont">
        <form id="fetchStaffForm" action="fetch_staff.php" method="post">
            <label for="fetchStaffId">Staff ID:</label>
            <input type="text" id="fetchStaffId" name="fetchStaffId" placeholder="leave blank for all records">
            <button type="submit" class="button" id="fetchStaff" style="margin-bottom: 20px;">Fetch Staff</button>
        </form>
    <div id="staffInfo">
        <script>
            document.getElementById('fetchStaffForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
                document.getElementById('flightInfo').innerHTML = '';
                document.getElementById('passengerInfo').innerHTML = '';
                document.getElementById('airlineInfo').innerHTML = '';
                document.getElementById('aircraftInfo').innerHTML = '';
                document.getElementById('airportInfo').innerHTML = '';
                document.getElementById('flightInfo').style = '';
                document.getElementById('passengerInfo').style = '';
                document.getElementById('airlineInfo').style = '';
                document.getElementById('aircraftInfo').style = '';
                document.getElementById('airportInfo').style = '';
                var formData = new FormData(this);
    
                // Send form data to PHP script using AJAX
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        if (xhr.status == 200) {
                            document.getElementById('staffInfo').innerHTML = xhr.responseText;
                            document.getElementById('staffInfo').style = 'display: flex; justify-content: center; background-color: #f6f4f4; border-radius: 5px;';
                            console.error('Error:', xhr.status);
                        }
                    }
                };
                xhr.open('POST', 'fetch_staff.php', true);
                xhr.send(formData);
            });
        </script>
    </div>
    </div>

    <div class="delete-form-cont-invisible" id="deleteFlightFormCont">
        <form id="deleteFlightForm"  action="delete_flight.php" method="post">
            <label for="deleteFlightId">Flight Number:</label>
            <input type="text" id="deleteFlightId" name="deleteFlightId" required>
            <button type="submit" class="button" id="deleteFlight">Delete Flight</button>
        </form>
        <div id="deleteFlightSuccessMessage" style="display: none;">Flight deleted<br> successfully!</div>
    </div>
    
    <div class="delete-form-cont-invisible" id="deleteAircraftFormCont">
        <form id="deleteAircraftForm" action="delete_aircraft.php" method="post">
            <label for="deleteAircraftId">Aircraft ID:</label>
            <input type="text" id="deleteAircraftId" name="deleteAircraftId" required>
            <button type="submit" class="button" id="deleteAircraft">Delete Aircraft</button>
        </form>
        <div id="deleteAircraftSuccessMessage" style="display: none;">Aircraft deleted<br> successfully!</div>
    </div>
    
    <div class="delete-form-cont-invisible" id="deleteAirportFormCont">
        <form id="deleteAirportForm" action="delete_airport.php" method="post">
            <label for="deleteAirportId">Airport Code:</label>
            <input type="text" id="deleteAirportId" name="deleteAirportId" required>
            <button type="submit" class="button" id="deleteAirport">Delete Airport</button>
        </form>
        <div id="deleteAirportSuccessMessage" style="display: none;">Airport deleted<br> successfully!</div>
    </div>
    
    <div class="delete-form-cont-invisible" id="deleteAirlineFormCont">
        <form id="deleteAirlineForm" action="delete_airline.php" method="post">
            <label for="deleteAirlineId">Airline ID:</label>
            <input type="text" id="deleteAirlineId" name="deleteAirlineId" required>
            <button type="submit" class="button" id="deleteAirline">Delete Airline</button>
        </form>
        <div id="deleteAirlineSuccessMessage" style="display: none;">Airline deleted<br> successfully!</div>
    </div>
    
    <div class="delete-form-cont-invisible" id="deletePassengerFormCont">
        <form id="deletePassengerForm" action="delete_passenger.php" method="post">
            <label for="deletePassengerId">Passenger ID:</label>
            <input type="text" id="deletePassengerId" name="deletePassengerId" required>
            <button type="submit" class="button" id="deletePassenger">Delete Passenger</button>
        </form>
        <div id="deletePassengerSuccessMessage" style="display: none;">Passenger deleted<br> successfully!</div>
    </div>
    
    <div class="delete-form-cont-invisible" id="deleteStaffFormCont">
        <form id="deleteStaffForm" action="delete_staff.php" method="post">
            <label for="deleteStaffId">Staff ID:</label>
            <input type="text" id="deleteStaffId" name="deleteStaffId" required>
            <button type="submit" class="button" id="deleteStaff">Delete Staff</button>
        </form>
        <div id="deleteStaffSuccessMessage" style="display: none;">Staff deleted<br> successfully!</div>
    </div>
    
    
    
    <script src="app.js"></script>
</body>

</html>

