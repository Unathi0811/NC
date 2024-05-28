//welcome page js

//styling the login button and register button  
document.getElementById("Login").addEventListener("click", function () {
    window.location.href = "login.html";
});

document.getElementById("Register").addEventListener("click", function () {
    window.location.href = "Register.html";
});


// 
// show menu | start
// 
function humburger_menu_clicked() {
    let humburgerMenuBtn = document.getElementById("humburger_menu");
    let smallScreenMenu = document.getElementById("small_screen_menu");

    humburgerMenuBtn.addEventListener("click", function () {
        console.log(
            smallScreenMenu.style.display
        )
        if (smallScreenMenu.style.display === "none") {
            smallScreenMenu.style.display = "block";
            smallScreenMenu.style.display = "flex";
        }
        else {
            smallScreenMenu.style.display = "none";
            smallScreenMenu.style.display = "none";
        }
    })
}

const navbarMenu = document.querySelector(".navbar .links");
const hamburgerBtn = document.querySelector(".hamburger-btn");
const hideMenuBtn = navbarMenu.querySelector(".close-btn");
const showPopupBtn = document.querySelector(".login-btn");
const formPopup = document.querySelector(".form-popup");
const hidePopupBtn = formPopup.querySelector(".close-btn");
const signupLoginLink = formPopup.querySelectorAll(".bottom-link a");

// Show mobile menu
hamburgerBtn.addEventListener("click", () => {
    navbarMenu.classList.toggle("show-menu");
});

// Hide mobile menu
hideMenuBtn.addEventListener("click", () => hamburgerBtn.click());

// Show login popup
showPopupBtn.addEventListener("click", () => {
    document.body.classList.toggle("show-popup");
});

// Hide login popup
hidePopupBtn.addEventListener("click", () => showPopupBtn.click());

// Show or hide signup form
signupLoginLink.forEach((link) => {
    link.addEventListener("click", (e) => {
        e.preventDefault();
        formPopup.classList[link.id === "signup-link" ? "add" : "remove"](
            "show-signup"
        );
    });
});
//
// show menu | ends
// 


//Search Page
function initMap() {
    var map = new google.maps.Map(document.getElementById('map-canvas'), {
        zoom: 16,
        center: { lat: 40.712784, lng: -74.005941 }
    });

    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(40.712784, -74.005941),
        map: map
    });
    var geocoder = new google.maps.Geocoder();

    document.getElementById('submit').addEventListener('click', function () {
        geocodeAddress(geocoder, map);
    });
}

function geocodeAddress(geocoder, resultsMap) {
    var address = document.getElementById('address').value;
    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: resultsMap,
                position: results[0].geometry.location
            });
        } else {
            var error = document.getElementById('error-msg');
            var errorText = 'Address lookup was not successful for the following reason: ' + status;
            error.insertAdjacentHTML('afterBegin', errorText);
        }
    });
}