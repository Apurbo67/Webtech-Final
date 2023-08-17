function validateForm() {
    var userNameInput = document.getElementById("user_name");
    var passwordInput = document.getElementById("password");

    if (userNameInput.value.trim() === "") {
        alert("Please enter a user name.");
        return false; 
    }

    
    var firstChar = userNameInput.value.trim().charAt(0);
    if (!firstChar.match(/[a-zA-Z]/)) {
        alert("Username must start with a letter.");
        return false;
    }

    if (passwordInput.value.trim() === "") {
        alert("Please enter a password.");
        return false; 
    }

    return true; 
}

