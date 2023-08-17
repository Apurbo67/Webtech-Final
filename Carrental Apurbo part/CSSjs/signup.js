document.addEventListener("DOMContentLoaded", function() {
    const signupButton = document.getElementById("signupButton");
    const signupContent = document.getElementById("signupContent");

    signupButton.addEventListener("click", function() {
        loadSignupContent(signupContent);
    });
});

function loadSignupContent(container) {
    const xhr = new XMLHttpRequest();
    xhr.onload = function() {
        container.innerHTML = xhr.responseText;
    };
    xhr.open("GET", "../view/signup.php", true);
    xhr.send();
}
