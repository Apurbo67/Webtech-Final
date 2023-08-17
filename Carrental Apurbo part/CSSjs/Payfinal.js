document.addEventListener("DOMContentLoaded", function() {
    const paymentInput = document.getElementById("paymentInput");
    const displayText = document.getElementById("displayText");
    const finalPaymentButton = document.getElementById("finalPaymentButton");
    const paymentStatus = document.getElementById("paymentStatus");

    paymentInput.addEventListener("keyup", function() {
        displayText.innerText = "Acc number: " + paymentInput.value;
    });

    finalPaymentButton.addEventListener("click", function() {
        const inputValue = paymentInput.value.trim();
        if (inputValue === "") {
            alert("The box is empty. Please enter a value.");
        } else if (!isNumber(inputValue)) {
            alert("You can only use numbers in the box.");
        } else {
            // Make an AJAX request here
            makeAjaxRequest(inputValue);
        }
    });
});

function isNumber(value) {
    const pattern = /^[0-9]+$/;
    return pattern.test(value);
}

function goToPassengerPage() {
    window.location.href = "../view/passenger.php";
}



