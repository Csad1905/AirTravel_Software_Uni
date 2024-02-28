document.addEventListener('DOMContentLoaded', function () {
    const hamburgerMenu = document.getElementById('hamburger-menu');
    const leftNav = document.getElementById('left-nav');
    const leftNavPlus = document.getElementById('left-nav-plus');
    const leftNavItems = document.querySelectorAll('.leftnavitem');
    const leftNavPlusItems = document.querySelectorAll('.leftnavplusitem');
    const flightForm = document.getElementById('flightformcont');
    const aircraftForm = document.getElementById('aircraftformcont');
    const addflightbutton = document.getElementById('addflight');
    const successMessage = document.getElementById('successMessage');
    const aircraftSuccessMessage = document.getElementById('aircraftSuccessMessage');
    const airlineForm = document.getElementById('airlineformcont');
    const addAircraftButton = document.getElementById('addAircraft');
    const airportSuccessMessage = document.getElementById('airportSuccessMessage');
    const addAirport = document.getElementById('addAirport');
    const airportForm = document.getElementById('airportformcont');
    const airlineSuccessMessage = document.getElementById('airlineSuccessMessage');
    const addAirline = document.getElementById('addAirline');
    const passengersSuccessMessage = document.getElementById('passengerSuccessMessage');
    const addPassenger = document.getElementById('addPassenger');
    const passengersForm = document.getElementById('passengerformcont');
    const staffForm = document.getElementById('staffformcont');
    const staffSuccessMessage = document.getElementById('staffSuccessMessage');
    const addStaff = document.getElementById('addStaff');
    const fetchFlightForm = document.getElementById('fetchFlightFormCont');
    const fetchAircraft = document.getElementById('fetchAircraftFormCont');
    const fetchAirport = document.getElementById('fetchAirportFormCont');
    const fetchAirline = document.getElementById('fetchAirlineFormCont');
    const fetchPassenger = document.getElementById('fetchPassengerFormCont');
    const fetchStaff = document.getElementById('fetchStaffFormCont');
    const deleteFlight = document.getElementById('deleteFlightFormCont');
    const deleteFlightSuccessMessage = document.getElementById('deleteFlightSuccessMessage');
    const deleteFlightButton = document.getElementById('deleteFlight');
    const deleteAircraft = document.getElementById('deleteAircraftFormCont');
    const deleteAircraftSuccessMessage = document.getElementById('deleteAircraftSuccessMessage');
    const deleteAircraftButton = document.getElementById('deleteAircraft');
    const deleteAirport = document.getElementById('deleteAirportFormCont');
    const deleteAirportSuccessMessage = document.getElementById('deleteAirportSuccessMessage');
    const deleteAirportButton = document.getElementById('deleteAirport');
    const deleteAirline = document.getElementById('deleteAirlineFormCont');
    const deleteAirlineSuccessMessage = document.getElementById('deleteAirlineSuccessMessage');
    const deleteAirlineButton = document.getElementById('deleteAirline');
    const deletePassenger = document.getElementById('deletePassengerFormCont');
    const deletePassengerSuccessMessage = document.getElementById('deletePassengerSuccessMessage');
    const deletePassengerButton = document.getElementById('deletePassenger');
    const deleteStaff = document.getElementById('deleteStaffFormCont');
    const deleteStaffSuccessMessage = document.getElementById('deleteStaffSuccessMessage');
    const deleteStaffButton = document.getElementById('deleteStaff');

    hamburgerMenu.addEventListener('click', function () {
        leftNav.classList.toggle('left-nav-visible');
        leftNavPlus.classList.remove('left-nav-plus-visible');
    });

    let addClicked = false;
    let fetchClicked = false;
    let removeClicked = false;

    leftNavItems.forEach(function (item) {
        item.addEventListener('click', function () {
            if (item.id === 'add') {
                addClicked = true;
                fetchClicked = false;
                removeClicked = false;
            } else if (item.id === 'fetch') {
                fetchClicked = true;
                addClicked = false;
                removeClicked = false;
            } else if (item.id === 'remove') {
                removeClicked = true;
                addClicked = false;
                fetchClicked = false;
            }
            leftNavPlus.classList.toggle('left-nav-plus-visible');
        });
    });

    leftNavPlusItems.forEach(function (item) {
        item.addEventListener('click', function () {
            leftNavPlus.classList.remove('left-nav-plus-visible');
            leftNav.classList.remove('left-nav-visible');

            flightForm.classList.remove('flightformcont-visible');
            flightForm.classList.add('flightformcont-invisible');
            aircraftForm.classList.remove('aircraftformcont-visible');
            aircraftForm.classList.add('aircraftformcont-invisible');
            airportForm.classList.remove('airportformcont-visible');
            airportForm.classList.add('airportformcont-invisible');
            airlineForm.classList.remove('airlineformcont-visible');
            airlineForm.classList.add('airlineformcont-invisible');
            passengersForm.classList.remove('passengerformcont-visible');
            passengersForm.classList.add('passengerformcont-invisible');
            staffForm.classList.remove('staffformcont-visible');
            staffForm.classList.add('staffformcont-invisible');
            fetchFlightForm.classList.remove('fetch-form-cont-visible');
            fetchFlightForm.classList.add('fetch-form-cont-invisible');
            fetchAircraft.classList.remove('fetch-form-cont-visible');
            fetchAircraft.classList.add('fetch-form-cont-invisible');
            fetchAirport.classList.remove('fetch-form-cont-visible');
            fetchAirport.classList.add('fetch-form-cont-invisible');
            fetchAirline.classList.remove('fetch-form-cont-visible');
            fetchAirline.classList.add('fetch-form-cont-invisible');
            fetchPassenger.classList.remove('fetch-form-cont-visible');
            fetchPassenger.classList.add('fetch-form-cont-invisible');
            fetchStaff.classList.remove('fetch-form-cont-visible');
            fetchStaff.classList.add('fetch-form-cont-invisible');
            deleteFlight.classList.remove('delete-form-cont-visible');
            deleteFlight.classList.add('delete-form-cont-invisible');
            deleteAircraft.classList.remove('delete-form-cont-visible');
            deleteAircraft.classList.add('delete-form-cont-invisible');
            deleteAirport.classList.remove('delete-form-cont-visible');
            deleteAirport.classList.add('delete-form-cont-invisible');
            deleteAirline.classList.remove('delete-form-cont-visible');
            deleteAirline.classList.add('delete-form-cont-invisible');
            deletePassenger.classList.remove('delete-form-cont-visible');
            deletePassenger.classList.add('delete-form-cont-invisible');
            deleteStaff.classList.remove('delete-form-cont-visible');
            deleteStaff.classList.add('delete-form-cont-invisible');

            
            if (item.id === 'flight' && addClicked) {
                flightForm.classList.add('flightformcont-visible');
                flightForm.classList.remove('flightformcont-invisible');
            } else if (item.id === 'aircraft' && addClicked) {
                aircraftForm.classList.add('aircraftformcont-visible');
                aircraftForm.classList.remove('aircraftformcont-invisible');
            } else if (item.id === 'airport' && addClicked) {
                airportForm.classList.remove('airportformcont-invisible');
                airportForm.classList.add('airportformcont-visible');
            } else if (item.id === 'airline' && addClicked) {
                airlineForm.classList.remove('airlineformcont-invisible');
                airlineForm.classList.add('airlineformcont-visible');
            } else if (item.id === 'passenger' && addClicked) {
                passengersForm.classList.remove('passengerformcont-invisible');
                passengersForm.classList.add('passengerformcont-visible');
            } else if (item.id === 'staff' && addClicked) {
                staffForm.classList.remove('staffformcont-invisible');
                staffForm.classList.add('staffformcont-visible');
            } else if (item.id === 'flight' && fetchClicked) {
                fetchFlightForm.classList.remove('fetch-form-cont-invisible');
                fetchFlightForm.classList.add('fetch-form-cont-visible');
            } else if (item.id === 'aircraft' && fetchClicked) {
                fetchAircraft.classList.remove('fetch-form-cont-invisible');
                fetchAircraft.classList.add('fetch-form-cont-visible');
            } else if (item.id === 'airport' && fetchClicked) {
                fetchAirport.classList.remove('fetch-form-cont-invisible');
                fetchAirport.classList.add('fetch-form-cont-visible');
            } else if (item.id === 'airline' && fetchClicked) {
                fetchAirline.classList.remove('fetch-form-cont-invisible');
                fetchAirline.classList.add('fetch-form-cont-visible');
            } else if (item.id === 'passenger' && fetchClicked) {
                fetchPassenger.classList.remove('fetch-form-cont-invisible');
                fetchPassenger.classList.add('fetch-form-cont-visible');
            } else if (item.id === 'staff' && fetchClicked) {
                fetchStaff.classList.remove('fetch-form-cont-invisible');
                fetchStaff.classList.add('fetch-form-cont-visible');
            } else if (item.id === 'flight' && removeClicked) {
                deleteFlight.classList.remove('delete-form-cont-invisible');
                deleteFlight.classList.add('delete-form-cont-visible');
            } else if (item.id === 'aircraft' && removeClicked) {
                deleteAircraft.classList.remove('delete-form-cont-invisible');
                deleteAircraft.classList.add('delete-form-cont-visible');
            } else if (item.id === 'airport' && removeClicked) { 
                deleteAirport.classList.remove('delete-form-cont-invisible');
                deleteAirport.classList.add('delete-form-cont-visible');
            } else if (item.id === 'airline' && removeClicked) {
                deleteAirline.classList.remove('delete-form-cont-invisible');
                deleteAirline.classList.add('delete-form-cont-visible');
            } else if (item.id === 'passenger' && removeClicked) {
                deletePassenger.classList.remove('delete-form-cont-invisible');
                deletePassenger.classList.add('delete-form-cont-visible');
            } else if (item.id === 'staff' && removeClicked) {
                deleteStaff.classList.remove('delete-form-cont-invisible');
                deleteStaff.classList.add('delete-form-cont-visible');
            } else {
                flightForm.classList.remove('flightformcont-visible');
                flightForm.classList.add('flightformcont-invisible');
                aircraftForm.classList.remove('aircraftformcont-visible');
                aircraftForm.classList.add('aircraftformcont-invisible');
            }
        });
    });
    deleteFlightButton.addEventListener('click', function () {
        deleteFlightSuccessMessage.style.display = 'block';
    });

    deleteAircraftButton.addEventListener('click', function () {
        deleteAircraftSuccessMessage.style.display = 'block';
    });

    deleteAirportButton.addEventListener('click', function () {
        deleteAirportSuccessMessage.style.display = 'block';
    });

    deleteAirlineButton.addEventListener('click', function () {
        deleteAirlineSuccessMessage.style.display = 'block';
    });

    deletePassengerButton.addEventListener('click', function () {
        deletePassengerSuccessMessage.style.display = 'block';
    });

    deleteStaffButton.addEventListener('click', function () {
        deleteStaffSuccessMessage.style.display = 'block';
    });

    addStaff.addEventListener('click', function () {
        staffSuccessMessage.style.display = 'block';
    });

    addPassenger.addEventListener('click', function () {
        passengersSuccessMessage.style.display = 'block';
    });

    addAirline.addEventListener('click', function () {
        airlineSuccessMessage.style.display = 'block';
    });

    addAirport.addEventListener('click', function () {
        airportSuccessMessage.style.display = 'block';
    });

    addAircraftButton.addEventListener('click', function () {
        aircraftSuccessMessage.style.display = 'block';
    });

    addflightbutton.addEventListener('click', function () {
        successMessage.style.display = 'block';
    });
});
