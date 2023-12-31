<?php
session_start();

include("../controllers/connections.php");
include("../model/functions.php");

$login_message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        // Read from the database
        $con = connection();
        $query = "SELECT * FROM users WHERE user_name = '$user_name' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            if ($user_data['password'] === $password) {
                // Password is correct, redirect to the index page
                setcookie('username', $user_data['user_name'], time() + 3600, '/');
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location: ../view/index.php");
                die;
            } else 
            {
                $login_message = "Wrong password";
            }
        } else {
            $login_message = "Wrong user information";
        }
    } else {
        $login_message = "Please enter valid information";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            background-color: #e1f3d8; 
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        center {
            margin-top: 100px;
        }

            #box form input[type="submit"]:hover {
            background-color: #ccc; /* Light gray  */
        }

        #box form button.signup-button {
            display: block;
            margin-top: 10px;
            padding: 10px;
            background-color: #fff; 
            color: #000; 
            font-size: 16px;
            text-decoration: none;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #box form button.signup-button:hover {
            background-color: #ccc; 
        }

        #box p {
            color: red;
        }
    </style>
</head>
<body>
    <center>
        <div id="box">
            <form method="POST" onsubmit="return validateForm()">
                <div style="font-size: 20px; margin: 10px;">Login</div>
                <label> Enter User Name </label> <br>
                <input type="text" name="user_name" id="user_name"><br>
                <label> Enter Password </label> <br>
                <input type="password" name="password" id="password"><br>
                <input type="submit" name="Login" value="Login"><br>
                <button id="signupButton">Click to Signup</button>
                <div id="signupContent"></div>
                <script src="../cssjs/Signup.js"></script>

            </form>
            <?php
                if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($login_message)) {
                    echo "<p style='color: red;'>$login_message</p>";
                }
            ?>
        </div>
    </center>

    <script src="../CSSjs/login.js"></script>
</body>
</html>
