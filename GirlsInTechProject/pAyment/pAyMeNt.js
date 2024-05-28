function openPopUp() {
    document.getElementById("popup").style.display = "flex";
}

function closePopUp() {
    document.getElementById("popup").style.display = "none";
}

function confirmPayment() {
    // Here you can add the logic for confirming the payment
    alert("Payment confirmed!");
    closePopUp();
}

function confirmPayment() {
    // Here you can add the logic for confirming the payment
    alert("Payment confirmed!");
    // Redirect to confirmation.html
    window.location.href = "confirmation.html"}; 

document.addEventListener("DOMContentLoaded", function() {
    // Attach event listeners to buttons
    document.querySelector(".submit").addEventListener("click", function(event) {
        event.preventDefault(); // Prevent form submission
        openPopUp();
    });

    document.querySelector(".close").addEventListener("click", closePopUp);
});
