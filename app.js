document.addEventListener('DOMContentLoaded', function () {
    const hamburgerMenu = document.getElementById('hamburger-menu');
    const leftNav = document.getElementById('left-nav');
    const leftNavPlus = document.getElementById('left-nav-plus');
    const leftNavItems = document.querySelectorAll('.leftnavitem');
    const leftNavPlusItems = document.querySelectorAll('.leftnavplusitem');
    const flightForm = document.getElementById('flightformcont');
    const addflightbutton = document.getElementById('addflight');
    const successMessage = document.getElementById('successMessage');
    const airlineForm = document.getElementById('airlineformcont');

    hamburgerMenu.addEventListener('click', function () {
        leftNav.classList.toggle('left-nav-visible');
        leftNavPlus.classList.remove('left-nav-plus-visible');
    });

    leftNavItems.forEach(function (item) {
        item.addEventListener('click', function () {
            leftNavPlus.classList.toggle('left-nav-plus-visible');
        });
    });

    leftNavPlusItems.forEach(function (item) {
        item.addEventListener('click', function () {
            leftNavPlus.classList.remove('left-nav-plus-visible');
            leftNav.classList.remove('left-nav-visible');
            if (item.id === 'flight') {
                flightForm.classList.add('flightformcont-visible');
                flightForm.classList.remove('flightformcont-invisible');
            } else if (item.id === 'airport') {
                airlineForm.classList.remove('airlineformcont-invisible');
                airlineForm.classList.add('airlineformcont-visible');
            } else {
                flightForm.classList.remove('flightformcont-visible');
                flightForm.classList.add('flightformcont-invisible');
            }
        });
    });
    
    addflightbutton.addEventListener('click', function () {
        successMessage.style.display = 'block';
    });
    
    
});


