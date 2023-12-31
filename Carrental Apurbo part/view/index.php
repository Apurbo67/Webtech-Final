<?php
session_start();

include("../controllers/connections.php");
include("../model/functions.php");
$con = connection();
$user_data = check_login($con);

if (!$user_data) {
    header("Location: ../view/login.php");
    die;
}

$cookieName = 'username';
$cookieValue = $user_data['user_name'];
$cookieExpiration = time() + 3600;

setcookie($cookieName, $cookieValue, $cookieExpiration, '/');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Car Rental System</title>
    
</head>
<body>
    <center>
    <div class="container">
        <h1>WELCOME TO CAR SHARENTAL</h1>
        <a href="../view/logout.php" class="logout-button">Logout</a>
        <p>Hello, <?php echo $user_data['user_name'] ?></p>

        <form action="../view/rider.php" method="post">
            <button type="submit" name="rider">Rider</button>
        </form>
        
        <form action="../view/passenger.php" method="post">
            <button type="submit" name="passenger">Passenger</button>
        </form>

        <form action="../view/profile.php" method="post">
            <button type="submit" name="profile">Profile</button>
       </form>
</form>
</div>
</center>
</body>
</html>
